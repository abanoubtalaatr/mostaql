<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component
{
    use WithFileUploads, ValidationTrait;

    public $page_title, $picture;

    public $desc_ar = '';
    public $title_ar = '';

    public function mount()
    {
        $this->page_title = __('site.create_page');
    }

    public function store()
    {
        $this->validate();

        Page::create($this->validate() );
        session()->flash('success_message', __('site.page_created_successfully'));
        return redirect()->to(route('admin.pages.index'));
    }


    public function getRules()
    {
        return [
            'title_ar' => 'required|max:500',
            'desc_ar' => 'required|max:500',
        ];
    }

    public function render()
    {
        return view('livewire.admin.page.create')->layout('layouts.admin');
    }
}
