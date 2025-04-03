<div class="w-fit">
    <h2 class="text-2xl font-bold mb-4">quizzes</h2>

    @forelse ($quizzes as $quiz)
        <div class="mb-4">
            <a href="{{ route('quiz.show', ['course' => $quiz->course_id, 'quiz' => $quiz->id]) }}"
                class='cursor-pointer bg-gray-800 px-4 py-2 rounded-md'>
                {{ $quiz->title }}
            </a>
        </div>

    @empty
        <p>No quizzes available.</p>
    @endforelse
</div>
