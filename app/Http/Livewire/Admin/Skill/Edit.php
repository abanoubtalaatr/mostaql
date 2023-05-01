<?php

namespace App\Http\Livewire\Admin\Skill;

use App\Models\Category;
use App\Models\Skill;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Edit extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public function mount(Skill $skill){
        $this->skill = $skill;
        $this->form = Arr::except($skill->toArray(),['updated_at','created_at','id']);
        $this->page_title = __('site.edit_skill');
    }

    public function store(){
        $this->validate();
//        $this->form['picture'] =
//            $this->picture?
//                $this->picture->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->picture->extension(),'public') : $this->category->picture;
        $this->skill->update($this->form);
        session()->flash('success_message',__('site.saved_successfully'));
        return redirect()->to(url('admin/skills'));
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
//            'form.title_en'=>'required|max:300',

//            'picture'=>'nullable|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }
    public function render(){
        return view('livewire.admin.skill.create')->layout('layouts.admin');
    }
}
