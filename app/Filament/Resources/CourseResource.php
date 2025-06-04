<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\ToggleButtons;
use Filament\Tables;
use App\Models\Course;
use Filament\Forms\Form;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Toggle;
use App\Filament\Resources\CourseResource\Pages;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected ?string $heading = 'Custom Page Heading';

    protected ?string $subheading = 'Custom Page Subheading';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(2)
                    ->schema([
                        Section::make()
                            ->columnSpan(1)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->rows(8)
                                    ->required(),

                                Select::make('student_type_id')
                                    ->relationship('studentType', 'name')
                                    ->required()
                                    ->label('Student Type'),
                            ]),
                        Grid::make()
                            ->columnSpan(1)
                            ->schema([
                                Section::make()
                                    ->columns(2)
                                    ->schema([
                                        ToggleButtons::make('is_active')
                                            ->boolean()
                                            ->inline()
                                            ->grouped()
                                            ->required(),
                                    ]),
                                Section::make()
                                    ->schema([
                                        FileUpload::make('image')
                                            ->directory('courses')
                                            ->disk('public')
                                            ->image()
                                            ->imageEditor()
                                            ->visibility('public')
                                            ->maxSize(2048)
                                            ->required(),
                                    ])
                            ])
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
                TextColumn::make('title')->searchable(),
                ImageColumn::make('image')
                    ->disk('public')
                    ->visibility('public')
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->square(),
                TextColumn::make('studentType.name')->label('Student Type'),

                IconColumn::make('is_active')
                    ->boolean()
                    ->alignCenter(),
                TextColumn::make("created_at")
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make("updated_at")
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make("student_type_id")
                    ->relationship("studentType", "name"),

                SelectFilter::make("is_active")
                    ->options([
                        true => 'Active',
                        false => 'Inactive',
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
                    ->label('Create Course')
                    ->url(route('filament.admin.resources.courses.create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->striped();
    }

    public static function getRelations(): array
    {
        return [];
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
