<div class="w-full">
    <h2 class="text-2xl font-bold my-6">Quizzes</h2>

    @forelse ($quizzes as $quiz)
        @if ($quiz->is_active)
            <div class='cursor-pointer bg-neutral-100 p-4 w-full rounded-md hover:bg-neutral-300 transition-all duration-300'>
                <a href="{{ route('quiz.show', ['course' => $quiz->course_id, 'quiz' => $quiz->id]) }}" class="w-full">
                    {{ $loop->iteration }}. {{ $quiz->title }}
                </a>
            </div>
        @endif
    @empty
        <p>No quizzes available.</p>
    @endforelse
</div>
