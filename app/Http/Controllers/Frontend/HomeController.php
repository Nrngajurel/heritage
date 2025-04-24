<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Category;
use App\Models\Event;
use App\Models\Contestant;
use App\Models\Post;
use App\Models\Slider;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\fileExists;

class HomeController extends Controller
{
    public function index()
    {

        Application::whereNull('headshot_photo')->get()->each(function ($application) {
            
                $mediaMap = [
                    'headshot_photo' => 'contestants/images',
                    'waist_up_photo' => 'contestants/images',
                    'passport_copy' => 'contestants/documents',
                ];

                foreach ($mediaMap as $mediaKey => $targetDirectory) {
                    // Skip if already set
                    if ($application->{$mediaKey}) {
                        continue;
                    }

                    $sourcePath = $application->getFirstMediaPath($mediaKey);

                    if (file_exists($sourcePath)) {
                        $filename = basename($sourcePath);
                        $newPath = $targetDirectory . '/' . $filename;

                        

                        // Copy to Laravel's public disk
                        Storage::disk('public')->put($newPath, file_get_contents($sourcePath));

                        // Save the path in DB
                        $application->{$mediaKey} = $newPath;
                    }
                }
                $application->save();
            
        });

        $sliders = Slider::all();

        $external_news = Post::whereHas('category', function ($query) {
            $query->where('type', Category::TYPE_EXTERNAL);
        })
            ->limit(9)
            ->get();

        $blog_news = Post::whereHas('category', function ($query) {
            $query->where('type', Category::TYPE_REGULAR);
        })
            ->limit(3)
            ->get();


        return view('frontend.home', compact('sliders', 'external_news', 'blog_news'));
    }
}
