<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use Filament\Widgets\ChartWidget;

class LessonPerCourseChart extends ChartWidget
{
    protected static ?string $heading = 'Lesson per Course';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $courses = Course::withCount('lessons')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Lesson',
                    'data' => $courses->pluck('lessons_count')->toArray(),
                    'backgroundColor' => [
                        '#ef4444',
                        '#f97316',
                        '#22c55e',
                        '#3b82f6',
                        '#d946ef',
                        '#737373',
                        '#84cc16',
                        '#8b5cf6'
                    ]
                ],
            ],
            'labels' => $courses->pluck('title')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
