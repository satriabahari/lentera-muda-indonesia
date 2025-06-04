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
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms\Components\Group as ComponentsGroup;
use Forms\Components\Group;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'User Access';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(User::class, 'email'),

                TextInput::make('password')
                    ->password()
                    ->minLength(8)
                    ->dehydrated(fn($state) => filled($state)) // hanya update jika terisi
                    ->nullable(),

                Select::make('role_id')
                    ->relationship('role', 'name')
                    ->required()
                    ->live(), // penting agar bisa reactive

                ComponentsGroup::make([
                    Select::make('studentProfile.student_type_id')
                        ->label('Tipe Siswa')
                        ->relationship('studentProfile.studentType', 'name')
                        ->required(),

                    TextInput::make('studentProfile.address')
                        ->label('Alamat'),

                    TextInput::make('studentProfile.school_name')
                        ->label('Nama Sekolah'),

                    TextInput::make('studentProfile.school_address')
                        ->label('Alamat Sekolah'),
                ])
                    ->columns(2)
                    ->visible(fn(Forms\Get $get) => $get('role_id') == 3),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No.')
                    ->rowIndex()
                    ->alignCenter(),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->iconColor('info')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('role.name'),

                TextColumn::make('studentProfile.studentType.name')
                    ->label('Student Type')
                    ->sortable()
                    ->formatStateUsing(fn($state, $record) => $record->role_id === 3 ? $state : '-')
                    ->placeholder('-'),

                TextColumn::make('studentProfile.phone')
                    ->label('Phone')
                    ->sortable()
                    ->formatStateUsing(fn($state, $record) => $record->role_id === 3 ? $state : '-')
                    ->placeholder('-'),


                TextColumn::make('studentProfile.address')
                    ->label('Address')
                    ->sortable()
                    ->formatStateUsing(fn($state, $record) => $record->role_id === 3 ? $state : '-')
                    ->placeholder('-'),

                TextColumn::make('studentProfile.school_name')
                    ->label('School')
                    ->sortable()
                    ->formatStateUsing(fn($state, $record) => $record->role_id === 3 ? $state : '-')
                    ->placeholder('-'),

                TextColumn::make('studentProfile.school_address')
                    ->label('School')
                    ->sortable()
                    ->formatStateUsing(fn($state, $record) => $record->role_id === 3 ? $state : '-')
                    ->placeholder('-'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make("role_id")
                    ->relationship("role", "name"),
                SelectFilter::make("student_type_id")
                    ->relationship("studentProfile.studentType", "name"),
                SelectFilter::make("school_name")
                    ->relationship("studentProfile", "school_name"),
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
                    ->label('Create User')
                    ->url(route('filament.admin.resources.users.create'))
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
