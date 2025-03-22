<?php

namespace App\Filament\Resources\OurEventResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Blade;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    protected static ?string $recordTitleAttribute = 'first_name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('first_name')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('last_name')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('address')
                //     ->required(),
                // Forms\Components\TextInput::make('country')
                //     ->required()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('email')
                //     ->email()
                //     ->maxLength(255),
                // Forms\Components\TextInput::make('phone')
                //     ->tel()
                //     ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('pending'),
            ]);
    }

    public function table(Table $table): Table
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                    ->label('PDF Download')
                    ->icon('heroicon-o-document')
                    ->action(function (Model $record) {
                        return response()->streamDownload(function () use ($record) {
                            echo Pdf::loadHtml(
                                Blade::render('filament.resources.application.pages.view-application', [
                                    'records' => [$record],
                                    'exportPdf'=> true
                                ])
                            )->stream();
                        }, $record->id . 'application-form.pdf');
                    }),
                Tables\Actions\Action::make('make_contestant')
                    ->label('Make Contestant')
                    ->icon('heroicon-o-user-plus')
                    ->action(function (Model $record) {
                        $record->registerAsContestant();;
                        
                    })
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Contestant created')
                            ->body('The contestant has been created successfully.')
                    ),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('View')
                        ->icon('heroicon-o-eye')
                        ->modalContent(fn (Model $record) => view(
                            'filament.resources.application.pages.view-application',
                            ['records' => [$record], 'exportPdf' => false]
                        )),
                    Tables\Actions\EditAction::make(),
                ])->label('Action')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('download')
                        ->label('Download PDF')
                        ->icon('heroicon-o-document')
                        ->action(function ($records) {
                            $pdf = Pdf::loadHtml(
                                Blade::render('filament.resources.application.pages.view-application', [
                                    'records' => $records,
                                    'exportPdf' => true
                                ])
                            );
                            return response()->streamDownload(function () use ($pdf) {
                                echo $pdf->stream();
                            }, 'applications.pdf');
                        }),
                    Tables\Actions\BulkAction::make('make_contestants')
                        ->label('Make Contestants')
                        ->icon('heroicon-o-users')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->registerAsContestant();
                            }
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Contestants created')
                                ->body('The contestants have been created successfully.')
                        )
                ]),
            ]);
    }
}