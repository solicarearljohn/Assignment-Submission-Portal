<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    // Show form to create an assignment for a course
    public function create(Course $course)
    {
        return view('assignments.create', compact('course'));
    }

    // Store a new assignment
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        Assignment::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Assignment created successfully.');
    }

    // Show form to edit an assignment
    public function edit(Course $course, Assignment $assignment)
    {
        return view('assignments.edit', compact('course', 'assignment'));
    }

    // Update an assignment
    public function update(Request $request, Course $course, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Assignment updated successfully.');
    }

    // Delete an assignment
    public function destroy(Course $course, Assignment $assignment)
    {
        $assignment->delete();
        return redirect()->route('dashboard')->with('success', 'Assignment deleted successfully.');
    }
}
