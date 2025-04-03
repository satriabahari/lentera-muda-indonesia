<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Answer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\AnswerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AnswerResource\RelationManagers;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Sub Main';
    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("question_id")
                    ->relationship("question", "question")
                    ->required(),
                ToggleButtons::make('is_active')
                    ->boolean()
                    ->inline()
                    ->grouped()
                    ->required(),
                Textarea::make("answer")
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("No.")
                    ->rowIndex()
                    ->alignCenter(),
                TextColumn::make("question.question"),
                TextColumn::make("answer")
                    ->searchable(),
                IconColumn::make("is_correct")->boolean()
            ])
            ->filters([
                SelectFilter::make('question.question')
                    ->relationship('question', 'question'),
                SelectFilter::make('is_correct')
                    ->options([
                        '1' => 'True',
                        '0' => 'False',
                    ]),
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
                    ->label('Create answer')
                    ->url(route('filament.admin.resources.answers.create'))
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
            'index' => Pages\ListAnswers::route('/'),
            'create' => Pages\CreateAnswer::route('/create'),
            'edit' => Pages\EditAnswer::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Answers';
    }
}
