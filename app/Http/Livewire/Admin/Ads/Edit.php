<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

        $this->ad->update($this->form);

        return $this->redirect('/admin/advertisements');
    }

    public function getRules()
    {
        return [
            'form.title' => ['required', 'string'],
//            'photo' => 'image|mimes:jpeg,png,gif|max:1024', // max size 1M
            'form.snap_chat' => ['required', 'url'],
            'form.location' => ['required'],
            'form.website' => ['required', 'url'],
            'form.facebook' => ['required', 'url'],
            'form.instagram' => ['required', 'url'],
            'form.twitter' => ['required', 'url'],
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
