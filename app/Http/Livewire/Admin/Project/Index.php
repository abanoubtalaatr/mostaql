<?php

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

include_once app_path('helpers.php');


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

        if ($project->request_to_edit == 1) {
            $message = __('site.the_request_to_edit_project_has_been_accepted');
            $body = __('site.the_request_to_edit_project_has_been_accepted');
            createNotificationInDatabase($message, $body, $project->user, $project);
        } else {
            $message = __('site.the_project_has_been_accepted');
            $body = __('site.the_project_has_been_accepted');
            createNotificationInDatabase($message, $body, $project->user, $project);
        }

        $project->update([
            'status_from_admin' => 'active',
            'request_to_edit' => 0,
        ]);
    }

    public function disApprove(Project $project)
    {
        if ($project->request_to_edit == 1) {
            $message = __('site.the_request_to_edit_project_has_been_rejected');
            $body = __('site.the_request_to_edit_project_has_been_rejected');
            createNotificationInDatabase($message, $body, $project->user, $project);
        } else {
            $message = __('site.the_project_has_been_rejected');
            $body = __('site.the_project_has_been_rejected');
            createNotificationInDatabase($message, $body, $project->user, $project);
        }

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
