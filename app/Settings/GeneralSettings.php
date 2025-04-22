<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $site_description;
    public string $admin_email;
    public ?string $logo;
    public ?string $favicon;
    public string $footer_text;
    public string $address;
    public string $phone;
    public string $email;
    public array $social_links;

    public int $visitor_count;

    public static function group(): string
    {
        return 'general';
    }

    public static function default(): array
    {
        return [
            'site_name' => 'Heritage Pageants',
            'site_description' => 'International Beauty Pageant',
            'admin_email' => 'admin@example.com',
            'logo' => '',
            'favicon' => '',
            'footer_text' => '© ' . date('Y') . ' Heritage Pageants. All rights reserved.',
            'address' => '123 Pageant Street',
            'phone' => '+1234567890',
            'email' => 'info@heritagepageant.com',
            'social_links' => [
                'facebook' => 'https://facebook.com',
                'instagram' => 'https://instagram.com',
                'twitter' => 'https://twitter.com',
            ],
            "visitor_count"=> 2900000
        ];
    }
} 