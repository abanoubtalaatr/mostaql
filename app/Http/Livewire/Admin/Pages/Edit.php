<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Edit extends Component
{
    use WithFileUploads, ValidationTrait;

    public $page_title, $picture;
    public $desc_ar, $title_ar;

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->desc_ar = $page->desc_ar;
        $this->title_ar = $page->title_ar;

        $this->page_title = __('site.edit_page');
    }

    public function store()
    {

        $this->page->update([
            'title_ar' => $this->title_ar,
            'desc_ar' => $this->desc_ar,
        ]);
        session()->flash('success_message', __('site.page_edited_successfully'));
        return redirect()->to(route('admin.pages.index'));
    }

    public function getRules()
    {
        return [
            'title_ar' => 'required',
            'desc_ar' => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.admin.page.create')->layout('layouts.admin');
    }
}
