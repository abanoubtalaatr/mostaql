<?php

namespace App\Http\Livewire\Admin\Medal;

use App\Models\Category;
use App\Models\Medal;
use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

class Edit extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form, $page_title, $picture;

    public function mount(Medal $medal)
    {
        $this->medal = $medal;
        $this->form = Arr::except($medal->toArray(), ['updated_at', 'created_at', 'id']);
        $this->page_title = __('site.edit_medal');
    }

    public function store()
    {
        $this->validate();
        $this->form['picture'] =
            $this->picture ?
                $this->picture->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->picture->extension(), 'public') : $this->medal->picture;
        $this->medal->update($this->form);
        session()->flash('success_message', __('site.saved_successfully'));
        return redirect()->to(url('admin/medals'));
    }


    public function updatedFormPicture()
    {
        $this->withValidator(function (Validator $validator) {
            if ($validator->errors()->has('form.picture')) {
                $this->form['picture'] = '';
            }
        })->validateOnly('form.picture');
    }


    public function getRules()
    {
        return [
            'form.title_ar' => 'required|max:300',
            'form.description_ar' => 'required|max:300',
            'picture' => 'nullable|file|mimes:png,jpg,jpeg|max:10240'
        ];
    }

    public function render()
    {
        return view('livewire.admin.medal.create')->layout('layouts.admin');
    }
}
