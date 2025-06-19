<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Create Assignment for ') }}{{ $course->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg p-8" style="box-shadow:0 4px 24px rgba(0,0,0,0.12);">
                <form action="{{ route('assignments.store', $course->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="form-label text-white" style="font-weight:bold; display:block; margin-bottom:0.5rem;">Title</label>
                        <input type="text" class="form-control bg-gray-100 text-black px-4 py-3 rounded-lg border-0 shadow-sm focus:ring-2 focus:ring-green-300 w-100" id="title" name="title" required placeholder="Enter assignment title" style="width:100%;">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label text-white" style="font-weight:bold; display:block; margin-bottom:0.5rem;">Description</label>
                        <textarea class="form-control bg-gray-100 text-black px-4 py-3 rounded-lg border-0 shadow-sm focus:ring-2 focus:ring-green-300 w-100" id="description" name="description" required placeholder="Enter assignment description" rows="4" style="width:100%;"></textarea>
                    </div>
                    <div class="mb-6">
                        <label for="due_date" class="form-label text-white" style="font-weight:bold; display:block; margin-bottom:0.5rem;">Due Date & Time</label>
                        <input type="datetime-local" class="form-control bg-gray-100 text-black px-4 py-3 rounded-lg border-0 shadow-sm focus:ring-2 focus:ring-green-300 w-100" id="due_date" name="due_date" required style="width:100%;">
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-lg px-5 py-2" style="background: linear-gradient(90deg, #6ee7b7 60%, #34d399 100%); color:#059669; font-weight:bold; border-radius:2rem; box-shadow:0 2px 8px rgba(0,0,0,0.10); font-size:1.1rem; min-width:220px;">Create Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
