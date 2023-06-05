<?php

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\ValidationTrait;

class Show extends Component
{
    use WithFileUploads, ValidationTrait;

    public $form;
    public $project;
    public $page_title;

    public function mount(Project $project)
    {
        $this->page_title = __('site.project_details');
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.admin.project.show')->layout('layouts.admin');
    }
}
