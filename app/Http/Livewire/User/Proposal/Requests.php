<?php

namespace App\Http\Livewire\User\Proposal;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Mail\Proposal as ProposalEmail;
use App\Models\Admin;
use App\Models\Money;
use App\Models\Notification;
use App\Models\Proposal;
use App\Models\ProposalEditRequest;
use App\Models\Skill;
use App\Models\User;
use App\Services\PayLinkService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Project;
use Livewire\WithPagination;

class Requests extends Component
{
    use WithFileUploads;
    use ValidationTrait;
    use WithPagination;

    public $title;
    public $filter;


    public function rejectRequest(ProposalEditRequest $request)
    {
        $request->update(['status' => 'reject']);
        $message = __('site.your_request_has_been_rejected');

        createNotificationInDatabase($message, $message, $request->freelancer, $request->project);
    }

    public function acceptRequest(ProposalEditRequest $request)
    {
        // if the new price > old price either decrease from wallet or payment accross paylink
        $willDecrease = $request->price - $request->proposal->price;

        if ($request->price > $request->proposal->price) {
            //check first if the project owner has enough money
            $wallet = $request->project->user->wallet;
            //decrease the  amount from
            if ($willDecrease <= $wallet) {

                $request->project->user->update(['wallet' => $request->project->user->wallet - $willDecrease]);
                $message = __('site.your_request_to_edit_proposal_has_been_accepted');

                createNotificationInDatabase($message, $message, $request->freelancer, $request->project);
                $total = $request->price;

                $settings = \App\Models\Setting::first();
                $request->proposal->update([
                    'price' => $total,
                    'dues' =>$total - ($total / $settings->platform_dues),
                    'description' => $request->description,
                    'number_of_days' => $request->number_of_days,
                ]);

                $request->project->update([
                    'price' => $total,
                    'description_ar' => $request->description,
                    'number_of_days' => $request->number_of_days,
                ]);

                $request->update(['status' => 'accept']);
            } else {
                //will redirect to pay
                //after redirect from payment
                $payLink = new PayLinkService();

                return $payLink->pay($willDecrease, $request->project->user, 'EditProposal', null, $request->project, $request->proposal);
            }
        }else{
            $request->proposal->update([
                'description' => $request->description,
                'number_of_days' => $request->number_of_days,
            ]);

            $request->project->update([
                'description_ar' => $request->description,
                'number_of_days' => $request->number_of_days,
            ]);

            $request->update(['status' => 'accept']);
        }
    }

    public function getRecords()
    {
        return auth()->user()->proposalRequests;
    }

    public function render()
    {
        $requests = $this->getRecords();

        return view('livewire.user.proposal.requests', compact('requests'))->layout('layouts.front');
    }
}
