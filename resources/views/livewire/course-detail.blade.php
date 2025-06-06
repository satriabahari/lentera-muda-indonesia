<x-app-layout class="pt-32 px-16">
    {{-- Detail Course --}}
    <section class="grid grid-cols-[2fr_1.3fr] gap-32 mb-12">

        {{-- <div class="relative h-full w-full bg-white z-10">
            <div
                class="absolute bottom-0 left-0 right-0 top-0 bg-[linear-gradient(to_right,#4f4f4f2e_1px,transparent_1px),linear-gradient(to_bottom,#4f4f4f2e_1px,transparent_1px)] bg-[size:14px_24px] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_0%,#000_70%,transparent_110%)]">
            </div>
        </div> --}}

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

            <h3 class="text-3xl font-bold">{{ $course->title }}</h3>
            <p class="text-base">{{ $course->description }}</p>
        </div>

        <img class="rounded-md w-[500px] m-auto object-cover" src="{{ Storage::url('/' . $course->image) }}"
            alt="{{ $course->title }}">
    </section>

    <livewire:lesson-list :courseId="$course->id" />

    <livewire:quiz-list :quizzes="$quizzes" :studentAnswers="$studentAnswers" />

    {{-- <livewire:review-list :reviews="$reviews" /> --}}
</x-app-layout>
