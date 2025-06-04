<x-app-layout>
    <div class="text-gray-200 p-8">
        <h2 class="text-3xl font-bold mb-4">Quiz: {{ $quiz->title }}</h2>

        @if (session()->has('message'))
            <div class="mb-4 text-green-400 font-bold">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="submit">
            @foreach ($questions as $question)
                <div class="px-4 py-2 rounded-md bg-gray-800 mb-4">
                    <h5 class="font-semibold mb-2">Question:</h5>
                    <p class="mb-2">{{ $question->question }}</p>

                    <h3>Jawaban</h3>
                    @foreach ($question->answers as $answer)
                        <label class="block mb-1">
                            <input type="radio" name="answer_{{ $question->id }}"
                                wire:model="answers.{{ $question->id }}" value="{{ $answer->id }}" class="mr-2">
                            {{ $answer->answer_text }}
                        </label>
                    @endforeach
                </div>
            @endforeach

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Submit Answers
            </button>
        </form>
    </div>
</x-app-layout>
