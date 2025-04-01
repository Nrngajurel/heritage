<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Contestant;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();

        $external_news = Post::whereHas('category', function ($query) {
            $query->where('type', Category::TYPE_EXTERNAL);
        })
            ->limit(15)
            ->get();

        $blog_news = Post::whereHas('category', function ($query) {
            $query->where('type', Category::TYPE_REGULAR);
        })
        ->limit(3)
        ->get();
        

        return view('frontend.home', compact('sliders', 'external_news', 'blog_news'));
    }
}
