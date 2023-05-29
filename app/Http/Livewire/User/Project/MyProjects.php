<?php

namespace App\Http\Livewire\User\Project;

use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MyProjects extends Component
{

    public function getRecords()
    {
        return Project::where('user_id', auth()->id())->latest()->get();
    }

    public function deleteProject(Project $project)
    {
         Proposal::where('project_id', $project->id)->delete();
         $project->delete();
    }

    public function render()
    {
        $projects = $this->getRecords();
        return view('livewire.user.project.my-projects', compact('projects'));
    }
}
