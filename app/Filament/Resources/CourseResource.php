<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseResource\RelationManagers;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Main';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->required(),

                FileUpload::make('image')
                    ->image()
                    ->directory('course-images')
                    ->required(),

                Select::make('category')
                    ->options([
                        'mandiri' => 'Mandiri',
                        'osis' => 'OSIS',
                    ])
                    ->required(),

                Select::make('status')
                    ->options([
                        'Draft' => 'Draft',
                        'Published' => 'Published',
                        'Archived' => 'Archived',
                    ])
                    ->default('Draft')
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
                TextColumn::make('title')->searchable(),
                TextColumn::make('category')->label('Category'),
                ImageColumn::make('image'),
                TextColumn::make('status')->alignCenter(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                SelectFilter::make("category")
                    ->options([
                        'mandiri' => 'Mandiri',
                        'osis' => 'OSIS',
                    ]),

                SelectFilter::make("status")
                    ->options([
                        'Draft' => 'Draft',
                        'Published' => 'Published',
                        'Archived' => 'Archived',
                    ])
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Total Courses';
    }
}
