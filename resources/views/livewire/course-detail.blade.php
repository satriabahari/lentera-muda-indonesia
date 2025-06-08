<x-app-layout class="pt-32 px-16">
    <section class="grid grid-cols-[2fr_1.3fr] gap-32 mb-12">
        <div class="space-y-4">
            <div @class([
                'py-1 px-2 text-neutral-50 rounded-md text-sm w-fit',
                'bg-orange-500' => $course->studentType->name === 'Lentera Course',
                'bg-green-500' => $course->studentType->name === 'Lentera Academy',
                'bg-gray-300' => !in_array($course->category, [
                    'Lentera Course',
                    'Lentera Academy',
                ]),
            ])>
                {{ $course->studentType->name }}
            </div>

            <h3 class="text-3xl font-bold text-cyan-900">{{ $course->title }}</h3>
            <p class="text-base">{{ $course->description }}</p>
        </div>

        <img class="rounded-md w-[500px] m-auto object-cover" src="{{ Storage::url('/' . $course->image) }}"
            alt="{{ $course->title }}">
    </section>

    <livewire:lesson-list :courseId="$course->id" />

    <livewire:quiz-list :quizzes="$quizzes" :studentAnswers="$studentAnswers" />

    @if ($certificate)
        <livewire:certificate-preview :certificate="$certificate" />
    @endif
</x-app-layout>
