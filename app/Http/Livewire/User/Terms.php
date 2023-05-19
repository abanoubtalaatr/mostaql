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
        $conditionUse = Page::find(2);
        $rights = Page::find(3);
        $questions = Page::find(5);
        $banks = Page::find(6);

        return view('livewire.user.terms',
            compact('conditionUse',
                'rights',
                'questions','banks'))->layout('layouts.front');
    }
}
