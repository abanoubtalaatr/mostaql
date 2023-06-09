<?php

namespace App\Http\Livewire\User\Project;

use App\Models\Notification;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MyProjects extends Component
{
    public $showPopup = false;
    public $project;

    public function createNotification($user, $project, $message, $body)
    {
        $title_ar = $message;
        $content_ar = "$body ( $project->title )";
        $user_id = $user->id;
        $type = 'proposal';

        Notification::create([
            'title_ar' => $title_ar,
            'content_ar' => $content_ar,
            'user_id' => $user_id,
            'type' => $type
        ]);
    }

    public function acceptDelivery(Project $project)
    {
        //send notification for freelancer
        $proposal = Proposal::where('project_id', $project->id)->where('status_id', 12)->first();

        $user = User::find($proposal->user_id);

        if ($user) {
//            Mail::to($user->email)->send(new ProposalEmail($project, ' مبروك تمت الموافقة علي تسليم الصفقة'));
            $this->createNotification($user, $project, ' مبروك تمت الموافقة علي تسليم الصفقة', ' مبروك تمت الموافقة علي تسليم الصفقة');


            // create a wallet for him
            $user->wallets()->create([
                'user_id' => $user->id,
                'amount' => $proposal->dues,
                'reason_ar' => 'تم تفيذ مشروع بنجاح',
                'project_id' => $project->id,
            ]);

            //change status for project to delivered
            $project->update([
                'status_id' => 3
            ]);

            return redirect()->to('ar/user/my-projects');
        }
    }

    public function getRecords()
    {
        return Project::where('user_id', auth()->id())->where('status_from_admin', 'active')->latest()->get();
    }

    public function confirmDelete()
    {
        $this->project->delete();
        $this->showPopup = !$this->showPopup;
    }

    public function deleteProject(Project $project)
    {
        $this->project = $project;
        $this->showPopup = !$this->showPopup;
    }

    public function render()
    {
        $projects = $this->getRecords();
        return view('livewire.user.project.my-projects', compact('projects'));
    }
}
