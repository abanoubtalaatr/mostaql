<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Arr;
use App\Http\Livewire\Traits\ValidationTrait;

class Settings extends Component
{
    use ValidationTrait;

    public $form, $page_title, $settings;

    public function mount()
    {
        $this->page_title = __('messages.settings');
        $this->settings = Setting::first();
        $this->form = Arr::except($this->settings->toArray(), ['id', 'created_at', 'updated_at']);
    }

    public function update()
    {
        $this->settings->update($this->form);
        return redirect()->to(route('admin.settings'))->with('success_message', __('site.saved'));
    }


    public function getRules()
    {
        return [
            'intro_video' => 'url',
            'email' => 'email',
            'address' => 'string|min:10|max:200',
            'address_ar' => 'string|min:10|max:200',
            'mobile' => 'numeric',
//            'lat' => 'numeric',
//            'lng' => 'numeric',
            'facebook' => 'string|min:10|max:1000',
            'instagram' => 'string|min:10|max:1000',
            'twitter' => 'string|min:10|max:1000',
            'snap_chat' => 'string|min:10|max:255',
            'taxes' => 'integer',
        ];
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }
}
