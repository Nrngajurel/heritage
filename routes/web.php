<?php

use App\Http\Controllers\FrontendController;
use App\Livewire\Pages\Admin\DashboardPage;
use App\Livewire\Pages\Admin\EventPage;
use App\Livewire\Pages\Events\Index;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('countryOptions', function () {
    $json = file_get_contents(public_path('countries.json'));

    $countries = collect(json_decode($json, true)['data'])->map(function ($item, $key) {

        return [
            'code'=> $key,
            'country' => $item['country'],
            'src'=> "https://flagsapi.com/{$key}/flat/64.png"
        ];
    })->filter(function ($item) {
        return false !== stristr($item['country'], request()->search);
    })->values();


    return $countries;


})->name('countryOptions');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {



    Route::view('dashboard_new', 'dashboard_new');
    Route::view('layout_one', 'layout_one');
    Route::view('layout_two', 'layout_two');
    Route::view('layout_three', 'layout_three');

    Route::get('dashboard', DashboardPage::class)->name('dashboard')->lazy();
    Route::get('events', EventPage::class)->name('admin.events.index')->lazy();

});

Route::get('application-form', [FrontendController::class, 'applicationForm'])->name('application-form');
Route::get('vote', [FrontendController::class, 'vote'])->name('vote-form');


Route::view('mail-template', 'emails.template');
