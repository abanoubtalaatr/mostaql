<?php

namespace App\Http\Livewire\Admin\Medal;

use App\Models\Category;
use App\Models\Medal;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form, $page_title, $picture;

    public function mount()
    {
        $this->page_title = __('site.create_medal');
    }

    public function store()
    {
        $this->validate();
        $this->form['picture'] = $this->picture->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->picture->extension(), 'public');
        Medal::create($this->form);
        session()->flash('success_message', __('site.created_successfully'));
        return redirect()->to(url('admin/medals'));
    }


    public function getRules()
    {
        return [
            'form.title_ar' => 'required|max:500',
            'form.description_ar' => 'required|max:500',
            'picture' => 'required|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }

    public function render()
    {
        return view('livewire.admin.medal.create')->layout('layouts.admin');
    }
}
