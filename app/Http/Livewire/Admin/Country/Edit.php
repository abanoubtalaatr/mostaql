<?php

namespace App\Http\Livewire\Admin\Country;

use App\Models\Category;
use App\Models\Country;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Edit extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public function mount(Country $country){
        $this->country = $country;
        $this->form = Arr::except($country->toArray(),['updated_at','created_at','id']);
        $this->page_title = __('site.edit_country');
    }

    public function store(){
        $this->validate();
//        $this->form['picture'] =
//            $this->picture?
//                $this->picture->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->picture->extension(),'public') : $this->category->picture;
        $this->country->update($this->form);
        session()->flash('success_message',__('site.saved_successfully'));
        return redirect()->to(url('admin/countries'));
    }


    public function updatedFormPicture(){
        $this->withValidator(function (Validator $validator) {
            if($validator->errors()->has('form.picture')){
                $this->form['picture'] = '';
            }
        })->validateOnly('form.picture');
    }


    public function getRules(){
        return [
            'form.value'=>'required|max:300',
            'form.code'=>'required|max:300',

//            'picture'=>'nullable|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }
    public function render(){
        return view('livewire.admin.country.create')->layout('layouts.admin');
    }
}
