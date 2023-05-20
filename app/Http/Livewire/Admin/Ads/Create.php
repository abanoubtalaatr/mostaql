<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use ValidationTrait;
    use WithFileUploads;


    public $ad, $statuses, $new_status, $form, $photo;

    public function store()
    {

        $this->validate();

        //(2): Upload whatsapp thumbnail
//        $hashed_name = Str::random(25).'_'.mt_getrandmax().'.'.$this->photo->extension();
//
//        $path = date('Y/m/d');
//        $this->photo = $this->photo->storeAs($path,$hashed_name,'public');
        $this->form['photo'] = $this->photo->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->photo->extension(), 'public');

        Ad::create($this->form);

        return $this->redirect('/admin/advertisements');
    }


    public function getRules()
    {
        return [
            'form.title' => ['required', 'string'],
            'photo' => 'image|mimes:jpeg,png,gif|max:1024', // max size 1M
            'form.photo' =>'nullable',
            'form.snap_chat' => ['required','url'],
            'form.location' => ['required'],
            'form.website' => ['required','url'],
            'form.facebook' => ['required','url'],
            'form.instagram' => ['required', 'url'],
            'form.twitter' => ['required', 'url'],
            'form.start_at'=>'required|date|date-format:Y-m-d|after:yesterday',
            'form.end_at' => ['required' ]
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
