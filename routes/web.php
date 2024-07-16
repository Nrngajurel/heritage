<?php

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
