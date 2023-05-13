<?php

namespace App\Http\Livewire\User\Proposal;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Admin;
use App\Models\Money;
use App\Models\Notification;
use App\Models\Proposal;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Project;
use Livewire\WithPagination;

class Show extends Component
{
    use WithFileUploads;
    use ValidationTrait;
    use WithPagination;

    public $title;
    public $filter;
    public $proposal;

    public function mount(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    public function pay()
    {
        //must pay first
        $this->proposal->update(['status_id' => 7]);
        $project = Project::find($this->proposal->project_id);
        $project->update(['status_id' => 3]);
        $user = User::find($project->user_id);
        $this->createNotification($user, $project);
    }

    public function createNotification($user, $project)
    {
        $title_ar = "تم قبول عرضك";
        $content_ar = "تم قبول عرضك علي مشروع $project->title";
        $user_id = $user->id;
        $type = 'proposal';

        Notification::create([
            'title_ar' => $title_ar,
            'content_ar' => $content_ar,
            'user_id' => $user_id,
            'type' => $type
        ]);
    }

    public function render()
    {
        $proposal = $this->proposal;

        return view('livewire.user.proposal.show', compact('proposal'));
    }
}