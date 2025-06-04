<div class="w-full">
    <h2 class="text-2xl font-bold mb-6">Lessons</h2>

    @forelse ($lessons as $lesson)
        @if ($lesson->is_active)
            <div
                class=' cursor-pointer bg-neutral-100 p-4 rounded-md hover:bg-cyan-300 mb-4 transition-all duration-300'>
                <a href="{{ route('lesson.show', ['course' => $course->id, 'lesson' => $lesson->id]) }}"
                    class="flex gap-8">
                    <video controls class="w-64">
                        <source src="{{ $lesson->video_url }}" type="video/mp4">
                    </video>

                    <div class="">
                        <h3 class="text-lg font-bold">{{ $lesson->title }}</h3>
                        <p class="text-sm text-neutral-500">{{ Str::limit($lesson->content, 500) }}</p>
                    </div>
                </a>
            </div>
        @endif
    @empty
        <p>No lessons available.</p>
    @endforelse
</div>
