<?php

namespace App\Filament\Resources;

use App\Models\Quiz;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\QuizResource\Pages;
use Filament\Tables\Actions\ActionGroup;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Sub Main';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make("title")
                            ->required()
                            ->maxLength(255),
                        Select::make("course_id")
                            ->relationship("course", "title")
                            ->required(),
                        ToggleButtons::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'archived' => 'Archived',
                                'published' => 'Published'
                            ])
                            ->icons([
                                'draft' => 'heroicon-o-pencil',
                                'archived' => 'heroicon-o-clock',
                                'published' => 'heroicon-o-check-circle',
                            ])
                            ->colors([
                                'draft' => 'info',
                                'archived' => 'warning',
                                'published' => 'success',
                            ])
                            ->required(),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No.')
                    ->rowIndex()
                    ->alignCenter(),
                TextColumn::make('title')->searchable(),
                TextColumn::make("course.title")->label("Course"),
                TextColumn::make('status')
                    ->badge()
                    ->icon(fn(string $state): string => match ($state) {
                        'draft' => 'heroicon-m-pencil',
                        'archived' => 'heroicon-m-archive-box',
                        'published' => 'heroicon-m-check-circle',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'info',
                        'archived' => 'warning',
                        'published' => 'success',
                    })
                    ->alignCenter()
            ])
            ->filters([
                SelectFilter::make("course.title")
                    ->relationship("course", "title")
                    ->searchable()
                    ->multiple(),
                SelectFilter::make("status")
                    ->options([
                        "draft" => "Draft",
                        "published" => "Published",
                        "archived" => "Archived"
                    ])
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->button()
                    ->label('Actions')
                    ->color(Color::Sky)
                    ->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Action::make('create')
                    ->label('Create Quiz')
                    ->url(route('filament.admin.resources.quizzes.create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->striped();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Quizzes';
    }
}
