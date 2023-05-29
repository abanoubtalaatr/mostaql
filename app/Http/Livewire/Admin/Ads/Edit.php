<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use ValidationTrait;
    use WithFileUploads;


    public $ad, $statuses, $new_status, $form, $photo;

    public function mount(Ad $advertisement)
    {
        $this->form = $advertisement->toArray();

        $this->ad = $advertisement;

        $this->form['start_at'] = Carbon::parse($this->form['start_at'])->format('Y-m-d');
        $this->form['end_at'] = Carbon::parse($this->form['end_at'])->format('Y-m-d');
    }

    public function store()
    {

        $this->validate();

        $this->form['photo'] =
            $this->photo ?
                $this->photo->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->photo->extension(), 'public') : $this->ad->photo;

        $this->ad->update($this->form);
        return $this->redirect('/admin/advertisements');
    }

    public function updatedFormPhoto()
    {
        $this->withValidator(function (Validator $validator) {
            if ($validator->errors()->has('form.photo')) {
                $this->form['photo'] = '';
            }
        })->validateOnly('form.photo');
    }

    public function getRules()
    {
        return [
            'form.title' => ['required', 'string'],
            'photo' => 'nullable|file|mimes:png,jpg,jpeg|max:10240', // max size 1M
            'form.photo' => 'nullable',
            'form.snap_chat' => ['nullable', 'url'],
            'form.location' => ['nullable'],
            'form.website' => ['nullable', 'url'],
            'form.facebook' => ['nullable', 'url'],
            'form.instagram' => ['nullable', 'url'],
            'form.twitter' => ['nullable', 'url'],
            'form.start_at' => 'required|date|date-format:Y-m-d|after:yesterday',
            'form.end_at' => ['required']
        ];
    }

    public function render()
    {
        $data = [
            'record' => $this->ad,
            'page_title' => __('site.ads')
        ];
        return view('livewire.admin.ads.create', $data)->layout('layouts.admin');
    }
}
