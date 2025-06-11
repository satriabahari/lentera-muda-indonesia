<div class="w-full mb-16">
    <h2 data-aos="fade-right" class="text-2xl font-bold my-6 text-cyan-900">Kuis</h2>

    @forelse ($quizzes as $quiz)
        @if ($quiz->is_active)
            @php
                $studentAnswer = $studentAnswers->where('quiz_id', $quiz->id)->first();
                $score = $studentAnswer ? $studentAnswer->score : null;
            @endphp
            <a href="{{ route('quiz.show', ['course' => $quiz->course_id, 'quiz' => $quiz->id]) }}" class="w-full">
                <div data-aos="zoom-in" data-aos-delay="{{ $loop->index * 200 }}"
                    class='cursor-pointer flex justify-between bg-white-50 border border-neutral-100 shadow p-4 mb-4 w-full rounded-md hover:bg-neutral-50 transition'>
                    <p>{{ $loop->iteration }}. {{ $quiz->title }}</p>

                    <p @class([
                        'py-1 px-4 rounded-full text-sm w-fit border-2 font-semibold',
                        'bg-green-50 border-green-500 text-green-500' =>
                            $score !== null && $score >= 70,
                        'bg-red-50 border-red-500 text-red-500' => $score !== null && $score < 70,
                        'bg-neutral-50 border-neutral-500 text-neutral-500' => $score === null,
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
