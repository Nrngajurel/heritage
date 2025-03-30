<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\LaravelSettings\Models\SettingsProperty;

class GeneralSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
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
        ];

        foreach ($settings as $key => $value) {
            SettingsProperty::updateOrCreate(
                [
                    'group' => 'general',
                    'name' => $key,
                ],
                [
                    'payload' => json_encode($value),
                ]
            );
        }
    }
} 