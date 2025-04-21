<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Competition;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Post;
use App\Notifications\ApplicationSubmitted;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function castVote(\App\Models\Contestant $contestant)
    {
        try {
            $contestant->increment('votes');
            return response()->json([
                'success' => true,
                'votes' => $contestant->votes,
                'message' => 'Vote cast successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to cast vote. Please try again.'
            ], 500);
        }
    }

    public function countryOptions()
    {
        $json = file_get_contents(public_path('countries.json'));

        $countries = collect(json_decode($json, true)['data'])->map(function ($item, $key) {

            return [
                'code' => $key,
                'country' => $item['country'],
                'src' => "https://flagsapi.com/{$key}/flat/64.png"
            ];
        })->filter(function ($item) {
            return false !== stristr($item['country'], request()->search);
        })->values()->take(50);


        return $countries;
    }
    public function show(\App\Models\Contestant $contestant)
    {
        $event = Event::latest()->first();


        return view('frontend.contestant-detail', [
            'contestant' => $contestant,
            'event' => $event
        ]);
    }

    public function newApplicationForm()
    {
        $event = Event::with('competitions')->latest()->first();
        return view('frontend.new-application-form', [
            'event' => $event,
        ]);
    }


    public function blog()
    {
        $blog_news = Post::whereHas('category', function ($query) {
            $query->where('type', request()->type);
        })->paginate();

        return view('frontend.blog', compact(var_name: 'blog_news'));
    }

    public function blogPost(Post $post)
    {
        return view('frontend.blog-post', compact('post'));
    }

    public function applicationForm()
    {
        // $application = Application::first();
        // $application->notify(new ApplicationSubmitted);

        $event = Event::with('competitions')->latest()->first();
        return view('frontend.application-form', [
            'event' => $event
        ]);
    }
    public function team()
    {
        return view('frontend.team');
    }

    public function vote()
    {
        $contestants = \App\Models\Contestant::orderBy('votes', 'desc')
            ->get()
            ->map(function ($contestant) {
                return [
                    'id' => $contestant->id,
                    'name' => $contestant->name,
                    'country' => $contestant->country,
                    'country_code' => $contestant->country_code,
                    'title' => $contestant->title,
                    'focus_area' => $contestant->focus_area,
                    'bio' => $contestant->bio,
                    'votes' => $contestant->votes,
                    'is_featured' => $contestant->is_featured,
                    'image_url' => $contestant->image_url
                ];
            });

        $event = Event::with('competitions')->latest()->first();


        return view('frontend.vote', compact('contestants'), [
            'event' => $event
        ]);
    }

    public function applicationFormSubmit(Request $request)
    {

        $data = $request->validate([
            'competition_id' => 'required|exists:competitions,id',
            'country' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|array',
            'address.address_line_1' => 'required|string|max:255',
            'address.city' => '',
            'address.state' => '',
            'address.zip' => '',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'meta.personal_background' => 'required|array',
            'meta.more' => 'required|array',
            'meta.outlook' => 'required|array',
            'meta.personal_statement' => 'required|string',
            'headshot_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'waist_up_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'passport_copy' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Event::with('competitions')->latest()->first();
        $application = $event->applications()->create($data);

        if ($request->hasFile('headshot_photo')) {
            $application->addMedia($request->file('headshot_photo'))->toMediaCollection('headshot_photo');
        }
        if ($request->hasFile('waist_up_photo')) {
            $application->addMedia($request->file('waist_up_photo'))->toMediaCollection('waist_up_photo');
        }
        if ($request->hasFile('passport_copy')) {
            $application->addMedia($request->file('passport_copy'))->toMediaCollection('passport_copy');
        }

        $application->notify(new ApplicationSubmitted($application));



        return response()->json(['message' => "Thank you. We have sent you an email to {$data['email']} about status of the application"]);
    }


    public function gallery()
    {
        $gallery = Gallery::orderBy('created_at', 'desc')
            ->get();

        return view('frontend.gallery', compact('gallery'));
    }

    public function event(Competition $event)
    {
        return view('frontend.event', compact('event'));
    }
}
