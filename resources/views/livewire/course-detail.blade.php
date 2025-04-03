<x-app-layout>
    <div class="p-8 text-gray-100">
        <img class="rounded-md m-auto w-96" src="{{ Storage::url('/' . $course->image) }}" alt="{{ $course->title }}">

        <div class="grid grid-cols-[3fr_1fr]">
            <div class="space-y-4">
                <h2 class="text-3xl font-bold">{{ $course->title }}</h2>
                <p @class([
                    'rounded-full w-fit px-4 py-1 text-sm text-gray-200 bg-gray-600',
                    'bg-orange-500' => $course->category === 'osis',
                    'bg-blue-500' => $course->category === 'mandiri',
                    'bg-gray-300' => !in_array($course->category, ['osis', 'mandiri']),
                ])>
                    {{ $course->category }}
                </p>
                <p class="text-base text-gray-300">{{ $course->description }}</p>
            </div>

            <div class="space-y-4">
                <livewire:lesson-list :courseId="$course->id" />
                <livewire:quiz-list :quizzes="$quizzes" />
            </div>
        </div>
    </div>
</x-app-layout>
