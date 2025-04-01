<?php

use Illuminate\Support\Facades\DB;

return new class
{
    public function up(): void
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
            ]
        ];

        foreach ($settings as $key => $value) {
            DB::table('settings')->insert([
                'group' => 'general',
                'name' => $key,
                'payload' => json_encode($value),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}; 