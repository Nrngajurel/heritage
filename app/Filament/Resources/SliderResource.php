<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 1,
                    'lg' => 12,
                ])->schema([
                    Section::make('Main Content')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 8,
                        ])
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255),
                            Grid::make(2)->schema([
                                TextInput::make('link')
                                    ->url()
                                    ->maxLength(255),
                                TextInput::make('link_text')
                                    ->maxLength(255),
                            ]),
                            RichEditor::make('content')
                                ->columnSpanFull(),
                        ]),
                    Section::make(heading: 'Slider Configuration')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 4,
                        ])
                        ->schema([
                            FileUpload::make('image_path')
                                ->label('Slider Image')
                                ->image()
                                ->imagePreviewHeight('250')
                                ->directory('slider')
                                ->required(),
                            Select::make('location')
                                ->label('Display Location')
                                ->options(Slider::getLocations())
                                ->required(),
                            TextInput::make('sort_order')
                                ->label('Display Order')
                                ->numeric()
                                ->default(fn() => Slider::max('sort_order') + 1),
                            Toggle::make('is_active')
                                ->label('Active Status')
                                ->default(true),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('location')
                    ->badge()
                    ->formatStateUsing(fn($state) => Slider::getLocations()[$state] ?? $state),
                TextColumn::make('sort_order')
                    ->sortable(),
                ToggleColumn::make('is_active'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order');
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
