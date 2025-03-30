<x-app-layout>
    <label for="title">{{ $title }}:</label>

    <input type="text" id="title" wire:model="title">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Kursus</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($courses as $course)
                <div wire:click='viewDetail({{ $course->id }})' class="bg-white shadow-md rounded-lg overflow-hidden">
                    @if ($course->image)
                        <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}"
                            class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    @endif

                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $course->title }}</h2>
                        <p class="text-sm text-gray-600 mb-2">{{ $course->description }}</p>

                        <span class="text-xs font-semibold px-2 py-1 rounded bg-blue-100 text-blue-800">
                            {{ ucfirst($course->category) }}
                        </span>

                        <span class="text-xs font-semibold px-2 py-1 rounded bg-gray-100 text-gray-800 ml-2">
                            {{ ucfirst($course->status) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
