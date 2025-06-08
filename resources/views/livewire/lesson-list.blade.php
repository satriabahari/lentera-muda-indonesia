<div class="w-full">
    <h2 class="text-2xl font-bold mb-6 text-cyan-900">Pelajaran</h2>

    @forelse ($lessons as $lesson)
        @if ($lesson->is_active)
            <div
                class='cursor-pointer bg-neutral-50 border border-neutral-200   p-4 rounded-md  mb-4 hover:bg-neutral-100 transition-all duration-300 shadow'>
                <a href="{{ route('lesson.show', ['course' => $course->id, 'lesson' => $lesson->id]) }}"
                    class="flex gap-8">
                    <video controls class="w-64">
                        <source src="{{ $lesson->video_url }}" type="video/mp4">
                    </video>

                    <div class="space-y-2">
                        <h3 class="text-lg font-bold text-cyan-900">{{ $lesson->title }}</h3>
                        <p class="text-sm text-neutral-500">{{ Str::limit(strip_tags($lesson->content), 750) }}</p>
                    </div>
                </a>
            </div>
        @endif
    @empty
        <p>Tidak ada pelajaran yang tersedia</p>
    @endforelse
</div>
