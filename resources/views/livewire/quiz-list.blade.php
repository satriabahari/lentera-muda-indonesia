<div class="w-full mb-16">
    <h2 class="text-2xl font-bold my-6">Kuis</h2>

    @forelse ($quizzes as $quiz)
        @if ($quiz->is_active)
            @php
                $studentAnswer = $studentAnswers->where('quiz_id', $quiz->id)->first();
                $score = $studentAnswer ? $studentAnswer->score : null;
            @endphp
            <a href="{{ route('quiz.show', ['course' => $quiz->course_id, 'quiz' => $quiz->id]) }}" class="w-full">
                <div
                    class='cursor-pointer flex justify-between bg-neutral-50 border border-neutral-200 shadow p-4 mb-4 w-full rounded-md hover:bg-neutral-100 transition'>
                    <p>{{ $loop->iteration }}. {{ $quiz->title }}</p>
                    <p @class([
                        'py-1 px-4 text-sm rounded-full text-neutral-100',
                        'bg-green-500' => $score !== null && $score >= 70,
                        'bg-red-500' => $score !== null && $score < 70,
                        'bg-gray-400' => $score === null, // warna default kalau belum ada score
                    ])>
                        Nilai: {{ $score ?? '-' }}
                    </p>
                </div>
            </a>
        @endif
    @empty
        <p>Tidak ada kuis yang tersedia</p>
    @endforelse
</div>
