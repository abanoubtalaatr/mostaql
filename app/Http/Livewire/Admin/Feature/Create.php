<?php

namespace App\Http\Livewire\Admin\Feature;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\feature;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use ValidationTrait;
    use WithFileUploads;

    public $statuses, $new_status, $form, $photo;

    public function store()
    {

        $this->validate();

        Feature::create($this->form);

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
            'record' => [],
            'page_title' => __('site.package_features')
        ];
        return view('livewire.admin.feature.create', $data)->layout('layouts.admin');
    }
}
