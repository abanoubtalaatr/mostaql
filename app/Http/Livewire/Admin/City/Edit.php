<?php

namespace App\Http\Livewire\Admin\City;

use App\Models\Category;
use App\Models\City;
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
    public function mount(City $city){
        $this->city = $city;
        $this->form = Arr::except($city->toArray(),['updated_at','created_at','id']);
        $this->page_title = __('site.edit_country');
    }

    public function store(){
        $this->validate();

//        $this->form['picture'] =
//            $this->picture?
//                $this->picture->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->picture->extension(),'public') : $this->category->picture;
        $this->city->update($this->form);
        session()->flash('success_message',__('site.saved_successfully'));
        return redirect()->to(url('admin/cities'));
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
            'form.name_ar'=>'required|max:300',
            'form.country_id' => ['required']
//            'form.title_en'=>'required|max:300',

//            'picture'=>'nullable|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }
    public function render(){
        $countries = Country::all();
        return view('livewire.admin.city.create', compact('countries'))->layout('layouts.admin');
    }
}
