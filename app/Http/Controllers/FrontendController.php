<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function applicationForm(){

        $event = Event::with('competitions')->latest()->first();


        return view('frontend.application-form',[
            'event' => $event
        ]);
    }
}
