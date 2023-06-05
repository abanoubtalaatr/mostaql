<?php

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $currentUser, $de_active_reason, $de_active_from, $de_active_to;


    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->page_title = __('site.projects');
    }

    public function getRecords()
    {
        return Project::query()
            ->latest()->paginate();
    }

    public function approve(Project $project)
    {
        $project->update([
            'status_from_admin' => 'active'
        ]);
    }

    public function disApprove(Project $project)
    {
        $project->update([
            'status_from_admin' => 'reject'
        ]);
    }

    public function render()
    {
        $records = $this->getRecords();

        return view('livewire.admin.project.index', compact('records'))->layout('layouts.admin');
    }
}
