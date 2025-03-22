<?php

namespace App\Filament\Resources\OurEventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
class ContestantsRelationManager extends RelationManager
{
    protected static string $relationship = 'contestants';

    protected static ?string $recordTitleAttribute = 'name';


    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('image_url')
                ->label('Profile Image')
                ->image()
                ->imageEditor()
                ->directory('contestants/images')
                ->imageResizeMode('cover')
                ->imageCropAspectRatio('1:1')
                ->required(),
            Forms\Components\Grid::make([
                'default' => 2,
                'sm' => 3,
            ])->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country_code')
                    ->required()
                    ->maxLength(2)
                    ->placeholder('US'),
                Forms\Components\TextInput::make('social_media')
                    ->maxLength(255)
                    ->url(),
                Forms\Components\Toggle::make('is_featured')
                    ->default(false)
                    ->inline(false),
            ]),
            Forms\Components\RichEditor::make('bio')
                ->toolbarButtons([
                    'bold',
                    'italic',
                    'link',
                    'bulletList',
                    'orderedList',
                ])
                ->columnSpanFull()
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')->label("Image")
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('focus_area')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('votes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->label('Action')
            ])
            ->bulkActions([

                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('bulk_edit')
                        ->label('Bulk Edit')
                        ->icon('heroicon-o-pencil-square')
                        ->modalHeading('Bulk Edit Contestants')
                        ->modalSubmitActionLabel('Save Changes')
                        ->modalWidth('7xl')
                        ->form(fn($records) => [
                            Forms\Components\Repeater::make('records')
                                ->schema([
                                    Forms\Components\Hidden::make('id'),
                                    Forms\Components\Section::make()
                                        ->schema([
                                            Forms\Components\Grid::make()
                                                ->schema([
                                                    Forms\Components\FileUpload::make('image_url')
                                                        ->image()
                                                        ->imageEditor()
                                                        ->directory('contestants/images')
                                                        ->columnSpan(1),
                                                    Forms\Components\TextInput::make('name')
                                                        ->required()
                                                        ->columnSpan(1),
                                                    Forms\Components\TextInput::make('country')
                                                        ->required()
                                                        ->columnSpan(1),
                                                    Forms\Components\TextInput::make('title')
                                                        ->required()
                                                        ->columnSpan(1),
                                                    Forms\Components\Toggle::make('is_featured')
                                                        ->inline()
                                                        ->columnSpan(1),
                                                ])
                                                ->columns(6)
                                                ->columnSpanFull(),
                                        ])
                                ])
                                ->grid(1)
                                ->columnSpanFull()
                                ->default(fn() => $records->map(fn($record) => [
                                    'id' => $record->id,
                                    'image_url' => (array) $record->image_url,
                                    'name' => $record->name,
                                    'country' => $record->country,
                                    'title' => $record->title,
                                    'focus_area' => $record->focus_area,
                                    'is_featured' => $record->is_featured,
                                ])->toArray())
                        ])
                        ->action(function (array $data) {
                            foreach ($data['records'] as $recordData) {
                                $contestant = \App\Models\Contestant::find($recordData['id']);
                                if ($contestant) {
                                    $contestant->update([
                                        'image_url' => $recordData['image_url'] ?? $contestant->image_url,
                                        'name' => $recordData['name'],
                                        'country' => $recordData['country'],
                                        'title' => $recordData['title'],
                                        'focus_area' => $recordData['focus_area'],
                                        'is_featured' => $recordData['is_featured'],
                                    ]);
                                }
                            }
    
                            Notification::make()
                                ->success()
                                ->title('Contestants updated')
                                ->body('Selected contestants have been updated')
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ])
            ])
        ;
    }
}
