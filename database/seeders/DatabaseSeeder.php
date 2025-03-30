<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Event;
use App\Models\Post;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ContestantSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'info@heritagepageant.com',
            'password' => bcrypt('hp@voting123'),
        ]);

        $this->importSliders();
        $this->importNews();

        $this->call([
            CompetitionSeeder::class,
            EventSeeder::class,
        ]);

        $this->call([
            GeneralSettingsSeeder::class,
        ]);
    }

    public function importNews()
    {
        $external_news = [
            [
                "title" => "Venezuela wins MRS. HERITAGE while Japan bags MISS HERITAGE INTERNATIONAL 2023",
                "source" => "world fashion media news magazine",
                "image" => "https://heritagepageant.com/wp-content/uploads/2023/12/1c1a7795-1_orig.jpg",
                "link" => "https://heritagepageant.com/venezuela-wins-mrs-heritage-while-japan-bags-miss-heritage-international-2023"
            ],
            [
                "title" => "Two beautiful beauties from Japan and Venezuela won the Miss/Mrs. Heritage International 2023 crown.",
                "source" => "TV Pool",
                "image" => "https://heritagepageant.com/wp-content/uploads/2023/12/IMG_4627-1.jpeg",
                "link" => "https://heritagepageant.com/two-beautiful-beauties-from-japan-and-venezuela-won-the-miss-mrs-heritage-international-2023-crown"
            ],
            [
                "title" => "International beauty pageant, Heritage Pageants 2023, announces readiness",
                "source" => "TBT News",
                "image" => "https://heritagepageant.com/wp-content/uploads/2023/12/www.tingbt.com-img-1435-696x463-1.jpeg",
                "link" => "https://heritagepageant.com/international-beauty-pageant-heritage-pageants-2023-announces-readiness"
            ],
        ];
        $category = Category::create([
            'name' => 'News Media Coverage HERITAGE PAGEANTS 2023',
            'slug' => 'news-media-coverage-heritage-pageants-2023',
            'type' => Category::TYPE_EXTERNAL,
            'description' => 'News Media Coverage HERITAGE PAGEANTS 2023',
        ]);

        foreach ($external_news as $news) {
            $filename = $this->downloadImage($news['image'], 'posts');
            Post::create([
                'title' => $news['title'],
                'slug' => \Illuminate\Support\Str::slug($news['title']),
                'image' => 'posts/' . $filename,
                'category_id' => $category->id,
                'source' => $news['source'],
                'external_link' => $news['link'],
                'is_published' => true,
            ]);
        }

        $blog_news = [
            [
                "title" => "मिस हेरिटेज इन्टरनेसनलमा सहभागि हुन अन्तर्राष्ट्रिय सुन्दरीहरु नेपालमा",
                "image" => "https://heritagepageant.com/wp-content/uploads/2023/09/International-Beauty.webp"
            ],
            [
                "title" => "Nepali belle wins titles in Miss Heritage Int’l",
                "image" => "https://heritagepageant.com/wp-content/uploads/2023/09/Miss-Heritage-International-2015-winners.webp"
            ],
            [
                "title" => "Santosh Sapkota receives International Award",
                "image" => "https://heritagepageant.com/wp-content/uploads/2023/09/Award.webp"
            ]
        ];

        $blog_news_category = Category::create([
            'name' => 'Blog News',
            'slug' => 'blog-news',
            'type' => Category::TYPE_REGULAR,
            'description' => 'Blog News',
        ]);

        foreach ($blog_news as $news) {
            $filename = $this->downloadImage($news['image'], 'posts');
            Post::create([
                'title' => $news['title'],
                'slug' => \Illuminate\Support\Str::slug($news['title']),
                'image' => 'posts/' . $filename,
                'category_id' => $blog_news_category->id,
                'is_published' => true,
            ]);
        }
    }

    private function importSliders(): void
    {
        $slider_main = ['https://heritagepageant.com/wp-content/uploads/2025/01/MHI_Web-Banner-1250x390.jpg', 'https://heritagepageant.com/wp-content/uploads/2025/01/MHI_Web-Banner_-1250x390.jpg', 'https://heritagepageant.com/wp-content/uploads/2025/02/MHI_Web-Banner_-copy-1250x390.jpg'];
        $slider_moment = [
            'https://mrsheritageinternational.com/wp-content/uploads/2024/04/benGGy2202.jpg',
            'https://mrsheritageinternational.com/wp-content/uploads/2024/04/Peace.jpg',
            'https://mrsheritageinternational.com/wp-content/uploads/2024/04/1C1A5078-1-scaled.jpg',
            'https://mrsheritageinternational.com/wp-content/uploads/2024/04/hERITAGE.jpg',
            'https://mrsheritageinternational.com/wp-content/uploads/2024/04/hERITAGE-copy.jpg'
        ];

        $slider_highlight = [
            'https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.26.33-PM-2.jpeg',
            'https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.26.34-PM-1.jpeg',
            'https://heritagepageant.com/wp-content/uploads/2023/11/WhatsApp-Image-2023-11-14-at-10.26.33-PM-2.jpeg'
        ];

        foreach ($slider_main as $image) {
            $this->downloadAndCreateSlider($image, 'Main Slider', 'main');
        }

        foreach ($slider_moment as $image) {
            $this->downloadAndCreateSlider($image, 'Moment Slider', 'moment');
        }

        foreach ($slider_highlight as $image) {
            $this->downloadAndCreateSlider($image, 'Highlight Slider', 'highlight');
        }
    }
    private function downloadAndCreateSlider(string $imageUrl, string $title, string $location): void
    {
        $filename = $this->downloadImage($imageUrl, 'slider');

        Slider::create([
            'title' => $title,
            'image_path' => 'slider/' . $filename,
            'location' => $location,
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }

    // download image
    private function downloadImage(string $imageUrl, string $type): string
    {
        $imageContents = file_get_contents($imageUrl);
        $filename = 'slider-' . uniqid() . '.jpg';
        Storage::disk('public')->put($type . '/' . $filename, $imageContents);
        return $filename;
    }
}
