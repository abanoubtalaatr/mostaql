<?php

namespace App\Http\Livewire\Admin\Country;

use App\Models\Category;
use App\Models\Country;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public function mount(){
        $this->page_title = __('site.create_country');
    }

    public function store(){
        $this->validate();
//        $this->form['picture'] = $this->picture->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->picture->extension(),'public');
        Country::create($this->form);
        session()->flash('success_message',__('site.created_successfully'));
        return redirect()->to(url('admin/countries'));
    }


    public function getRules(){
        return [
            'form.value'=>'required|max:500',
            'form.code'=>'required|max:500',
//            'picture'=>'required|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }
    public function render(){
        return view('livewire.admin.country.create')->layout('layouts.admin');
    }
}
