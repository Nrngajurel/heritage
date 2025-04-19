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
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;

class EventApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getCountryOption()
    {
        $json = file_get_contents(public_path('countries.json'));


        return collect(json_decode($json, true)['data'])
            ->map(fn($item, $key) => [
                'value' => $item['country'],
                'label' => $item['country']
            ]);
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->icon('heroicon-o-user')
                    ->description('Enter the basic personal and contact details')
                    ->schema([
                        Forms\Components\Select::make('event_id')
                            ->relationship('event', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('competition_id')
                            ->relationship('competition', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('country')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Address Information')
                    ->icon('heroicon-o-home')
                    ->description('Provide your current residential address')
                    ->schema([
                        Forms\Components\TextInput::make('address.address_line_1')
                            ->label('Address Line 1')
                            ->required(),
                        Forms\Components\TextInput::make('address.city')
                            ->label('City')
                            ->required(),
                        Forms\Components\TextInput::make('address.state')
                            ->label('State')
                            ->required(),
                        Forms\Components\TextInput::make('address.zip')
                            ->label('Zip Code')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Personal Background')
                    ->icon('heroicon-o-identification')
                    ->description('Share your personal details and achievements')
                    ->schema([
                        Forms\Components\DatePicker::make('meta.personal_background.date_of_birth')
                            ->label('Date of Birth')
                            ->required(),
                        Forms\Components\TextInput::make('meta.personal_background.age')
                            ->label('Age')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('meta.personal_background.height')
                            ->label('Height')
                            ->required(),
                        Forms\Components\TextInput::make('meta.personal_background.weight')
                            ->label('Weight')
                            ->suffix('kg')
                            ->required(),
                        Forms\Components\TextInput::make('meta.personal_background.dress_size')
                            ->label('Dress Size')
                            ->required(),
                        Forms\Components\TextInput::make('meta.personal_background.shoe_size')
                            ->label('Shoe Size')
                            ->required(),
                        Forms\Components\TextInput::make('meta.personal_background.Attended School/College Name')
                            ->label('School/College Name'),
                        Forms\Components\Textarea::make('meta.personal_background.List Awards or Achievements (Non Scholastic)')
                            ->label('Awards/Achievements'),
                        Forms\Components\Textarea::make('meta.personal_background.List Any Degree Attained, Scholarship & Achievement')
                            ->label('Degrees & Scholarships'),
                        Forms\Components\Textarea::make('meta.personal_background.Tell us of Any Interesting Facts About Your Family or Their Achievement')
                            ->label('Family Achievements')
                            ->columnSpanFull(),
                    ])->columns(3),

                Forms\Components\Section::make('Social & Preferences')
                    ->icon('heroicon-o-heart')
                    ->description('Tell us about your social presence and preferences')
                    ->schema([
                        Forms\Components\Textarea::make('meta.more.social_links')
                            ->label('Social Media Links'),
                        Forms\Components\TextInput::make('meta.more.favorite_color')
                            ->label('Favorite Color'),
                        Forms\Components\TextInput::make('meta.more.favorite_food')
                            ->label('Favorite Food'),
                        Forms\Components\TextInput::make('meta.more.favorite_spot')
                            ->label('Favorite Sports'),
                    ])->columns(2),

                Forms\Components\Section::make('Personal Outlook')
                    ->icon('heroicon-o-light-bulb')
                    ->description('Share your interests, ambitions and experiences')
                    ->schema([
                        Forms\Components\TextInput::make('meta.outlook.hobbies')
                            ->label('Hobbies'),
                        Forms\Components\TextInput::make('meta.outlook.talent')
                            ->label('Talent'),
                        Forms\Components\TextInput::make('meta.outlook.future_ambitions')
                            ->label('Future Ambitions'),
                        Forms\Components\TextInput::make('meta.outlook.awards')
                            ->label('Titles/Awards'),
                        Forms\Components\TextInput::make('meta.outlook.Most unusual thing You have Done Ever?')
                            ->label('Most Unusual Thing Done'),
                        Forms\Components\TextInput::make('meta.outlook.What Person Would You Like To Meet And Why?')
                            ->label('Person You Would Like to Meet'),
                        Forms\Components\TextInput::make('meta.outlook.Describe the Moment in Your Life You Are Most Proud of?')
                            ->label('Proudest Moment'),
                        Forms\Components\TextInput::make('meta.outlook.List all of the countries you have travelled to?')
                            ->label('Countries Visited'),
                    ])->columns(2),

                Forms\Components\Section::make('Personal Statement')
                    ->icon('heroicon-o-document-text')
                    ->description('Write a detailed statement about yourself')
                    ->schema([
                        Forms\Components\RichEditor::make('meta.personal_statement')
                            ->label('Personal Statement')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'link',
                                'bulletList',
                                'orderedList',
                            ])
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Documents & Photos')
                    ->icon('heroicon-o-camera')
                    ->description('Upload required photos and documents')
                    ->schema([
                        Forms\Components\FileUpload::make('headshot_photo')
                            ->label('Professional Headshot')
                            ->image()
                            ->imageEditor()
                            ->directory('contestants/images'),
                        Forms\Components\FileUpload::make('waist_up_photo')
                            ->label('Passport Size Photo')
                            ->image()
                            ->imageEditor()
                            ->directory('contestants/images'),
                        Forms\Components\FileUpload::make('passport_copy')
                            ->label('Passport Copy')
                            ->image()
                            ->imageEditor()
                            ->directory('contestants/documents'),
                    ])->columns(3),

                Forms\Components\Section::make('Status')
                    ->icon('heroicon-o-check-circle')
                    ->description('Set the application status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->default('pending')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
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
                    ->sortable(),
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
                                    'exportPdf' => true
                                ])
                            )->stream();
                        }, $record->id . 'application-form.pdf');
                    }),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
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
                        })->deselectRecordsAfterCompletion(),
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
                        )->deselectRecordsAfterCompletion()
                ]),
            ]);
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
            'index' => Pages\ListEventApplications::route('/'),
            'create' => Pages\CreateEventApplication::route('/create'),
            'view' => Pages\ViewEventApplication::route('/{record}'),
            'edit' => Pages\EditEventApplication::route('/{record}/edit'),
        ];
    }
}
