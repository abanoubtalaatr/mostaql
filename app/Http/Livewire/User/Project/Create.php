<?php

namespace App\Http\Livewire\User\Project;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Money;
use App\Models\Skill;
use App\Services\Statuses;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Project;

class Create extends Component
{
    use WithFileUploads, ValidationTrait;

    public $title;
    public $description_ar;
    public $category_id;
    public $image;
    public $skills = [];
    public $moneys = [];
    public $form;


    public function mount()
    {
        $this->skills = Skill::all();
        $this->moneys = Money::all();
    }

    public function getRules()
    {
        return [
            'form.title' => 'required|max:500',
            'form.description_ar' => ['required', 'string', 'min:4'],
            'form.category_id' => ['required', 'exists:categories,id'],
            'form.money_id' => ['required', 'exists:money,id'],
            'form.file' => ['required', 'mimes:png,jpg', 'max:2048'],
            'form.number_of_days' => ['required', 'integer'],
            'form.skills' => ['required', 'array'],
        ];
    }

    public function store()
    {

        $validatedData = $this->validate();

        $imagePath = $this->form['file']->store('public/images');

        $money = Money::find($this->form['money_id']);
        if ($money) {
            $moneyName = $money->name_ar;
        } else {
            $moneyName = '';
        }

        $project = Project::create([
            'title' => $this->form['title'],
            'description_ar' => $this->form['description_ar'],
            'price' => $moneyName,
            'category_id' => $this->form['category_id'],
            'file' => $imagePath,
            'number_of_days' => $this->form['number_of_days'],
            'user_id' => auth()->id(),
            'status_id' => 1,
        ]);

        $project->skills()->sync($this->form['skills']);
        session()->flash('success', 'تم انشاء مشروعك بنجاج.');

        return redirect(route('user.my_proposals'));
    }


    public function render()
    {
        $categories = Category::all();

        return view('livewire.user.project.create', compact('categories'))->layout('layouts.front');
    }
}
