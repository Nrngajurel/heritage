<?php

use App\Livewire\Frontend\ApplicationFormPage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ApplicationFormPage::class)
        ->assertStatus(200);
});
