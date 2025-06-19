<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Classroom') }}
        </h2>
        {{-- Notification bell moved to navigation bar --}}
    </x-slot>

    @if(auth()->user()->role_id == 2 && request()->route()->getName() === 'dashboard')
        <script>
            window.location = "{{ route('student.subjects') }}";
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div style="color:#059669 !important; font-weight:bold; font-size:1.1rem; margin-bottom:1.5rem;">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(auth()->user()->role_id == 1)
                        <div class="row mb-3 align-items-center">
                            <div class="col-12 text-center mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-4 p-4" style="background: linear-gradient(90deg, #9dc6b6 60%, #34d399 100%); border-radius: 1rem; box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                                    <h1 class="mb-0 text-dark" style="font-size:2rem;font-weight:bold;letter-spacing:1px;text-shadow:0 2px 8px rgba(0,0,0,0.10);">Manage Classroom</h1>
                                    <form action="{{ route('courses.create') }}" method="get" class="mb-0 d-inline-block">
                                        <button type="submit" class="btn btn-lg px-5 py-2" style="background-color:#fff;color:#6cb49d;font-weight:bold;appearance:button;text-decoration:none;border-radius: 2rem;transition: background 0.2s;min-width:220px;box-shadow:0 2px 8px rgba(0,0,0,0.10);" onmouseover="this.style.backgroundColor='#d1fae5'" onmouseout="this.style.backgroundColor='#fff'">Create New Classroom</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 offset-md-9 text-end">
                            </div>
                        </div>
                        <ul class="list-unstyled">
                            @foreach($courses as $course)
                                <li class="mb-4">
                                    <div class="card bg-white text-dark shadow" style="position: relative; border-radius: 1rem; box-shadow:0 2px 8px rgba(0,0,0,0.10); padding: 1.5rem 2rem; min-height: 90px;">
                                        <form action="{{ route('courses.delete', $course->id) }}" method="POST" style="position:absolute;top:18px;right:24px;z-index:2;" onsubmit="return confirm('Are you sure you want to delete this classroom? All assignments and submissions will be deleted.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm" title="Delete Classroom" style="background:transparent;color:#e3342f;font-size:1.5rem;line-height:1;border:none;padding:0 8px;cursor:pointer;box-shadow:none;">&times;</button>
                                        </form>
                                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between w-100 gap-3" style="gap: 2rem !important; margin-bottom: 1.5rem;">
                                            <div class="d-flex align-items-center gap-2" style="gap: 1.2rem !important;">
                                                <h4 class="card-title mb-0" style="font-weight:bold;letter-spacing:1px;color:#111; font-size:1.7rem;">{{ $course->name }}</h4>
                                            </div>
                                            <a href="{{ route('assignments.create', $course->id) }}" class="btn btn-lg px-5 py-2 ms-md-3 mt-3 mt-md-0" style="background: linear-gradient(90deg, #6ee7b7 60%, #34d399 100%); color:#059669; font-weight:bold; border-radius:2rem; box-shadow:0 2px 8px rgba(0,0,0,0.10); font-size:1.1rem;">Add Assignment</a>
                                        </div>
                                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center mb-3 gap-3">
                                        </div>
                                        <div class="w-100">
                                            <ul class="list-unstyled ms-3 mt-3">
                                                @foreach($course->assignments as $assignment)
                                                    <li class="mb-2">
                                                        <div class="d-flex align-items-center flex-wrap" style="gap:1.2rem; padding: 0.7rem 0; border-bottom:1px solid #e5e7eb;">
                                                            <span class="fw-bold text-truncate" style="color:#111;max-width:280px;">{{ $assignment->title }}</span>
                                                            <span class="small text-truncate" style="color:#666;font-style:italic;max-width:200px;">({{ $assignment->description }})</span>
                                                            <span class="small" style="color:#111;">Due: {{ $assignment->due_date }}</span>
                                                            <a href="{{ route('assignments.edit', [$course->id, $assignment->id]) }}" class="btn btn-sm ms-2" title="Edit Assignment" style="background:transparent;color:#2563eb;padding:0.3rem 0.7rem;font-size:1.2rem;display:inline-flex;align-items:center;border:none;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align:middle;"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" /></svg>
                                                            </a>
                                                            <form action="{{ route('assignments.delete', [$course->id, $assignment->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm ms-1" title="Delete Assignment" style="background:transparent;color:#e3342f;padding:0.3rem 0.7rem;font-size:1.2rem;display:inline-flex;align-items:center;border:none;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align:middle;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="d-flex align-items-center flex-wrap" style="gap:1.2rem; padding: 0.7rem 0 0.2rem 0;">
                                                            <span class="small" style="color:#111;font-weight:500;">Submissions: {{ $assignment->submissions_count }}</span>
                                                            <a href="{{ route('submissions.review', $assignment->id) }}" class="btn btn-sm" title="Review Submissions" style="background:transparent;color:#059669;padding:0.3rem 0.7rem;font-size:1rem;display:inline-flex;align-items:center;border:none;">
                                                                Review Submissions
                                                            </a>
                                                        </div>
                                                        <div class="mt-1 ms-2" style="color:#059669;font-weight:600;font-size:1.05rem;font-style:italic;">
                                                            Instructor: {{ auth()->user()->name }}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @elseif(auth()->user()->role_id == 2)
                     <!--   <h4>Your Classroom</h4> -->
                        <ul class="list-unstyled">
                            @foreach($courses as $course)
                                <li class="mb-4">
                                    <div class="card bg-gray-900 text-white shadow">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $course->name }}</h5>
                                            <ul class="list-unstyled ms-3">
                                                @foreach($course->assignments as $assignment)
                                                    <li class="mb-2">
                                                        <div class="d-flex align-items-center flex-wrap">
                                                            <div class="mt-1 ms-2" style="font-weight:600;font-size:0.98rem;font-style:italic;">
                                                            @if($course->user)
                                                                <span style="color:#059669;">{{ $course->user->name }}</span> <span style="color:#fff;">posted an assignment!</span>
                                                            @endif
                                                        </div>
                                                            <span class="fw-bold">{{ $assignment->title }}</span>
                                                            <span class="ms-2 small" style="color:#d9d7d7;font-style:italic;">({{ $assignment->description }})</span>
                                                            
                                                            <span class="ms-2 small; ">Due date: {{ $assignment->due_date }}</span>
                                                            
                                                            @if($submissions->has($assignment->id))
                                                                <span class="badge bg-success ms-2">Submitted</span>
                                                                <a href="{{ route('submissions.edit', $submissions[$assignment->id]->id) }}" class="btn btn-sm btn-secondary ms-2" title="Edit Submission" style="display:inline-flex;align-items:center;justify-content:center;padding:0.375rem 0.75rem;font-size:1rem;background:transparent;border:none;color:#2563eb;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align:middle;"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" /></svg>
                                                                </a>
                                                                <form action="{{ route('submissions.delete', $submissions[$assignment->id]->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger ms-2" title="Delete Submission" style="display:inline-flex;align-items:center;justify-content:center;padding:0.375rem 0.75rem;font-size:1rem;background:transparent;border:none;color:#e3342f;">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="vertical-align:middle;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <span class="badge bg-warning ms-2">Not Submitted</span>
                                                                <a href="{{ route('submissions.create', $assignment->id) }}" class="btn btn-sm btn-primary ms-2" style="display:inline-block;padding:0.25rem 0.9rem;font-size:0.98rem;font-weight:500;border-radius:1.2rem;background:linear-gradient(90deg,#34d399 60%,#059669 100%);color:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.10);transition:background 0.2s;">Submit</a>
                                                            @endif
                                                        </div>
                                                        @if($submissions->has($assignment->id))
                                                            <div class="mt-2 ms-2">
                                                                <a href="{{ asset('storage/' . $submissions[$assignment->id]->file_path) }}" target="_blank" title="View Submission">
                                                                    @php
                                                                        $ext = strtolower(pathinfo($submissions[$assignment->id]->file_path, PATHINFO_EXTENSION));
                                                                        $iconText = strtoupper($ext === 'pdf' ? 'PDF' : ($ext === 'doc' || $ext === 'docx' ? 'DOC' : ($ext === 'ppt' || $ext === 'pptx' ? 'PPT' : ($ext === 'mp4' ? 'MP4' : ($ext === 'mp3' ? 'MP3' : (strlen($ext) > 3 ? substr($ext, 0, 3) : $ext))))));
                                                                    @endphp
                                                                    @if($ext === 'pdf')
                                                                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);border:1.5px solid #e3342f;vertical-align:middle;text-align:center;font-weight:bold;color:#e3342f;font-size:1rem;font-family:Arial,Helvetica,sans-serif;overflow:hidden;">PDF</span>
                                                                    @elseif(in_array($ext, ['doc', 'docx']))
                                                                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);border:1.5px solid #2563eb;vertical-align:middle;text-align:center;font-weight:bold;color:#2563eb;font-size:1rem;font-family:Arial,Helvetica,sans-serif;overflow:hidden;">DOC</span>
                                                                    @elseif(in_array($ext, ['ppt', 'pptx']))
                                                                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);border:1.5px solid #f59e42;vertical-align:middle;text-align:center;font-weight:bold;color:#f59e42;font-size:1rem;font-family:Arial,Helvetica,sans-serif;overflow:hidden;">PPT</span>
                                                                    @elseif($ext === 'mp4')
                                                                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);border:1.5px solid #10b981;vertical-align:middle;text-align:center;font-weight:bold;color:#10b981;font-size:1rem;font-family:Arial,Helvetica,sans-serif;overflow:hidden;">MP4</span>
                                                                    @elseif($ext === 'mp3')
                                                                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);border:1.5px solid #6366f1;vertical-align:middle;text-align:center;font-weight:bold;color:#6366f1;font-size:1rem;font-family:Arial,Helvetica,sans-serif;overflow:hidden;">MP3</span>
                                                                    @else
                                                                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);border:1.5px solid #6b7280;vertical-align:middle;text-align:center;font-weight:bold;color:#6b7280;font-size:1rem;font-family:Arial,Helvetica,sans-serif;overflow:hidden;">{{ $iconText }}</span>
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </li>
                                                    <hr style="border:0;border-top:1.5px solid #2dd4bf;opacity:0.3;margin:18px 0 12px 0;">
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
