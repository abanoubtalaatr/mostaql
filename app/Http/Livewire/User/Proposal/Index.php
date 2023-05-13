<?php

namespace App\Http\Livewire\User\Proposal;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Admin;
use App\Models\Money;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Project;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use ValidationTrait;
    use WithPagination;

    public $title;
    public $filter;

    public function getRecords()
    {
        $createdProjects = DB::table('projects')
            ->where('user_id', auth()->id())
            ->select('id')
            ->get()
            ->pluck('id')
            ->toArray();

        $proposedProjects = DB::table('proposals')
            ->where('user_id', auth()->id())
            ->select('project_id as id')
            ->get()
            ->pluck('id')
            ->toArray();

        $projectIds = array_merge($createdProjects, $proposedProjects);

        return Project::whereIn('id', $projectIds)->get();
    }

    public function render()
    {
        $categories = Category::all();
        $projects = $this->getRecords();

        return view('livewire.user.proposal.index', compact('categories', 'projects'))->layout('layouts.front');
    }
}
