<x-app-layout class="p-16">
    {{-- Detail Course --}}
    <section class="flex gap-64 mb-12">
        <div class="space-y-4">
            <div @class([
                'rounded-full w-fit px-4 py-1 text-sm text-gray-200 bg-gray-600',
                'bg-orange-500' => $course->category === 'osis',
                'bg-blue-500' => $course->category === 'mandiri',
                'bg-gray-300' => !in_array($course->category, ['osis', 'mandiri']),
            ])>
                {{ $course->category }}
            </div>

            <h3 class="text-3xl font-bold">{{ $course->title }}</h3>
            <p class="text-lg">{{ $course->description }}</p>
        </div>

        <img class="rounded-md m-auto w-96" src="{{ Storage::url('/' . $course->image) }}" alt="{{ $course->title }}">
    </section>

    <livewire:lesson-list :courseId="$course->id" />

    <livewire:quiz-list :quizzes="$quizzes" />

    <livewire:review-list :reviews="$reviews" />
</x-app-layout>
