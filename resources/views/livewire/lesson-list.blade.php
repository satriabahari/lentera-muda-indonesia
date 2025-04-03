<div class="w-fit">
    <h2 class="text-2xl font-bold mb-4">Lessons</h2>

    @forelse ($lessons as $lesson)
        @if ($lesson->is_active)
            <div class="mb-4">
                <a href="{{ route('lesson.show', ['courseId' => $course->id, 'lessonId' => $lesson->id]) }}"
                    class='cursor-pointer bg-gray-800 px-4 py-2 rounded-md'>
                    {{ $lesson->title }}
                </a>
            </div>
        @endif
    @empty
        <p>No lessons available.</p>
    @endforelse
</div>
