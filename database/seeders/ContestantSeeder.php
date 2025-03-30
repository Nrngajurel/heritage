<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contestants = [
            [
                "name" => "Erika Hara",
                "country" => "Japan",
                "country_code" => "jp",
                "title" => "Miss Heritage International 2023",
                "focus_area" => "Cultural Preservation",
                "bio" => "Dedicated to preserving traditional Japanese arts and promoting cultural exchange.",
                "is_featured" => true,
                "votes" => 1250,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/1C1A9041.jpg"
            ],
            [
                "name" => "Wuandar Casanova",
                "country" => "Venezuela",
                "country_code" => "ve",
                "title" => "Mrs. Heritage 2023",
                "focus_area" => "Environmental Conservation",
                "bio" => "Environmental activist focusing on Amazon rainforest preservation.",
                "is_featured" => true,
                "votes" => 1100,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.21.15-PM.jpeg"
            ],
            [
                "name" => "Aayusha Rai",
                "country" => "Nepal",
                "country_code" => "np",
                "title" => "Miss Heritage Asia 2023",
                "focus_area" => "Sustainable Tourism",
                "bio" => "Promoting sustainable tourism in the Himalayas.",
                "is_featured" => true,
                "votes" => 950,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/2015-200x300.jpg"
            ],
            [
                "name" => "Maria Santos",
                "country" => "Thailand",
                "country_code" => "th",
                "title" => "Miss Heritage ASEAN",
                "focus_area" => "Peace Advocacy",
                "bio" => "Working on cross-cultural understanding in Southeast Asia.",
                "is_featured" => true,
                "votes" => 800,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2023/09/Russia-8-200x300.jpg"
            ],
            [
                "name" => "Sophia Chen",
                "country" => "Singapore",
                "country_code" => "sg",
                "title" => "Miss Heritage Tourism",
                "focus_area" => "Cultural Exchange",
                "bio" => "Promoting Singapore's multicultural heritage.",
                "votes" => 750,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/Heritage-Pageants-2023-802-scaled.jpg"
            ],
            [
                "name" => "Priya Patel",
                "country" => "India",
                "country_code" => "in",
                "title" => "Miss Heritage Culture",
                "focus_area" => "Heritage Protection",
                "bio" => "Preserving ancient Indian monuments and traditions.",
                "votes" => 700,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/Heritage-Pageants-2023-876-scaled.jpg"
            ],
            [
                "name" => "Isabella Kim",
                "country" => "South Korea",
                "country_code" => "kr",
                "title" => "Miss Heritage Digital",
                "focus_area" => "Digital Heritage Preservation",
                "bio" => "Using technology to preserve cultural heritage.",
                "votes" => 680,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/Heritage-Pageants-2023-753-scaled.jpg"
            ],
            [
                "name" => "Mei Lin",
                "country" => "China",
                "country_code" => "cn",
                "title" => "Miss Heritage Tradition",
                "focus_area" => "Traditional Arts",
                "bio" => "Promoting traditional Chinese performing arts.",
                "votes" => 650,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/1C1A9041.jpg"
            ],
            [
                "name" => "Anna Petrova",
                "country" => "Russia",
                "country_code" => "ru",
                "title" => "Miss Heritage Eurasia",
                "focus_area" => "Cultural Bridge",
                "bio" => "Building cultural bridges between Europe and Asia.",
                "votes" => 630,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.21.15-PM.jpeg"
            ],
            [
                "name" => "Amara Okafor",
                "country" => "Nigeria",
                "country_code" => "ng",
                "title" => "Miss Heritage Africa",
                "focus_area" => "African Heritage",
                "bio" => "Preserving Nigerian tribal traditions and arts.",
                "votes" => 600,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/2015-200x300.jpg"
            ],
            [
                "name" => "Leila Al-Hassan",
                "country" => "UAE",
                "country_code" => "ae",
                "title" => "Miss Heritage Middle East",
                "focus_area" => "Desert Culture",
                "bio" => "Promoting traditional Bedouin culture and heritage.",
                "votes" => 580,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2023/09/Russia-8-200x300.jpg"
            ],
            [
                "name" => "Carmen Rodriguez",
                "country" => "Mexico",
                "country_code" => "mx",
                "title" => "Miss Heritage Americas",
                "focus_area" => "Indigenous Rights",
                "bio" => "Advocating for indigenous peoples rights and culture.",
                "votes" => 550,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/Heritage-Pageants-2023-802-scaled.jpg"
            ],
            [
                "name" => "Sophie Martin",
                "country" => "France",
                "country_code" => "fr",
                "title" => "Miss Heritage Europe",
                "focus_area" => "Architectural Heritage",
                "bio" => "Working to preserve historical European architecture.",
                "votes" => 520,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/Heritage-Pageants-2023-876-scaled.jpg"
            ],
            [
                "name" => "Olivia Brown",
                "country" => "Australia",
                "country_code" => "au",
                "title" => "Miss Heritage Oceania",
                "focus_area" => "Marine Conservation",
                "bio" => "Protecting the Great Barrier Reef and marine heritage.",
                "votes" => 500,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/Heritage-Pageants-2023-753-scaled.jpg"
            ],
            [
                "name" => "Fatima Hassan",
                "country" => "Egypt",
                "country_code" => "eg",
                "title" => "Miss Heritage North Africa",
                "focus_area" => "Ancient Heritage",
                "bio" => "Preserving ancient Egyptian cultural sites.",
                "votes" => 480,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/1C1A9041.jpg"
            ],
            [
                "name" => "Ana Silva",
                "country" => "Brazil",
                "country_code" => "br",
                "title" => "Miss Heritage South America",
                "focus_area" => "Rainforest Culture",
                "bio" => "Protecting Amazon indigenous cultures.",
                "votes" => 460,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.21.15-PM.jpeg"
            ],
            [
                "name" => "Elena Popov",
                "country" => "Ukraine",
                "country_code" => "ua",
                "title" => "Miss Heritage Eastern Europe",
                "focus_area" => "War-time Heritage Protection",
                "bio" => "Protecting cultural sites during conflict.",
                "votes" => 440,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/2015-200x300.jpg"
            ],
            [
                "name" => "Zara Mahmood",
                "country" => "Pakistan",
                "country_code" => "pk",
                "title" => "Miss Heritage South Asia",
                "focus_area" => "Textile Heritage",
                "bio" => "Preserving traditional textile arts and crafts.",
                "votes" => 420,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2023/09/Russia-8-200x300.jpg"
            ],
            [
                "name" => "Lily Chen",
                "country" => "Taiwan",
                "country_code" => "tw",
                "title" => "Miss Heritage East Asia",
                "focus_area" => "Festival Preservation",
                "bio" => "Promoting traditional festival celebrations.",
                "votes" => 400,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/Heritage-Pageants-2023-802-scaled.jpg"
            ],
            [
                "name" => "Emma Wilson",
                "country" => "New Zealand",
                "country_code" => "nz",
                "title" => "Miss Heritage Pacific",
                "focus_area" => "Indigenous Knowledge",
                "bio" => "Preserving Maori traditions and knowledge.",
                "votes" => 380,
                "image_url" => "https://heritagepageant.com/wp-content/uploads/2024/04/Heritage-Pageants-2023-876-scaled.jpg"
            ]
        ];

        // foreach ($contestants as $contestant) {
        //     \App\Models\Contestant::create($contestant);
        // }
        //
    }
}
