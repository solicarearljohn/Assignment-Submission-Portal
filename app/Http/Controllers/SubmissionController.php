<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use App\Notifications\SubmissionGraded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function create($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        return view('submissions.create', compact('assignment'));
    }

    public function store(Request $request, $assignmentId)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip,ppt,pptx,mp4,avi,mov,png,jpg,jpeg,gif,bmp,webp|max:20480', // 20MB max, allow images
        ]);

        $assignment = Assignment::findOrFail($assignmentId);
        $user = Auth::user();

        $filePath = $request->file('file')->store('submissions', 'public');

            Submission::create([
                'assignment_id' => $assignment->id,
                'user_id' => $user->id,
                'file_path' => $filePath,
                'submitted_at' => now(),
                'status' => 'pending',
            ]);

        // Redirect to the per-course dashboard after submission
        return redirect()->route('student.dashboard', $assignment->course_id)
            ->with('success', 'Submission uploaded successfully!');
    }

    public function index($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $user = Auth::user();
        $submissions = Submission::where('assignment_id', $assignmentId)
            ->where('user_id', $user->id)
            ->get();
        return view('submissions.index', compact('assignment', 'submissions'));
    }

    public function review($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $submissions = Submission::where('assignment_id', $assignmentId)->with('student')->get();
        $grades = \App\Models\Grade::all();
        return view('submissions.review', compact('assignment', 'submissions', 'grades'));
    }

    public function update(Request $request, $submissionId)
    {
        $request->validate([
            'grade_id' => 'nullable|exists:grades,id',
            'feedback' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:20',
        ]);
        $submission = Submission::findOrFail($submissionId);
        $submission->grade_id = $request->grade_id;
        $submission->feedback = $request->feedback;
        $submission->status = $request->status ?? 'graded';
        $submission->save();
        // Notify student
        $submission->student->notify(new SubmissionGraded($submission));
        \Log::info('Graded submission user_id: ' . $submission->user_id . ', notified user_id: ' . $submission->student->id . ', submission_id: ' . $submission->id);
        return back()->with('success', 'Submission graded and feedback saved!');
    }

    public function editSubmission($submissionId)
    {
        $submission = Submission::findOrFail($submissionId);
        $assignment = $submission->assignment;
        return view('submissions.edit', compact('submission', 'assignment'));
    }

    public function updateSubmission(Request $request, $submissionId)
    {
        $submission = Submission::findOrFail($submissionId);
        $request->validate([
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip,ppt,pptx,mp4,avi,mov,png,jpg,jpeg,gif,bmp,webp|max:20480', // 20MB max, allow images
        ]);
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
            $submission->file_path = $filePath;
            $submission->submitted_at = now();
            $submission->status = 'pending';
        }
        $submission->save();
        // Redirect to the per-course dashboard after update
        return redirect()->route('student.dashboard', $submission->assignment->course_id)
            ->with('success', 'Submission updated successfully!');
    }

    public function deleteSubmission($submissionId)
    {
        $submission = Submission::findOrFail($submissionId);
        $assignment = $submission->assignment;
        $submission->delete();
        // Redirect to the per-course dashboard after deletion
        return redirect()->route('student.dashboard', $assignment->course_id)
            ->with('success', 'Submission deleted successfully!');
    }
}
