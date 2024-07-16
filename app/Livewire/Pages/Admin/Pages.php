<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Attributes\Lazy;
use Livewire\Component;


abstract class Pages extends Component
{

    public function placeholder()
    {
        return view('livewire.pages.admin.placeholder');
    }
    
}
