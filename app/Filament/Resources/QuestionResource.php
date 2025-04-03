<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Question;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\QuestionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuestionResource\RelationManagers;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationGroup = 'Sub Main';
    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select::make("quiz_id")
                //     ->relationship("quiz", "title")
                //     ->required(),

                // TextInput::make("question")
                //     ->required(),

                // ToggleButtons::make('type')
                //     ->options([
                //         'multiple_choice' => 'Multiple Choice',
                //         'essay' => 'Essay',
                //     ])
                //     ->icons([
                //         'multiple_choice' => 'heroicon-o-pencil',
                //         'essay' => 'heroicon-o-clock',
                //     ])
                //     ->colors([
                //         'multiple_choice' => 'info',
                //         'essay' => 'warning',
                //     ])
                //     ->inline()
                //     ->required(),
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make("quiz_id")
                            ->relationship("quiz", "title")
                            ->required(),

                        TextInput::make("question")
                            ->required(),

                        ToggleButtons::make('type')
                            ->options([
                                'multiple_choice' => 'Multiple Choice',
                                'essay' => 'Essay',
                            ])
                            ->icons([
                                'multiple_choice' => 'heroicon-o-pencil',
                                'essay' => 'heroicon-o-clock',
                            ])
                            ->colors([
                                'multiple_choice' => 'info',
                                'essay' => 'warning',
                            ])
                            ->inline()
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("No.")
                    ->rowIndex()
                    ->alignCenter(),
                TextColumn::make("quiz.title")->label("Quiz"),
                TextColumn::make("question")
                    ->searchable(),
                TextColumn::make("type"),

            ])
            ->filters([
                SelectFilter::make("quiz.title")
                    ->relationship("quiz", "title"),
                SelectFilter::make("type")
                    ->options([
                        'multiple_choice' => 'Multiple Choice',
                        'essay' => 'Essay',
                    ])
            ])
            ->filtersTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label('Filter'),
            )
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
                    ->label('Create question')
                    ->url(route('filament.admin.resources.questions.create'))
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Questions';
    }
}
