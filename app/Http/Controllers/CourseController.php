<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Show form to create a course
    public function create()
    {
        return view('courses.create');
    }

    // Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Course::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Created successfully.');
    }

    // Delete a course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('dashboard')->with('success', 'Deleted successfully.');
    }
}
