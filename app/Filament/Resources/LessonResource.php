<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Lesson;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\LessonResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LessonResource\RelationManagers;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Main';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Select::make('course_id')
                            ->relationship("course", "title")
                            ->required(),

                        TextInput::make('video_url')
                            ->label('Video URL')
                            ->url(),

                        ToggleButtons::make('is_active')
                            ->boolean()
                            ->inline()
                            ->grouped()
                            ->required(),
                    ])
                    ->columns(2),
                Section::make()
                    ->schema([
                        RichEditor::make('content')
                            ->required()
                            ->columnSpan(2),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No.')
                    ->rowIndex()
                    ->alignCenter(),
                TextColumn::make('course.title')->label('Course'),
                TextColumn::make('title')->searchable(),
                // ->description(fn(Lesson $record): string => $record->content),
                TextColumn::make('content')
                    ->limit(30),
                TextColumn::make('video_url')
                    ->limit(30)
                    ->icon('heroicon-m-video-camera')
                    ->iconColor(Color::Sky)
                    ->copyable()
                    ->copyMessage('Video URL copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),
                // ->wrap(),
                // ->limit(50)
                // ->tooltip(function (TextColumn $column): ?string {
                //     $state = $column->getState();

                //     if (strlen($state) <= $column->getCharacterLimit()) {
                //         return null;
                //     }

                //     // Only render the tooltip if the column content exceeds the length limit.
                //     return $state;
                // }),
                IconColumn::make('is_active')
                    ->boolean()
                    ->alignCenter(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make("course.title")
                    ->relationship("course", "title")
                    ->searchable()
                    ->multiple(),
                SelectFilter::make("is_active")
                    ->options([
                        '1' => 'True',
                        '0' => 'False',
                    ]),
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
                    ->label('Create Lesson')
                    ->url(route('filament.admin.resources.lessons.create'))
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Lessons';
    }
}
