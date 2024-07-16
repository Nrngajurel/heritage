<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class EventPage extends Pages
{
    public function render()
    {
        return view('livewire.pages.admin.event-page');
    }
}
