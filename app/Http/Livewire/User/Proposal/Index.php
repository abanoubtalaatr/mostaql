<?php

namespace App\Http\Livewire\User\Proposal;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Mail\Proposal as ProposalEmail;
use App\Models\Admin;
use App\Models\Money;
use App\Models\Notification;
use App\Models\Proposal;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
//        $proposedProjects = DB::table('proposals')
//            ->where('user_id', auth()->id())
//            ->select('project_id as id')
//            ->get()
//            ->pluck('id')
//            ->toArray();
//
//        dd( Project::whereIn('id', $proposedProjects)->latest()->get()->count());
//
        return auth()->user()->proposals;

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

            return redirect()->to('ar/user/my-proposals');
        }
    }


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

    public function render()
    {
        $categories = Category::all();
        $proposals = $this->getRecords();

        return view('livewire.user.proposal.index', compact('categories', 'proposals'))->layout('layouts.front');
    }
}
