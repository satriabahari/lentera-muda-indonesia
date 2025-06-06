<x-app-layout>
    @if ($studentAnswer && !empty(trim($studentAnswer->answer_text)))
        <div class="text-gray-800 p-8 pt-24">
            <h2 class="text-3xl font-bold mb-4 text-cyan-900">Quiz: {{ $quiz->title }}</h2>

            <div class="px-4 py-2 rounded-md border border-green-200 shadow bg-green-50 mb-4">
                <h5 class="font-semibold mb-2 text-green-900">Jawaban yang telah kamu kirim:</h5>
                <p class="text-neutral-700 whitespace-pre-line">{{ $studentAnswer->answer_text }}</p>
            </div>
        </div>
    @else
        {{-- Form menjawab jika belum pernah dijawab --}}
        <div class="text-gray-800 p-8 pt-24">
            <h2 class="text-3xl font-bold mb-4 text-cyan-900">Quiz: {{ $quiz->title }}</h2>

            <form wire:submit.prevent="submit">
                <div class="px-4 py-2 rounded-md border border-neutral-100 shadow bg-neutral-50 mb-4">
                    <h5 class="font-semibold mb-2 text-cyan-900">Pertanyaan:</h5>
                    <p class="mb-2 text-neutral-700">{{ $question->question_text }}</p>

                    <label for="answer_{{ $question->id }}"
                        class="text-cyan-900 block mb-2 font-medium">Jawaban:</label>
                    <textarea id="answer_{{ $question->id }}" wire:model.defer="answers.{{ $question->id }}" rows="5"
                        class="w-full p-2 text-gray-900 rounded-md" placeholder="Tulis jawabanmu di sini..." required></textarea>
                </div>

                <button type="submit"
                    class="bg-cyan-500 hover:bg-cyan-700 text-sm text-neutral-100 font-semibold px-4 py-2 rounded">
                    Submit Jawaban
                </button>
            </form>
        </div>
    @endif
</x-app-layout>
