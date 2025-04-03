<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Review;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\ReviewResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ReviewResource\RelationManagers;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    protected static ?string $navigationGroup = 'Main';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_id')
                    ->relationship("course", "title")
                    ->required(),

                Select::make('user_id')
                    ->relationship("user", "name")
                    ->required(),

                Radio::make('rating')
                    ->label('Rating')
                    ->options([
                        1 => '⭐',
                        2 => '⭐⭐',
                        3 => '⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        5 => '⭐⭐⭐⭐⭐',
                    ])
                    ->required(),

                Textarea::make('comment')
                    ->required(),

                ToggleButtons::make('is_active')
                    ->boolean()
                    ->inline()
                    ->grouped()
                    ->columnStart(2)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No.')
                    ->rowIndex()
                    ->alignCenter(),
                TextColumn::make('course.title')
                    ->label('Course')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('User'),
                TextColumn::make('rating')
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('comment')
                    ->limit(50)
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->alignCenter(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make("course.title")
                    ->relationship("course", "title"),
                SelectFilter::make("user.name")
                    ->relationship("user", "name"),
                SelectFilter::make("rating")
                    ->options([
                        1 => '⭐',
                        2 => '⭐⭐',
                        3 => '⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        5 => '⭐⭐⭐⭐⭐',
                    ]),
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
            ->filtersTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label('Filter'),
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Action::make('create')
                    ->label('Create review')
                    ->url(route('filament.admin.resources.reviews.create'))
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Review';
    }
}
