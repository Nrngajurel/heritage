<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Middleware\CountVisitor;
use App\Livewire\Pages\Admin\DashboardPage;
use App\Livewire\Pages\Admin\EventPage;
use App\Livewire\Pages\Events\Index;
use App\Http\Controllers\ContactController;
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
// Route::redirect('/', '/application-form');

Route::middleware([CountVisitor::class])->group(function(){

    Route::get( '/', [HomeController::class, 'index'])->name('home');
    
    Route::get('countryOptions',[FrontendController::class, 'countryOptions'])->name('countryOptions');
    Route::get( 'application-form', [FrontendController::class, 'newApplicationForm'])->name('newApplicationForm');
    // Route::get('application-form', [FrontendController::class, 'applicationForm'])->name('application-form');
    // Route::post('application-form', [FrontendController::class, 'applicationFormSubmit'])->name('application-form-submit');
    Route::get('vote', [FrontendController::class, 'vote'])->name('vote.index');
    Route::get('vote/{contestant}', [FrontendController::class, 'show'])->name('vote.show');
    Route::post('vote/{contestant}', [FrontendController::class, 'castVote'])->middleware('throttle:once-a-day')->name('cast.vote');
    
    // blog
    Route::get('blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('blog/{post}', [FrontendController::class, 'blogPost'])->name('blog.show');
    
    
    Route::get('gallery', [FrontendController::class, 'gallery'])->name('gallery');
    Route::get('events/{event}', [FrontendController::class, 'event'])->name('events.show');
    Route::get('team', [FrontendController::class, 'team'])->name('team');
    
    Route::view('mail-template', 'emails.template');
    Route::view('mail-template1', 'emails.template1');
    
    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


    Route::get('{page:slug}', [FrontendController::class, 'page'])->name('page.show');
});
