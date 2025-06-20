<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('My Submissions for: ') }}{{ $assignment->title }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th class="text-white">File</th>
                            <th class="text-white">Submitted At</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Grade</th>
                            <th class="text-white">Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                            <tr>
                                <td><a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-400 underline">Download</a></td>
                                <td class="text-white">{{ $submission->submitted_at }}</td>
                                <td class="text-white">{{ $submission->status }}</td>
                                <td class="text-white">{{ $submission->grade ? $submission->grade->value : '-' }}</td>
                                <td class="text-white">{{ $submission->feedback ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
