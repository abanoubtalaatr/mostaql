<?php

namespace App\Http\Livewire\User\Project;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Mail\ProposalCreated;
use App\Models\Favourite;
use App\Models\Money;
use App\Models\Notification;
use App\Models\Proposal;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Project;

class Show extends Component
{
    use WithFileUploads, ValidationTrait;

    public $title;
    public $description_ar;
    public $category_id;
    public $image;
    public $skills = [];
    public $moneys = [];
    public $form;
    public $project;
    public $statuses = [];
    public $isFavourite;
    public $dues;
    public $showAddProposal = true;
    public $user;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->statuses = Status::where('key', 'project')->get();
        $this->checkIsFavourite();
        $this->checkShowAddProposal();
        $this->user = $this->project->user;

    }

    public function checkShowAddProposal()
    {
        $IHaveProposalForThisProject = Proposal::where('user_id', auth()->id())->where('project_id', $this->project->id)->exists();

        if ($this->project->user_id == auth()->id() || auth()->user()->user_type == 'owner' || $IHaveProposalForThisProject) {
            $this->showAddProposal = false;
        }
    }

    public function addToFavourite()
    {
        Favourite::create([
            'user_id' => auth()->id(),
            'project_id' => $this->project->id,
        ]);
        session()->flash('favourite', 'تم أضافة المشروع الي المفضلة');
    }

    public function checkIsFavourite()
    {
        if (Favourite::where('project_id', $this->project->id)->where('user_id', auth()->id())->exists()) {
            $this->isFavourite = true;
        } else {
            $this->isFavourite = false;
        }
    }

    public function addProposal()
    {
        $this->validate();
        $this->form['file'] = $this->form['file']->storeAs(date('Y/m/d'), Str::random(50) . '.' . $this->form['file']->extension(), 'public');

        Proposal::create([
            'user_id' => auth()->id(),
            'project_id' => $this->project->id,
            'file' => $this->form['file'],
            'number_of_days' => $this->form['number_of_days'],
            'price' => $this->form['price'],
            'description' => $this->form['description'],
            'dues' => $this->dues,
        ]);

        $user = User::find($this->project->user_id);


        Mail::to($user->email)->send(new ProposalCreated($this->project));

        $this->createNotification($user, $this->project);
        $this->reset();
        session()->flash('proposal_created', 'تم ارسال عرضك');
    }

    public function createNotification($user, $project)
    {
        $title_ar = "عرض سعر جديد";
        $content_ar = "عرض سعر جديد علي مشروعك  ( $project->title )";
        $user_id = $user->id;
        $type = 'proposal';

        Notification::create([
            'title_ar' => $title_ar,
            'content_ar' => $content_ar,
            'user_id' => $user_id,
            'type' => $type
        ]);
    }

    public function setPlatformDues()
    {
        if ($this->form['price']) {
            $settings = Setting::first();
            $this->dues = $this->form['price'] - ($this->form['price'] / $settings->platform_dues);
        }
    }

    public function getRules()
    {
        return [
            'form.number_of_days' => ['required', 'integer'],
            'form.price' => ['required', 'integer'],
            'form.description' => ['required', 'string', 'min:4'],
            'form.file' => ['required', 'mimes:png,jpg', 'max:2048'],
        ];
    }

    public function store()
    {

        $validatedData = $this->validate();

        $imagePath = $this->form['file']->store('public/images');

        $project = Project::create([
            'title' => $this->form['title'],
            'description_ar' => $this->form['description_ar'],
            'money_id' => $this->form['money_id'],
            'category_id' => $this->form['category_id'],
            'file' => $imagePath,
            'number_of_days' => $this->form['number_of_days'],
            'user_id' => auth()->id(),
        ]);

        $project->skills()->sync($this->form['skills']);
        session()->flash('success', 'تم انشاء مشروعك بنجاج.');

        $this->reset();
    }


    public function render()
    {
        $categories = Category::all();

        return view('livewire.user.project.show', compact('categories'))->layout('layouts.front');
    }
}