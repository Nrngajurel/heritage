<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Settings\GeneralSettings;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(GeneralSettings::class);
        
        $settings->site_name = 'Heritage Pageants';
        $settings->site_description = 'International Beauty Pageant';
        $settings->admin_email = 'admin@example.com';
        $settings->logo = '';
        $settings->favicon = '';
        $settings->footer_text = '© ' . date('Y') . ' Heritage Pageants. All rights reserved.';
        $settings->address = '123 Pageant Street';
        $settings->phone = '+1234567890';
        $settings->email = 'info@heritagepageant.com';
        $settings->social_links = [
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'twitter' => 'https://twitter.com',
        ];

        $settings->save();
    }
} 