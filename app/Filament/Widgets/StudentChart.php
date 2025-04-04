<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class StudentChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static string $color = 'danger';

    public ?string $filter = 'today';

    protected function getData(): array
    {
        $activeFilter = $this->filter;
        
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getFilters(): ?array
{
    return [
        'today' => 'Today',
        'week' => 'Last week',
        'month' => 'Last month',
        'year' => 'This year',
    ];
}

    protected function getType(): string
    {
        return 'line';
    }
}
