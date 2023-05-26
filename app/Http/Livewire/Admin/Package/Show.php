<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Ad;
use App\Models\feature;
use App\Models\Package;
use Livewire\Component;

class Show extends Component
{

    public $ad, $statuses, $new_status, $package;

    public function mount(Package $package)
    {
        $this->package = $package;
    }

    public function render()
    {
        $data = [
            'record' => $this->ad,
            'page_title' => $this->package->title_ar
        ];
        return view('livewire.admin.pacakge.show', $data)->layout('layouts.admin');
    }
}
