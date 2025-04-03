<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Student;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentResource\RelationManagers;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\Action;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Others';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Full Name')
                    ->required()
                    ->maxLength(255),

                Textarea::make('address')
                    ->label('Home Address')
                    ->rows(2),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->hiddenOn('edit'),

                Select::make('role_id')
                    ->label('Role')
                    ->relationship('role', 'name')
                    ->disabled()
                    ->hidden()
                    ->required(),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel(),


                TextInput::make('school_name')
                    ->label('School Name')
                    ->required(),

                Textarea::make('school_address')
                    ->label('School Address')
                    ->rows(2),
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
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->iconColor('info')
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),

                TextColumn::make('role.name')
                    ->label('Role')
                    ->hidden()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->icon('heroicon-m-phone')
                    ->iconColor('info')
                    ->copyable()
                    ->copyMessage('Phone copied')
                    ->copyMessageDuration(1500)
                    ->searchable(),

                TextColumn::make('address')
                    ->label('Home Address')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->address),

                TextColumn::make('school_name')
                    ->label('School Name')
                    ->sortable(),

                TextColumn::make('school_address')
                    ->label('School Address')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->school_address),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('school_name')
                    ->options(Student::query()->pluck('school_name', 'school_name')->toArray()),
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
                    ->label('Create student')
                    ->url(route('filament.admin.resources.students.create'))
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Students';
    }
}
