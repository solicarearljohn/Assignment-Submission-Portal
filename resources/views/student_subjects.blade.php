<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Subjects') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="row">
                    @forelse($courses as $course)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm hover:shadow-lg transition" style="cursor:pointer; border-radius:1rem;" onclick="window.location='{{ route('student.dashboard', $course->id) }}'">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <h4 class="card-title text-center mb-2" style="font-weight:bold; color:#059669;">{{ $course->name }}</h4>
                                    <span class="text-white">Instructor: {{ $course->user->name ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-gray-500">No subjects found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
