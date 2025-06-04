<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentTypeResource\Pages;
use App\Filament\Resources\StudentTypeResource\RelationManagers;
use App\Models\StudentType;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;

class StudentTypeResource extends Resource
{
    protected static ?string $model = StudentType::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'User Access';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Student Type Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("No")
                    ->rowIndex()
                    ->alignCenter(),
                TextColumn::make('name')
                    ->label('Student Type')
                    ->searchable()
                    ->sortable(),
                TextColumn::make("created_at")
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make("updated_at")
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
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
                    ->label('Create Student Type')
                    ->url(route('filament.admin.resources.student-types.create'))
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
            'index' => Pages\ListStudentTypes::route('/'),
            'create' => Pages\CreateStudentType::route('/create'),
            'edit' => Pages\EditStudentType::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Student Types';
    }
}
