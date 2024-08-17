<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventApplicationResource\Pages;
use App\Filament\Resources\EventApplicationResource\RelationManagers;
use App\Models\Application;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;

class EventApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('event_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('competition_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required(),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('meta'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('competition.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->searchable(),
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
                Tables\Actions\Action::make('pdf')
                    ->label('PDF Download')
                    ->icon('heroicon-o-document')
                    ->action(function (Model $record) {
                        return response()->streamDownload(function () use ($record) {
                            echo Pdf::loadHtml(
                                Blade::render('filament.resources.application.pages.view-application', [
                                    'record' => $record,
                                    'exportPdf'=> true
                                ])
                            )->stream();
                        }, $record->id . $record->full_name . '.pdf');
                    }),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])->label('Action')
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

    // public static function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->schema([
    //             // Basic Information
    //             // Heading::make('Basic Information')->size('xl')->weight('semibold'),
    //             Grid::make(4)
    //                 ->schema([
    //                     TextEntry::make('country')
    //                         ->label('Country'),
    //                     TextEntry::make('competition.name')
    //                         ->label('Competition Name'),
    //                     TextEntry::make('full_name')
    //                         ->label('Full Name'),
    //                     TextEntry::make('email')
    //                     ->label('Email'),
    //                     TextEntry::make('phone')
    //                     ->label('Phone'),
    //                 ]),

    //             // Address
    //             // Heading::make('Address')->size('xl')->weight('semibold')->extraAttributes(['class' => 'mt-5']),
    //             Grid::make(4)
    //                 ->schema([
    //                     TextEntry::make('address.address_line_1')
    //                     ->label('Address Line 1'),
    //                     TextEntry::make('address.city')
    //                     ->label('City'),
    //                     TextEntry::make('address.state')
    //                     ->label('State'),
    //                     TextEntry::make('address.zip')
    //                     ->label('ZIP Code'),
    //                 ]),

    //             // Personal Background
    //             // Heading::make('PERSONAL BACKGROUND')->size('xl')->weight('semibold')->extraAttributes(['class' => 'mt-5']),
    //             // Grid::make(3)
    //             //     ->schema(
    //             //         array_map(
    //             //             fn($subKey, $subValue) => TextEntry::make($subKey)
    //             //                 ->label(ucwords(str_replace('_', ' ', $subKey)))
    //             //                 ->value(fn() => $subValue)
    //             //                 ->extraAttributes(['class' => 'border-b-2 p-3 mt-2']),
    //             //             array_keys($this->record['meta']['personal_background']),
    //             //             $this->record['meta']['personal_background']
    //             //         )
    //             //     ),

    //             // Outlook
    //             // Heading::make('OUTLOOK')->size('xl')->weight('semibold')->extraAttributes(['class' => 'mt-5']),
    //             // Grid::make(3)
    //             //     ->schema(
    //             //         array_map(
    //             //             fn($subKey, $subValue) => TextEntry::make($subKey)
    //             //                 ->label(ucwords(str_replace('_', ' ', $subKey)))
    //             //                 ->value(fn() => $subValue)
    //             //                 ->extraAttributes(['class' => 'border-b-2 p-3 mt-2']),
    //             //             array_keys($this->record['meta']['outlook']),
    //             //             $this->record['meta']['outlook']
    //             //         )
    //             //     ),

    //             // More
    //             // Heading::make('MORE')->size('xl')->weight('semibold')->extraAttributes(['class' => 'mt-5']),
    //             // Grid::make(3)
    //             //     ->schema(
    //             //         array_map(
    //             //             fn($subKey, $subValue) => TextEntry::make($subKey)
    //             //                 ->label(ucwords(str_replace('_', ' ', $subKey)))
    //             //                 ->value(fn() => $subValue)
    //             //                 ->extraAttributes(['class' => 'border-b-2 p-3 mt-2']),
    //             //             array_keys($this->record['meta']['more']),
    //             //             $this->record['meta']['more']
    //             //         )
    //             //     ),

    //             // Personal Statement
    //             // Heading::make('PERSONAL STATEMENT')->size('xl')->weight('semibold')->extraAttributes(['class' => 'mt-5']),
    //             // TextEntry::make('personal_statement')
    //             // ->label('Personal Statement')
    //             // ->value(fn() => $this->record['meta']['personal_statement'])
    //             // ->extraAttributes(['class' => 'border-b-2 p-3 mt-2']),

    //             // Media
    //             // Grid::make(3)
    //             //     ->schema([
    //             //         MediaEntry::make('headshot_photo')
    //             //         ->label('HeadShot')
    //             //         ->value(fn() => $this->record->getFirstMedia('headshot_photo'))
    //             //         ->extraAttributes(['class' => 'mt-5']),
    //             //         MediaEntry::make('waist_up_photo')
    //             //         ->label('Waist up photo')
    //             //         ->value(fn() => $this->record->getFirstMedia('waist_up_photo'))
    //             //         ->extraAttributes(['class' => 'mt-5']),
    //             //         MediaEntry::make('passport_copy')
    //             //         ->label('Passport Copy')
    //             //         ->value(fn() => $this->record->getFirstMedia('passport_copy'))
    //             //         ->extraAttributes(['class' => 'mt-5']),
    //             //     ]),
    //         ]);
    // }





    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventApplications::route('/'),
            'create' => Pages\CreateEventApplication::route('/create'),
            'view' => Pages\ViewEventApplication::route('/{record}'),
            'edit' => Pages\EditEventApplication::route('/{record}/edit'),
        ];
    }
}
