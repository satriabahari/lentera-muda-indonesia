<x-app-layout>
    <div class="p-8">


        <a href="{{ url('/courses', $lesson->course_id) }}"
            class="inline-flex items-center bg-white px-4 py-2 rounded-full text-black hover:bg-neutral-100 transition mb-4">
            <span class="mr-2">&larr;</span> {{ $lesson->course->title }}
        </a>

        <video controls class="w-[500px] mx-auto mb-12">
            <source src="{{ $lesson->video_url }}" type="video/mp4">
        </video>

        <h1 class="mb-4 text-xl font-bold">{{ $lesson->title }}</h1>

        <div class="prose prose-invert text-neutral-700">
            {!! str($lesson->content)->sanitizeHtml() !!}
        </div>

        <div class="flex justify-between mt-12">
            @if ($previousLesson)
                <button wire:click="goToPrevious"
                    class="px-4 py-2 bg-neutral-700 text-white rounded hover:bg-neutral-600 transition">
                    Sebelumnya
                </button>
            @else
                <span class="px-4 py-2 bg-neutral-800 text-neutral-400 rounded cursor-not-allowed">
                    Sebelumnya
                </span>
            @endif

            @if ($nextLesson)
                <button wire:click="goToNext"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 transition">
                    Berikutnya
                </button>
            @else
                <span class="px-4 py-2 bg-neutral-800 text-neutral-400 rounded cursor-not-allowed">
                    Berikutnya
                </span>
            @endif
        </div>
    </div>
</x-app-layout>
