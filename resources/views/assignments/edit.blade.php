<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Assignment for ') }}{{ $course->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('assignments.update', [$course->id, $assignment->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="title" class="form-label text-white">Title</label>
                        <input type="text" class="form-control bg-gray-100 text-black" id="title" name="title" value="{{ $assignment->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label text-white">Description</label>
                        <textarea class="form-control bg-gray-100 text-black" id="description" name="description" required>{{ $assignment->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label text-white">Due Date & Time</label>
                        <input type="datetime-local" class="form-control bg-gray-100 text-black" id="due_date" name="due_date" value="{{ date('Y-m-d\TH:i', strtotime($assignment->due_date)) }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary bg-blue-600 text-white font-bold px-4 py-2 rounded hover:bg-blue-800 border-0 mt-3" style="display:block;width:100%;">Update Assignment</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
