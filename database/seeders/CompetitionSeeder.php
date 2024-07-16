<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competitions = [
            [
                'name' => 'MRS HERITAGE INTERNATIONAL',
                'description' => 'A prestigious pageant celebrating married women who exemplify cultural heritage and global unity.'
            ],
            [
                'name' => 'MISS HERITAGE INTERNATIONAL',
                'description' => 'A beauty pageant promoting cultural awareness and heritage preservation among young women.'
            ],
            [
                'name' => 'HERITAGE PETITE INTERNATIONAL',
                'description' => 'A pageant for petite women, highlighting their unique beauty and cultural heritage.'
            ],
            [
                'name' => 'HERITAGE GOLD INTERNATIONAL',
                'description' => 'A competition honoring the elegance and grace of mature women, celebrating their life experiences and heritage.'
            ],
            [
                'name' => 'HERITAGE PLUS INTERNATIONAL',
                'description' => 'A pageant embracing the beauty and cultural richness of plus-sized women from around the world.'
            ],
            [
                'name' => 'HERITAGE INTERNATIONAL',
                'description' => 'A global competition focusing on cultural diversity and heritage conservation.'
            ],
            [
                'name' => 'HERITAGE GEMS INTERNATIONAL',
                'description' => 'A unique pageant showcasing women who shine as cultural ambassadors and heritage protectors.'
            ],
            [
                'name' => 'MISS ENVIRONMENT INTERNATIONAL',
                'description' => 'A pageant dedicated to environmental advocacy and sustainable living, promoting awareness and action.'
            ],
            [
                'name' => 'MISTER HERITAGE INTERNATIONAL',
                'description' => 'A prestigious competition for men who exemplify cultural pride, heritage knowledge, and global unity.'
            ],
            [
                'name' => 'HERITAGE AMBASSADOR',
                'description' => 'An honorary title awarded to individuals who have made significant contributions to preserving and promoting cultural heritage.'
            ],
            [
                'name' => 'HERITAGE INTERNATIONAL AWARDS',
                'description' => 'An award ceremony recognizing outstanding achievements in cultural heritage preservation and promotion.'
            ]
        ];

        foreach ($competitions as $competition) {
            \App\Models\Competition::create([
                'name' => $competition['name'],
                'description' => $competition['description']
            ]);
        }

    }
}
