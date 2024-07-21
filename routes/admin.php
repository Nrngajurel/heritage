<?php

use App\Livewire\Pages\Admin\ApplicationPage;
use App\Livewire\Pages\Admin\DashboardPage;
use App\Livewire\Pages\Admin\EventPage;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {

    Route::get('dashboard', DashboardPage::class)->name('dashboard')->lazy();
    Route::get('events', EventPage::class)->name('admin.events.index')->lazy();
    Route::get('applications', ApplicationPage::class)->name('admin.applications.index')->lazy();
});
