<?php

namespace App\Http\Livewire\Admin\Feature;

use App\Models\Ad;
use App\Models\feature;
use Livewire\Component;

class Show extends Component
{

    public $ad, $statuses, $new_status, $feature;

    public function mount(Feature $feature)
    {
        $this->feature= $feature;
    }

    public function render()
    {
        $data = [
            'record' => $this->ad,
            'page_title' => $this->feature->title_ar
        ];
        return view('livewire.admin.feature.show', $data)->layout('layouts.admin');
    }
}
