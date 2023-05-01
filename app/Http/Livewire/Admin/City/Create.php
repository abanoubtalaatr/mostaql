<?php

namespace App\Http\Livewire\Admin\City;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use Google\Service\Firestore\Count;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public $name_ar;
    public function mount(){
        $this->page_title = __('site.create_city');
    }

    public function store(){
        $this->validate();
//        $this->form['picture'] = $this->picture->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->picture->extension(),'public');
//      dd($this->form);
        City::create($this->form);

        session()->flash('success_message',__('site.created_successfully'));
        return redirect()->to(url('admin/cities'));
    }


    public function getRules(){
        return [
            'form.name_ar'=> ['required','max:30'],
            'form.country_id' => ['required']
//            'form.title_en'=>'required|max:500',
//            'picture'=>'required|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }
    public function updated($name_ar)
    {
        $this->validateOnly($name_ar);
    }
    public function render(){
        $countries = Country::all();
        return view('livewire.admin.city.create', compact('countries'))->layout('layouts.admin');
    }
}
