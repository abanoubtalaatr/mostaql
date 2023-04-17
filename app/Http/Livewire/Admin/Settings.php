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
            'lat' => 'numeric',
            'lng' => 'numeric',
            'facebook' => 'string|min:10|max:1000',
            'instagram' => 'string|min:10|max:1000',
            'twitter' => 'string|min:10|max:1000',
            'campaign_min_Duration' => 'integer',

            'ad_min_budget' => 'integer',
            'ad_click_price' => 'numeric',
            'soldier_ad_click_price' => 'numeric',
            'taxes' => 'integer',

            'min_ad_view_duration' => 'integer',
            'solider_ad_max_profit' => 'numeric',

            'solider_ad_max_profit_currency' => 'required',
            'ad_click_price_currency' => 'required',
            'app_store' => 'required',
            'google_play' => 'required',
            'minimum_payback_amount' => 'required|numeric',
            'mission_ar' => 'nullable',
            'mission_en' => 'nullable',
            'vision_ar' => 'nullable',
            'vision_en' => 'nullable',
            'number_of_days' => 'nullable|numeric'


        ];
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin');
    }
}
