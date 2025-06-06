<x-app-layout>
    <div class="p-6">
        <h1>Course: {{ $course->title }}</h1>

        <h1 class="text-2xl font-bold mb-4">Hasil Quiz: {{ $quiz->title }}</h1>

        <p class="mb-4">Total Skor: <strong>{{ $score }}</strong></p>

        <div class="mb-6 p-4 bg-gray-800 rounded">
            <h3 class="font-semibold text-white">{{ $quiz->question->question }}</h3>

            <p class="text-gray-300 mt-2"><strong>Jawaban:</strong></p>
            <p class="italic text-gray-200">
                {{ $studentAnswer[$quiz->question->id][0]->answer_text ?? '-' }}
            </p>

            @if (!is_null($studentAnswer[$quiz->question->id][0]->score ?? null))
                <p class="mt-2 text-green-400">Skor: {{ $studentAnswer[$quiz->question->id][0]->score }}</p>
            @else
                <p class="mt-2 text-yellow-400">Belum dinilai</p>
            @endif
        </div>
    </div>
</x-app-layout>
