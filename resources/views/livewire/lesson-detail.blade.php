<x-app-layout>
    <div class="p-8 pt-16">
        <a href="{{ url('/courses', $lesson->course_id) }}"
            class="inline-flex items-center bg-cyan-500 hover:bg-cyan-700 px-4 py-2 rounded-full text-neutral-100 mt-8 transition mb-4">
            <span class="mr-2">&larr;</span> {{ $lesson->course->title }}
        </a>

        <video controls class="w-[500px] mx-auto mb-12">
            <source src="{{ $lesson->video_url }}" type="video/mp4">
        </video>

        <h1 class="mb-4 text-xl font-bold text-cyan-900">{{ $lesson->title }}</h1>

        <div class="prose text-neutral-700">
            {!! str($lesson->content)->sanitizeHtml() !!}
        </div>

        <div class="flex justify-between mt-12">
            @if ($previousLesson)
                <button wire:click="goToPrevious"
                    class="px-4 py-2 bg-cyan-500 text-neutral-100 rounded hover:bg-cyan-700 transition">
                    Sebelumnya
                </button>
            @else
                <span class="px-4 py-2 bg-neutral-500 text-neutral-900 rounded cursor-not-allowed">
                    Sebelumnya
                </span>
            @endif

            @if ($nextLesson)
                <button wire:click="goToNext"
                    class="px-4 py-2 bg-cyan-500 text-neutral-100 rounded hover:bg-cyan-700 transition">
                    Berikutnya
                </button>
            @else
                <span class="px-4 py-2 bg-neutral-500 text-neutral-900 rounded cursor-not-allowed">
                    Berikutnya
                </span>
            @endif
        </div>
    </div>
</x-app-layout>
