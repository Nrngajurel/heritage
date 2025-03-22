<?php

namespace App\Filament\Resources\OurEventResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;

class ContestantsRelationManager extends RelationManager
{
    protected static string $relationship = 'contestants';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country_code')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('focus_area')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('bio')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('image_url')
                    ->url()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_featured')
                    ->default(false),
                Forms\Components\TextInput::make('social_media')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gallery')
                    ->maxLength(255),
                Forms\Components\TextInput::make('quotes')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
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
                ]),
            ]);
    }
}