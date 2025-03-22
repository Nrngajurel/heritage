<?php

namespace App\Filament\Resources\EventApplicationResource\Pages;

use App\Filament\Resources\EventApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Grid;

class ViewEventApplication extends ViewRecord
{
    
    protected static string $resource = EventApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make([
                    'default' => 1,
                    'sm' => 1,
                    'lg' => 4,
                ])
                ->schema([
                    Section::make('Application Status')
                        ->icon('heroicon-o-identification')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 4,
                        ])
                        ->schema([
                            Grid::make(4)
                            ->schema([
                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        default => 'warning',
                                    }),
                                TextEntry::make('created_at')
                                    ->dateTime()
                                    ->label('Submitted On'),
                                TextEntry::make('event.name')
                                    ->label('Event'),
                                TextEntry::make('competition.name')
                                    ->label('Competition'),
                            ])
                        ]),

                    Section::make('Photos')
                        ->icon('heroicon-o-camera')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 4,
                        ])
                        ->schema([
                            Grid::make(3)
                            ->schema([
                                ImageEntry::make('headshot_photo')
                                    ->label('Professional Headshot')
                                    ->circular()
                                    ->height(200),
                                ImageEntry::make('waist_up_photo')
                                    ->label('Passport Photo')
                                    ->circular()
                                    ->height(200),
                                ImageEntry::make('passport_copy')
                                    ->label('Passport Copy')
                                    ->height(200),
                            ])
                        ]),

                    Section::make('Personal Information')
                        ->icon('heroicon-o-user')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 2,
                        ])
                        ->schema([
                            Grid::make(2)
                            ->schema([
                                TextEntry::make('first_name'),
                                TextEntry::make('last_name'),
                                TextEntry::make('email'),
                                TextEntry::make('phone'),
                                TextEntry::make('country'),
                                TextEntry::make('address.address_line_1')
                                    ->label('Address'),
                                TextEntry::make('address.city'),
                                TextEntry::make('address.state'),
                                TextEntry::make('address.zip'),
                            ]),
                        ]),

                    Section::make('Personal Background')
                        ->icon('heroicon-o-academic-cap')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 2,
                        ])
                        ->schema([
                            Grid::make(3)
                            ->schema([
                                TextEntry::make('meta.personal_background.date_of_birth')
                                    ->label('Date of Birth'),
                                TextEntry::make('meta.personal_background.age')
                                    ->label('Age'),
                                TextEntry::make('meta.personal_background.height')
                                    ->label('Height'),
                                TextEntry::make('meta.personal_background.weight')
                                    ->label('Weight')
                                    ->suffix('kg'),
                                TextEntry::make('meta.personal_background.dress_size')
                                    ->label('Dress Size'),
                                TextEntry::make('meta.personal_background.shoe_size')
                                    ->label('Shoe Size'),
                            ]),
                            TextEntry::make('meta.personal_background.Attended School/College Name')
                                ->label('Education')
                                ->columnSpanFull(),
                            TextEntry::make('meta.personal_background.List Awards or Achievements (Non Scholastic)')
                                ->label('Awards & Achievements')
                                ->columnSpanFull(),
                            TextEntry::make('meta.personal_background.List Any Degree Attained, Scholarship & Achievement')
                                ->label('Academic Achievements')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Social & Preferences')
                        ->icon('heroicon-o-heart')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 2,
                        ])
                        ->schema([
                            TextEntry::make('meta.more.social_links')
                                ->label('Social Media')
                                ->markdown()
                                ->columnSpanFull(),
                            Grid::make(2)
                            ->schema([
                                TextEntry::make('meta.more.favorite_color')
                                    ->label('Favorite Color'),
                                TextEntry::make('meta.more.favorite_food')
                                    ->label('Favorite Food'),
                                TextEntry::make('meta.more.favorite_spot')
                                    ->label('Favorite Sports'),
                            ]),
                        ]),

                    Section::make('Personal Outlook')
                        ->icon('heroicon-o-light-bulb')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 2,
                        ])
                        ->schema([
                            Grid::make(2)
                            ->schema([
                                TextEntry::make('meta.outlook.hobbies')
                                    ->label('Hobbies'),
                                TextEntry::make('meta.outlook.talent')
                                    ->label('Talent'),
                                TextEntry::make('meta.outlook.future_ambitions')
                                    ->label('Future Ambitions'),
                                TextEntry::make('meta.outlook.awards')
                                    ->label('Titles/Awards'),
                            ]),
                            TextEntry::make('meta.outlook.Most unusual thing You have Done Ever?')
                                ->label('Most Unusual Experience')
                                ->columnSpanFull(),
                            TextEntry::make('meta.outlook.What Person Would You Like To Meet And Why?')
                                ->label('Dream Meeting')
                                ->columnSpanFull(),
                            TextEntry::make('meta.outlook.Describe the Moment in Your Life You Are Most Proud of?')
                                ->label('Proudest Moment')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Personal Statement')
                        ->icon('heroicon-o-document-text')
                        ->columnSpan([
                            'default' => 1,
                            'sm' => 1,
                            'lg' => 4,
                        ])
                        ->schema([
                            TextEntry::make('meta.personal_statement')
                                ->markdown()
                                ->prose()
                                ->columnSpanFull(),
                        ]),
                ]),
            ]);
    }
}
