<x-app-layout>
    <div class="text-gray-200 p-8">
        <h2 class="text-3xl font-bold mb-4">Course: {{ $course->title }}</h2>
        <h3 class="text-2xl font-bold mb-4">Quiz: {{ $quiz->title }}</h3>

        <h3 class="text-xl font-bold mb-2">Questions</h3>
        @if ($questions->isNotEmpty())
            @foreach ($questions as $question)
                <div class="px-4 py-2 rounded-md bg-gray-800">
                    <p class="mb-2">Type: {{ $question->type }}</p>
                    <h5>Question:</h5> {{ $question->question }}
                </div>
            @endforeach
        @else
            <p>No questions available for this quiz.</p>
        @endif
    </div>
</x-app-layout>
