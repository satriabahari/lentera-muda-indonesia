<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms;
use App\Models\CourseCompletion;
use Filament\Forms\Form;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\CourseCompletionResource\Pages;
use Filament\Forms\Components\ToggleButtons;

class CourseCompletionResource extends Resource
{
    protected static ?string $model = CourseCompletion::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationGroup = 'Student Progress';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(2)
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->label('User'),

                        Select::make('course_id')
                            ->relationship('course', 'title')
                            ->required()
                            ->label('Course'),

                        TextInput::make('score')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->required()
                            ->label('Score'),

                        ToggleButtons::make('is_completed')
                            ->boolean()
                            ->inline()
                            ->grouped()
                            ->required(),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No.')
                    ->rowIndex()
                    ->alignCenter(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),
                TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable(),
                TextColumn::make('score')
                    ->sortable()
                    ->alignCenter()
                    ->label('Score'),
                IconColumn::make('is_completed')
                    ->boolean()
                    ->alignCenter(),
                TextColumn::make("created_at")
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make("updated_at")
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('course_id')
                    ->relationship('course', 'title')
                    ->label('Course'),

                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User'),

                SelectFilter::make("is_completed")
                    ->options([
                        '1' => 'True',
                        '0' => 'False',
                    ]),
            ])
            ->filtersTriggerAction(
                fn(Action $action) => $action->button()->label('Filter'),
            )
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->button()
                    ->label('Actions')
                    ->color('primary')
                    ->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Action::make('create')
                    ->label('Create Course Completion')
                    ->url(route('filament.admin.resources.course-completions.create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->striped();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseCompletions::route('/'),
            'create' => Pages\CreateCourseCompletion::route('/create'),
            'edit' => Pages\EditCourseCompletion::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Course Completions';
    }
}
