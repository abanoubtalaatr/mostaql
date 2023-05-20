<?php

namespace App\Http\Livewire\Admin\Feature;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Feature;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use ValidationTrait;
    use WithFileUploads;


    public $ad, $statuses, $new_status, $form, $feature;

    public function mount(Feature $feature)
    {
        $this->form = $feature->toArray();

        $this->feature = $feature;
    }

    public function store()
    {

        $this->validate();

        $this->feature->update($this->form);
        return $this->redirect('/admin/features');
    }

    public function getRules()
    {
        return [
            'form.title_ar' => ['required', 'string'],
        ];
    }

    public function render()
    {
        $data = [
            'record' => $this->ad,
            'page_title' => __('site.package_features')
        ];
        return view('livewire.admin.feature.create', $data)->layout('layouts.admin');
    }
}
