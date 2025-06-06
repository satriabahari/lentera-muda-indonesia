<div>
    <h1 class="text-3xl font-bold mb-4 text-center text-cyan-900 ">Course List</h1>

    <div class="grid grid-cols-4 gap-4">
        @forelse($courses as $course)
            @if ($course->is_active)
                <div class="w-full rounded-md bg-white shadow-lg flex flex-col h-full border border-neutral-100">
                    <div class="relative p-4">
                        <img src="{{ Storage::url($course->image) }}" class="w-full object-cover h-48 rounded-md"
                            alt="{{ $course->title }}">

                        <div class="absolute top-6 right-6 bg-neutral-100 py-1 px-2 rounded-md text-xs">
                            {{ $course->studentType->name }}
                        </div>
                    </div>

                    <div class="flex flex-col flex-grow px-4 pb-4">
                        <h2 class="text-lg font-bold mb-2">{{ $course->title }}</h2>

                        <p class="text-sm text-neutral-500 mb-4">{{ Str::limit($course->description, 100) }}</p>

                        <a href="{{ route('course.show', $course->id) }}"
                            class="block mt-auto text-center text-neutral-100 text-sm bg-cyan-500 px-4 py-2 rounded-md w-full hover:bg-cyan-600 hover:duration-300 hover:transition">
                            View Details
                        </a>
                    </div>
                </div>
            @endif
        @empty
            <p class="col-span-4 text-center">No courses found.</p>
        @endforelse
    </div>
</div>
