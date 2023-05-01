<?php

namespace App\Http\Livewire\Admin\Skill;

use App\Models\Category;
use App\Models\Skill;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Create extends Component{
    use WithFileUploads,ValidationTrait;

    public $form,$page_title,$picture;
    public function mount(){
        $this->page_title = __('site.create_skill');
    }

    public function store(){
        $this->validate();
//        $this->form['picture'] = $this->picture->storeAs(date('Y/m/d'),Str::random(50).'.'.$this->picture->extension(),'public');
        Skill::create($this->form);
        session()->flash('success_message',__('site.created_successfully'));
        return redirect()->to(url('admin/skills'));
    }


    public function getRules(){
        return [
            'form.name_ar'=>'required|max:500',
//            'form.title_en'=>'required|max:500',
//            'picture'=>'required|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }
    public function render(){
        return view('livewire.admin.skill.create')->layout('layouts.admin');
    }
}
