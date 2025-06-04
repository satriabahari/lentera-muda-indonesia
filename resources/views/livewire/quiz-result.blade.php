<x-app-layout>
    <div class="text-gray-200 p-8">
        <h2 class="text-3xl font-bold mb-2">Kursus: {{ $course->title }}</h2>
        <h3 class="text-xl mb-4">Quiz: {{ $quiz->title }}</h3>

        <div class="mb-6 text-lg text-green-300 font-semibold">
            Skor Anda: {{ $score }} dari {{ $quiz->questions->count() }}
        </div>

        @foreach ($quiz->questions as $question)
            <div class="mb-4 bg-gray-800 p-4 rounded">
                <p class="font-semibold mb-2">Pertanyaan: {{ $question->question }}</p>

                @php
                    $userAnswer = $userAnswers[$question->id][0] ?? null;
                @endphp

                @foreach ($question->answers as $answer)
                    <div
                        class="@if ($userAnswer && $userAnswer->answer_id == $answer->id) text-blue-400 font-bold @endif
                               @if ($answer->is_correct) bg-green-600 text-white p-1 rounded @endif mb-1">
                        {{ $answer->answer_text }}
                    </div>
                @endforeach

                @if ($userAnswer)
                    <p class="text-sm mt-2">
                        Jawaban kamu: <strong>{{ $userAnswer->answer->answer_text }}</strong>
                        @if ($userAnswer->answer->is_correct)
                            ✅ <span class="text-green-400 font-bold">Benar</span>
                        @else
                            ❌ <span class="text-red-400 font-bold">Salah</span>
                        @endif
                    </p>
                @else
                    <p class="text-sm text-yellow-400 mt-2">Kamu belum menjawab soal ini.</p>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
