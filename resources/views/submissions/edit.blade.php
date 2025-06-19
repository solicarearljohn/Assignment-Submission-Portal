<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Submission for: ') }}{{ $assignment->title }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('submissions.updateSubmission', $submission->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label text-white">Upload New File (optional)</label>
                        <input type="file" class="form-control bg-gray-100 text-black" id="file" name="file">
                        <div class="mt-2 text-white">
                            Current File: <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-400 underline">Download</a>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-lg px-5 py-2 mt-3"
                        style="background: linear-gradient(90deg, #6ee7b7 60%, #34d399 100%); color:#059669; font-weight:bold; border-radius:2rem; box-shadow:0 2px 8px rgba(0,0,0,0.10); font-size:1.1rem; min-width:220px; display:block; margin:0 auto;">
                        Update Submission
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
