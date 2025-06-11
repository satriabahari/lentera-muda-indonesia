<?php

namespace App\Filament\Widgets;

use App\Models\StudentType;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static ?string $heading = 'Student per student type';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $studentTypes = StudentType::withCount('courses')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Course',
                    'data' => $studentTypes->pluck('courses_count'),
                    'backgroundColor' => [
                        '#6366F1',
                        '#F59E0B',

                    ],
                ],
            ],
            'labels' => $studentTypes->pluck('name'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
