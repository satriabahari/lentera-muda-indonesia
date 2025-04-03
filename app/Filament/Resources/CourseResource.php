<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Course;
use Filament\Forms\Form;
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
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\CourseResource\Pages;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected ?string $heading = 'Custom Page Heading';

    protected ?string $subheading = 'Custom Page Subheading';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Main';

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
                            ]),
                        Grid::make()
                            ->columnSpan(1)
                            ->schema([
                                Section::make()
                                    ->columns(2)
                                    ->schema([
                                        ToggleButtons::make('category')
                                            ->options([
                                                'mandiri' => 'Mandiri',
                                                'osis' => 'Osis',
                                            ])
                                            ->icons([
                                                'mandiri' => 'heroicon-o-pencil',
                                                'osis' => 'heroicon-o-clock',
                                            ])
                                            ->colors([
                                                'mandiri' => 'info',
                                                'osis' => 'warning',
                                            ])
                                            ->required(),
                                        ToggleButtons::make('status')
                                            ->options([
                                                'draft' => 'Draft',
                                                'archived' => 'Archived',
                                                'published' => 'Published'
                                            ])
                                            ->icons([
                                                'draft' => 'heroicon-o-pencil',
                                                'archived' => 'heroicon-o-clock',
                                                'published' => 'heroicon-o-check-circle',
                                            ])
                                            ->colors([
                                                'draft' => 'info',
                                                'archived' => 'warning',
                                                'published' => 'success',
                                            ])
                                            ->default('Draft')
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
                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'mandiri' => 'info',
                        'osis' => 'warning',
                    })
                    ->alignCenter(),
                ImageColumn::make('image')
                    ->disk('public')
                    ->visibility('public')
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    ->square(),
                TextColumn::make('status')
                    ->badge()
                    ->icon(fn(string $state): string => match ($state) {
                        'draft' => 'heroicon-m-pencil',
                        'archived' => 'heroicon-m-archive-box',
                        'published' => 'heroicon-m-check-circle',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'info',
                        'archived' => 'warning',
                        'published' => 'success',
                    })
                    ->alignCenter(),
                TextColumn::make("created_at")
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make("updated_at")
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
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
                    ->multiple(),

            ],)
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
                    ->label('Create course')
                    ->url(route('filament.admin.resources.courses.create'))
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
