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
        $termsAndConditions = Page::find(1);
        return view('livewire.user.terms',
            compact('termsAndConditions'))->layout('layouts.front');
    }
}
