<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Review Submissions for: ') }}{{ $assignment->title }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div style="color:#059669 !important; font-weight:bold; font-size:1.1rem; margin-bottom:1.5rem;">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped table-dark" style="margin-bottom:2rem;">
                    <thead>
                        <tr>
                            <th class="text-white">Student</th>
                            <th class="text-white">File</th>
                            <th class="text-white">Submitted At</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Grade</th>
                            <th class="text-white">Feedback</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                            <tr style="vertical-align:middle;">
                                <td class="text-white" style="padding: 1rem 0.75rem;">{{ $submission->student->name ?? '-' }}</td>
                                <td style="padding: 1rem 0.75rem;">
                                    <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" style="text-decoration:none;">
                                        @php
                                            $ext = strtolower(pathinfo($submission->file_path, PATHINFO_EXTENSION));
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
                                </td>
                                <td class="text-white" style="padding: 1rem 0.75rem;">{{ $submission->submitted_at }}</td>
                                <td class="text-white" style="padding: 1rem 0.75rem;">{{ $submission->status }}</td>
                                <td class="text-white" style="padding: 1rem 0.75rem;">{{ $submission->grade ?? '-' }}</td>
                                <td class="text-white" style="padding: 1rem 0.75rem;">{{ $submission->feedback ?? '-' }}</td>
                                <td style="padding: 1rem 0.75rem;">
                                    <form action="{{ route('submissions.update', $submission->id) }}" method="POST" class="d-flex flex-column align-items-center gap-2" style="min-width:180px;">
                                        @csrf
                                        <input type="text" name="grade" value="{{ $submission->grade }}" placeholder="Grade" class="form-control bg-gray-100 text-black mb-2" style="width: 100px; display:inline-block;">
                                        <input type="text" name="feedback" value="{{ $submission->feedback }}" placeholder="Feedback" class="form-control bg-gray-100 text-black mb-2" style="width: 140px; display:inline-block;">
                                        <button type="submit" class="btn btn-success btn-sm mt-1" style="width:100px;font-weight:bold;background-color:#059669;color:#fff;border-radius:2rem;">Save</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
