<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Notifications\ApplicationSubmitted;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

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
    public function applicationForm()
    {

        $event = Event::with('competitions')->latest()->first();
        $application = $event->applications()->latest()->first();
        $application->update([
            'email' => 'nrngajurel@gmail.com'
        ]);
        $application->notify(new ApplicationSubmitted($application));

        return view('frontend.application-form', [
            'event' => $event
        ]);
    }
    public function vote()
    {

        $event = Event::with('competitions')->latest()->first();


        return view('frontend.vote', [
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
        $data['email'] = 'nrngajurel@gmail.com';

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
}
