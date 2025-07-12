<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Tables;
use FilamentTiptapEditor\TiptapEditor;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Post Details')
                    ->description('Enter post details and content')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn(string $operation, $state, callable $set) =>
                                        $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    )
                                    ->placeholder('Enter post title')
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(Page::class, 'slug', ignoreRecord: true)
                                    ->placeholder('URL-friendly name')
                                    ->helperText('This will be automatically generated from the title'),
                            ]),


                        // RichEditor::make('description')
                        //     ->columnSpanFull()
                        //     ->required(
                        //         fn(Get $get): bool =>
                        //         Category::find($get('category_id'))?->type === Category::TYPE_REGULAR
                        //     )
                        //     ->toolbarButtons([
                        //         'bold',
                        //         'italic',
                        //         'link',
                        //         'orderedList',
                        //         'unorderedList',
                        //         'h2',
                        //         'h3',
                        //     ])
                        //     ->placeholder('Write your post content here...'),

                        TiptapEditor::make('description')
                            ->profile('default')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->collapsible(),
                Section::make('SEO Information')
                    ->description('Optimize for search engines')
                    ->icon('heroicon-o-magnifying-glass')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('meta_title')
                                    ->placeholder('SEO optimized title')
                                    ->helperText('Leave empty to use post title'),
                                TextInput::make('meta_keywords')
                                    ->placeholder('keyword1, keyword2')
                                    ->helperText('Comma separated keywords'),
                            ]),
                        TextInput::make('meta_description')
                            ->placeholder('Brief description for search results')
                            ->helperText('Recommended length: 150-160 characters')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Media & Publishing')
                    ->description('Upload media content and manage visibility')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->directory('posts')
                            ->columnSpanFull()
                            ->imageEditor()
                            ->helperText('Recommended size: 1200x630 pixels')
                            ->maxSize(5120),

                        Toggle::make('is_published')
                            ->label('Published')
                            ->helperText('Toggle to make this post publicly visible')
                            ->default(false),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('title')
                    ->searchable(),

                ToggleColumn::make('is_published'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
