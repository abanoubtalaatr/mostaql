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
use App\Models\Wallet;
use App\Services\PayLinkService;
use App\Services\Statuses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        // check if has enough money to pay with wallet if not redirect him if not


        $project = Project::find($this->proposal->project_id);
        $payLink = new PayLinkService();
        $user = User::find($project->user_id);

        $amountFromWallet  = $user->wallet;

        if($amountFromWallet >= $this->proposal->price) {
            Wallet::create([
                'user_id' => $this->proposal->user->id,
                'amount' => $this->proposal->price,
                'project_id' => $project->id,
                'can_withdraw' => 0,
                'reason_ar' => 'حجز المبلغ لحين تنفيذ المشروع'
            ]);

            $title_ar = "تم قبول عرضك";
            $content_ar = "تم قبول عرضك علي مشروع $project->title";
            $user_id = $this->proposal->user_id;
            $type = 'proposal';

            Notification::create([
                'title_ar' => $title_ar,
                'content_ar' => $content_ar,
                'user_id' => $user_id,
                'type' => $type
            ]);

            $project->update(['status' => 2, 'paid' => 1]);
            $this->proposal->update(['status_id' => 12]);

            $project->user->update(['wallet' => $project->user->wallet - $this->proposal->price]);

            session()->flash('message', 'تم سحب قيمة المشروع من المحفظة');
            return redirect()->route('user.get_profile', \auth()->id());
        }else{
            return $payLink->pay($this->proposal->price, $user, 'payForProject', null, $project, $this->proposal);
        }
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
