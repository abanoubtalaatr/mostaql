<?php

namespace App\Http\Livewire\User;

use App\Models\Contact;
use App\Models\Page;
use App\Models\Setting;
use Livewire\Component;

class Terms extends Component
{
    public $form;
    public $success_message = false;

    public function mount()
    {

        $this->form = [];
        $this->page_title = __('site.support');
    }

    public function render()
    {
        $pages = Page::all();

        return view('livewire.user.terms',compact('pages'))->layout('layouts.front');
    }
}
