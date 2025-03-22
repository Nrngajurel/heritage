<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Contestant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        return view('frontend.home');
    }
}
