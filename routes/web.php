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

Route::redirect('/', 'application-form');

Route::get('countryOptions',[FrontendController::class, 'countryOptions'])->name('countryOptions');
Route::get('application-form', [FrontendController::class, 'applicationForm'])->name('application-form');
Route::post('application-form', [FrontendController::class, 'applicationFormSubmit'])->name('application-form-submit');
Route::get('vote', [FrontendController::class, 'vote'])->name('vote-form');


Route::view('mail-template', 'emails.template');
