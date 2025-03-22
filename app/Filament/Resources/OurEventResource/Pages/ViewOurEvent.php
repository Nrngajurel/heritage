<?php

namespace App\Filament\Resources\OurEventResource\Pages;

use App\Filament\Resources\EventApplicationResource;
use App\Filament\Resources\OurEventResource;
use App\Models\Event;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class ViewOurEvent extends ViewRecord
{
    protected static string $resource = OurEventResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Tabs::make('Content')
                    ->tabs([
                        \Filament\Infolists\Components\Tabs\Tab::make('Overview')
                            ->schema(components: $this->getOverview()),
                        \Filament\Infolists\Components\Tabs\Tab::make('Applications')
                            ->schema([
                                
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }


    private function getOverview()
    {
        return  [
                Grid::make(3)
                    ->schema([
                        Section::make('Event Details')
                            ->icon('heroicon-o-calendar')
                            ->columnSpan(2)
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('name')
                                            ->label('Event Name')
                                            ->size('lg')
                                            ->weight('bold')
                                            ->icon('heroicon-o-star'),
                                        TextEntry::make('description')
                                            ->html()
                                            ->columnSpanFull()
                                            ->icon('heroicon-o-document-text'),
                                    ]),
                            ]),
                        Section::make('Timeline')
                            ->icon('heroicon-o-clock')
                            ->columnSpan(1)
                            ->schema([
                                TextEntry::make('form_start_date')
                                    ->label('Registration Start')
                                    ->dateTime()
                                    ->icon('heroicon-o-play'),
                                TextEntry::make('form_end_date')
                                    ->label('Registration End')
                                    ->dateTime()
                                    ->icon('heroicon-o-stop'),
                                TextEntry::make('voting_start_date')
                                    ->label('Voting Start')
                                    ->dateTime()
                                    ->icon('heroicon-o-hand-raised'),
                                TextEntry::make('voting_end_date')
                                    ->label('Voting End')
                                    ->dateTime()
                                    ->icon('heroicon-o-flag'),
                            ]),
                    ]),
                Section::make('Competitions')
                    ->icon('heroicon-o-trophy')
                    ->schema([
                        TextEntry::make('competitions.name')
                            ->listWithLineBreaks()
                            ->icon('heroicon-o-academic-cap'),
                    ]),
            ];
    }
}
