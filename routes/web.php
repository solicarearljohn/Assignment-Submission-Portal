<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AssignmentController;
use App\Models\Course;
use App\Models\Submission;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role_id == 1) {
        $courses = Course::with(['assignments' => function($q) {
            $q->withCount('submissions');
        }])->where('user_id', $user->id)->get();
    } else {
        $courses = Course::with('assignments')->get();
        $submissions = Submission::where('user_id', $user->id)->get()->keyBy('assignment_id');
    }
    return view('dashboard', [
        'courses' => $courses,
        'submissions' => $submissions ?? collect(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/assignments/{assignment}/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::post('/notifications/{id}/mark-as-read', function($id) {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return back();
    })->name('notifications.markAsRead');
});

// Faculty routes
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/courses/{course}/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/courses/{course}/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
    Route::patch('/courses/{course}/assignments/{assignment}', [AssignmentController::class, 'update'])->name('assignments.update');
    Route::delete('/courses/{course}/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.delete');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.delete');

    // Faculty review and grading routes
    Route::get('/assignments/{assignment}/submissions/review', [SubmissionController::class, 'review'])->name('submissions.review');
    Route::post('/submissions/{submission}/update', [SubmissionController::class, 'update'])->name('submissions.update');
});

// Student routes
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/assignments/{assignment}/submit', [SubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/assignments/{assignment}/submit', [SubmissionController::class, 'store'])->name('submissions.store');
    Route::get('/submissions/{submission}/edit', [SubmissionController::class, 'editSubmission'])->name('submissions.edit');
    Route::post('/submissions/{submission}/edit', [SubmissionController::class, 'updateSubmission'])->name('submissions.updateSubmission');
    Route::delete('/submissions/{submission}/delete', [SubmissionController::class, 'deleteSubmission'])->name('submissions.delete');
    Route::get('/student-subjects', function () {
        $user = auth()->user();
        $courses = \App\Models\Course::with('faculty')->get();
        return view('student_subjects', ['courses' => $courses]);
    })->middleware(['auth', 'verified'])->name('student.subjects');

    Route::get('/student-dashboard/{course}', function ($courseId) {
        $user = auth()->user();
        $course = \App\Models\Course::with('assignments', 'faculty')->findOrFail($courseId);
        $submissions = \App\Models\Submission::where('user_id', $user->id)->get()->keyBy('assignment_id');
        return view('dashboard', [
            'courses' => collect([$course]),
            'submissions' => $submissions,
        ]);
    })->middleware(['auth', 'verified'])->name('student.dashboard');
});

require __DIR__.'/auth.php';
