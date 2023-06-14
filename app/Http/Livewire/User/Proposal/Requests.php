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
        $message = __('your_request_has_been_rejected');

        createNotificationInDatabase($message, $message,$request->freelancer,$request->project);
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
