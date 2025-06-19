<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Create Classroom') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label text-white">Classroom Name</label>
                        <input type="text" class="form-control bg-gray-100 text-black" id="name" name="name" required>
                    </div>
                    <div style="display: flex; justify-content: center;">
                        <button type="submit" class="btn btn-lg px-5 py-2" style="background-color:#fff;color:#059669;font-weight:bold;appearance:button;text-decoration:none;border-radius: 2rem;transition: background 0.2s;min-width:220px;box-shadow:0 2px 8px rgba(0,0,0,0.10);margin-top:1rem;" onmouseover="this.style.backgroundColor='#d1fae5'" onmouseout="this.style.backgroundColor='#fff'">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
