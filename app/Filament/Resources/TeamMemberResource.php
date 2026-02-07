<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Team';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Member Information')
                    ->description('Basic information about the team member')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Enter member name'),

                                TextInput::make('position')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g., Founder/Chairman/CEO'),
                            ]),

                        FileUpload::make('image')
                            ->image()
                            ->directory('team-members')
                            ->imageEditor()
                            ->helperText('Recommended size: 800x800 pixels')
                            ->maxSize(5120)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Description')
                    ->description('Detailed information about the team member (for featured members)')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TiptapEditor::make('description')
                            ->profile('default')
                            ->tools(['bold', 'italic', 'strike', 'underline', '|', 'heading', 'bullet-list', 'ordered-list', '|', 'link', 'blockquote', 'hr', '|', 'undo', 'redo'])
                            ->placeholder('Enter detailed description (shown for featured members)')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Social Media Links')
                    ->description('Social media profiles')
                    ->icon('heroicon-o-link')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('facebook_url')
                                    ->url()
                                    ->placeholder('https://facebook.com/username')
                                    ->prefixIcon('heroicon-o-globe-alt'),

                                TextInput::make('instagram_url')
                                    ->url()
                                    ->placeholder('https://instagram.com/username')
                                    ->prefixIcon('heroicon-o-globe-alt'),

                                TextInput::make('linkedin_url')
                                    ->url()
                                    ->placeholder('https://linkedin.com/in/username')
                                    ->prefixIcon('heroicon-o-globe-alt'),

                                TextInput::make('whatsapp_url')
                                    ->url()
                                    ->placeholder('https://wa.me/1234567890')
                                    ->prefixIcon('heroicon-o-globe-alt'),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Settings')
                    ->description('Display and ordering settings')
                    ->icon('heroicon-o-cog')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Toggle::make('is_featured')
                                    ->label('Featured Member')
                                    ->helperText('Featured members show with full description')
                                    ->default(false),

                                Toggle::make('is_active')
                                    ->label('Active')
                                    ->helperText('Only active members are displayed')
                                    ->default(true),

                                TextInput::make('order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Lower numbers appear first'),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->circular()
                    ->size(50),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('position')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('is_featured')
                    ->label('Featured'),

                ToggleColumn::make('is_active')
                    ->label('Active'),

                TextColumn::make('order')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured')
                    ->placeholder('All members')
                    ->trueLabel('Featured only')
                    ->falseLabel('Regular only'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->placeholder('All members')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
