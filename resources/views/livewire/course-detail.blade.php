<x-app-layout class="pt-32 px-16">
    <section class="grid grid-cols-[2fr_1.3fr] gap-32 mb-12">
        <div class="space-y-4">
            <div class="flex gap-4">
                <div data-aos="fade-down" @class([
                    'py-1 px-2 rounded-md text-sm w-fit border-2 font-semibold',
                    'bg-orange-50 border-orange-500 text-orange-500' =>
                        $course->studentType->name === 'Lentera Academy',
                    'bg-indigo-50 border-indigo-500 text-indigo-500' =>
                        $course->studentType->name === 'Lentera Course',
                    'bg-neutral-50 border-neutral-500 text-neutral-500' => !in_array(
                        $course->studentType->name,
                        ['Lentera Course', 'Lentera Academy']),
                ])>
                    {{ $course->studentType->name }}
                </div>

                @if ($courseCompletion && $courseCompletion->is_completed)
                    <div data-aos="fade-down"
                        class="py-1 px-2 text-green-600 rounded-md text-sm w-fit bg-green-50 border-2 font-semibold border-green-500">
                        ✅ Telah Selesai. Skor rata-rata: {{ number_format($courseCompletion->score, 2) }}
                    </div>
                @endif
            </div>

            <h3 data-aos="fade-right" class="text-3xl font-bold text-cyan-900">{{ $course->title }}</h3>
            <p data-aos="fade-right" data-aos-delay="200" class="text-base">{{ $course->description }}</p>
        </div>

        <img data-aos="fade-left" data-aos-delay="200"  class="rounded-md w-[500px] m-auto object-cover" src="{{ Storage::url('/' . $course->image) }}"
            alt="{{ $course->title }}">
    </section>

    <livewire:lesson-list :courseId="$course->id" />

    <livewire:quiz-list :quizzes="$quizzes" :studentAnswers="$studentAnswers" />

    @if ($certificate)
        <livewire:certificate-preview :certificate="$certificate" />
    @endif
</x-app-layout>
