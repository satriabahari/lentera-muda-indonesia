<?php

namespace App\Filament\Widgets;

use App\Models\CourseCompletion;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected ?string $heading = 'Analytics Overview';

    protected ?string $description = 'A quick summary of system activity and growth.';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('+' . User::count() . ' new users today')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([10, 12, 15, 9, 17, 19, 22])
                ->color('success'),

            Stat::make('Total Courses', Course::count())
                ->description('+' . Course::count() . ' new courses')
                ->descriptionIcon('heroicon-m-book-open')
                ->chart([3, 5, 7, 10, 13, 12, 15])
                ->color('info'),

            Stat::make('Total Lessons', Lesson::count())
                ->description(Lesson::count() . ' lessons added this week')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->chart([5, 6, 6, 8, 9, 10, 11])
                ->color('primary'),

            Stat::make('Course Completions', CourseCompletion::count())
                ->description('+' . CourseCompletion::count() . ' completions recorded')
                ->descriptionIcon('heroicon-m-check-badge')
                ->chart([2, 5, 3, 6, 8, 11, 14])
                ->color('warning'),
        ];
    }
}
