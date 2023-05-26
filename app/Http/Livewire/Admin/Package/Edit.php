<?php

namespace App\Http\Livewire\Admin\Package;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Feature;
use App\Models\Package;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use ValidationTrait;
    use WithFileUploads;


    public $ad, $statuses, $new_status, $form, $package, $features;

    public function mount(Package $package)
    {
        $this->form = $package->toArray();

        $this->form['features'] = $package->features->pluck('id');
        $this->features = Feature::all();
        $this->package = $package;
    }

    public function store()
    {

        $this->validate();

        $this->package->update(Arr::except($this->form, 'features'));
        $this->package->features()->sync($this->form['features']);
        return $this->redirect('/admin/packages');
    }

    public function getRules()
    {
        return [
            'form.title_ar' => ['required', 'string'],
            'form.price' => ['required'],
            'form.period' => ['required','integer'],
            'form.features' => ['sometimes', 'array'],
//            'form.number_of_project' => ['required', 'integer'],
//            'form.number_of_proposal' => ['required', 'integer'],
        ];
    }

    public function render()
    {
        $data = [
            'record' => $this->ad,
            'page_title' => __('site.packages')
        ];
        return view('livewire.admin.package.create', $data)->layout('layouts.admin');
    }
}
