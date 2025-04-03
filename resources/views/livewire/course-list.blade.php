<x-app-layout>
    <div class="p-8 text-gray-100">
        <h1 class="text-3xl font-bold mb-4">Course List</h1>

        <div>
            @forelse($courses as $course)
                @if ($course->status === 'published')
                    <a href="{{ route('course.show', $course->id) }}"
                        class="rounded-md cursor-pointer mb-4 bg-gray-800 p-4 flex gap-4">
                        <img src="{{ Storage::url('/' . $course->image) }}"
                            class="w-60 bg-cover object-cover h-40 rounded-md" alt="{{ $course->title }}">

                        <div>
                            <h2 class="text-xl font-bold">{{ $course->title }}</h2>
                            <p class="text-base text-gray-300">{{ $course->description }}</p>
                            <flux:badge variant="pill" @class([
                                '!bg-orange-500' => $course->category === 'osis',
                                '!bg-blue-500' => $course->category === 'mandiri',
                                '!bg-gray-300' => !in_array($course->category, ['osis', 'mandiri']),
                            ])>{{ $course->category }}</flux:badge>
                        </div>
                    </a>
                @endif
            @empty
                <p>No courses found.</p>
            @endforelse ($courses as $course)
        </div>
    </div>

</x-app-layout>
