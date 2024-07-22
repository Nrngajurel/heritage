<?php

namespace App\Livewire\Pages\Admin\Includes;

use App\Models\Application;
use Livewire\Component;

class ViewApplication extends Component
{
    public $application;
    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->application = Application::query()
            ->with('competition', 'event')
            ->find($rowId);

        // dd($this->application);
        $this->js("\$openModal('viewDetailModal')");
    }
    public function render()
    {
        return view('livewire.pages.admin.includes.view-application');
    }
}
