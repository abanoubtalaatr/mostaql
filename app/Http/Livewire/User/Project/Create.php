<?php

namespace App\Http\Livewire\User\Project;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Money;
use App\Models\Skill;
use App\Services\Statuses;
use Illuminate\Support\Str;
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
            'form.file' => ['nullable', 'mimes:png,jpg', 'max:2048'],
            'form.number_of_days' => ['required', 'integer'],
            'form.skills' => ['required', 'array'],
            'form.price'=> ['required', 'integer']
        ];
    }

    public function store()
    {

        $validatedData = $this->validate();

        if (isset($this->form['file'])) {
            $imagePath = $this->form['file']->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->form['file']->extension(), 'public');
        }

        $project = Project::create([
            'title' => $this->form['title'],
            'description_ar' => $this->form['description_ar'],
            'price' => $this->form['price'],
            'category_id' => $this->form['category_id'],
            'file' => $imagePath ?? '',
            'number_of_days' => $this->form['number_of_days'],
            'user_id' => auth()->id(),
            'status_id' => 1,
        ]);

        $project->skills()->sync($this->form['skills']);
        session()->flash('success', 'شكرا لاستخدامك منصة اخدمني . مشروعك قيد الدراسة حاليا وسيتم اشعاركم خلال ٢٤ ساعة القادمة
');

        return redirect(route('user.my_projects'));
    }


    public function render()
    {
        $categories = Category::all();

        return view('livewire.user.project.create', compact('categories'))->layout('layouts.front');
    }
}
