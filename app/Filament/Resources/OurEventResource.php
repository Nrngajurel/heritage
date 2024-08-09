<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurEventResource\Pages;
use App\Filament\Resources\OurEventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OurEventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('form_start_date'),
                Forms\Components\DateTimePicker::make('form_end_date'),
                Forms\Components\DateTimePicker::make('voting_start_date'),
                Forms\Components\DateTimePicker::make('voting_end_date'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\CheckboxList::make('competitions')
                    ->columns(2)
                    ->columnSpanFull()
                    ->relationship('competitions', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('form_start_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('form_end_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('voting_start_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('voting_end_date')
                    ->dateTime()
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageOurEvents::route('/'),
        ];
    }
}
