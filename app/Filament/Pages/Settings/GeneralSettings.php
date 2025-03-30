<?php

namespace App\Filament\Pages\Settings;

use App\Settings\GeneralSettings as GeneralSettingsClass;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;

class GeneralSettings
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $title = 'Site Settings';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    protected static string $settings = GeneralSettingsClass::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Site Information')
                    ->schema([
                        TextInput::make('site_name')
                            ->required()
                            ->maxLength(255),
                        
                        Textarea::make('site_description')
                            ->required()
                            ->maxLength(1000),
                        
                        TextInput::make('admin_email')
                            ->email()
                            ->required(),
                    ]),

                Section::make('Site Media')
                    ->schema([
                        FileUpload::make('logo')
                            ->image()
                            ->directory('site')
                            ->maxSize(2048)
                            ->helperText('Recommended size: 200x50px'),
                        
                        FileUpload::make('favicon')
                            ->image()
                            ->directory('site')
                            ->maxSize(512)
                            ->helperText('Recommended size: 32x32px'),
                    ]),

                Section::make('Contact Information')
                    ->schema([
                        Textarea::make('address')
                            ->required(),
                        
                        TextInput::make('phone')
                            ->tel()
                            ->required(),
                        
                        TextInput::make('email')
                            ->email()
                            ->required(),
                    ]),

                Section::make('Social Media')
                    ->schema([
                        Repeater::make('social_links')
                            ->schema([
                                TextInput::make('platform')
                                    ->required(),
                                TextInput::make('url')
                                    ->url()
                                    ->required(),
                            ])
                            ->columns(2),
                    ]),

                Section::make('Footer')
                    ->schema([
                        Textarea::make('footer_text')
                            ->required(),
                    ]),
            ]);
    }
} 