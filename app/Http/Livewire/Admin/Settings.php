<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Arr;
use App\Http\Livewire\Traits\ValidationTrait;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use ValidationTrait;
    use WithFileUploads;

    public $form, $page_title, $settings, $picture;

    public function mount()
    {
        $this->page_title = __('messages.settings');
        $this->settings = Setting::first();

        $this->form = Arr::except($this->settings->toArray(), ['id', 'created_at', 'updated_at']);

    }

    public function update()
    {
        if ($this->picture) {
            $this->form['logo'] = $this->picture->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->picture->extension(), 'public');
        }

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
            'platform_dues' => 'integer',
            'text_fo_accept_deal' => 'nullable',
            'packages_is_active' => 'nullable',
            'logo' => 'nullable',
        ];
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }
}
