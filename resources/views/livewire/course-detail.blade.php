<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold">{{ $course->title }}</h1>

    @if ($course->image)
        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover">
    @else
        <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500">
            No Image
        </div>
    @endif

    <p class="text-gray-600 mt-4">{{ $course->description }}</p>
</div>
