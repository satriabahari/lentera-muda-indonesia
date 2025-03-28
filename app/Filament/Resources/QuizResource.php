<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Quiz;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuizResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuizResource\RelationManagers;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Sub Main';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("course_id")
                    ->relationship("course", "title")
                    ->required(),
                TextInput::make("title")
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->options([
                        "draft" => "Draft",
                        "published" => "Published",
                        "archived" => "Archived"
                    ])
                    ->required()
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
                TextColumn::make("status")
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
