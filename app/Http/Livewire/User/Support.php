<?php

namespace App\Http\Livewire\User;

use App\Models\Contact;
use App\Models\Setting;
use Livewire\Component;

class Support extends Component
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
        $settings = Setting::first();

        return view('livewire.user.support',compact('settings'));
    }
}
