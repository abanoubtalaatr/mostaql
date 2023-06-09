<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        return view('front.user.proposal.index');
    }

    public function show(Proposal $proposal)
    {
        return view('front.user.proposal.show', compact('proposal'));
    }

    public function editProposal(Project $project, Proposal $proposal)
    {
        return view('front.user.proposal.edit', compact('project', 'proposal'));
    }

    public function proposalRequestEdit()
    {
        return view('front.user.proposal.requests');
    }
}
