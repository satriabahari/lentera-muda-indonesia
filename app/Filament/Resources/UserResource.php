<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'Others';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama lengkap'),
                TextInput::make("email")
                    ->email()
                    ->required()
                    ->unique(User::class, 'email')
                    ->placeholder('Masukkan email'),
                TextInput::make("password")
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->placeholder('Masukkan password'),
                Select::make('role_id')
                    ->relationship("role", "name")
                    ->required(),
                DateTimePicker::make('created_at')
                    ->label('Dibuat Pada')
                    ->disabled(),
                DateTimePicker::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No.')
                    ->rowIndex()
                    ->alignCenter(),
                TextColumn::make("name")
                    ->searchable(),
                TextColumn::make("email")
                    ->searchable(),
                // TextColumn::make("role")
                //     ->sortable(),
                TextColumn::make("role.name"),
                TextColumn::make("remember_token")
                    ->hidden(),
                TextColumn::make("created_at")
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make("updated_at")
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Users';
    }

    public static function canViewAny(): bool
    {
        return Filament::auth()->user()->role_id === 1;
    }
}
