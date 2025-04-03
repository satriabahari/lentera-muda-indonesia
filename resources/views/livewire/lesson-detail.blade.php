<x-app-layout>
    <div class="text-gray-200 p-8">
        <h1 class="mb-8 text-xl font-bold">{{ $lesson->title }}</h1>

        <div class="prose prose-invert">
            {!! str($lesson->content)->sanitizeHtml() !!}
        </div>
    </div>
</x-app-layout>
