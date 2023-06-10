<?php

namespace App\Http\Livewire\User\Proposal;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Mail\Proposal as ProposalEmail;
use App\Models\Admin;
use App\Models\Money;
use App\Models\Notification;
use App\Models\Proposal;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Status;
use App\Models\User;
use App\Services\PayLinkService;
use App\Services\Statuses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Project;
use Livewire\WithPagination;

class Edit extends Component
{
    use WithFileUploads;
    use ValidationTrait;
    use WithPagination;

    public $project, $proposal, $filter, $title, $form, $dues, $statuses, $user;

    public function mount(Project $project, Proposal $proposal)
    {
        $this->project = $project;
        $this->proposal = $proposal;
        $this->statuses = Status::where('key', 'project')->get();
        $this->user = $this->project->user;
        $this->form = $proposal->toArray();
    }

    public function store()
    {
        $this->validate();
        $this->proposal->update([
            'number_of_days' => $this->form['number_of_days'],
            'price' => $this->form['price'],
            'description' => $this->form['description'],
            'dues' => $this->dues,
        ]);

        session()->flash('proposal_created', 'تم تحديث عرضك');
        $this->emit('goBack');
    }


    public function setPlatformDues()
    {
        if ($this->form['price']) {
            $settings = Setting::first();
            $this->dues = $this->form['price'] - ($this->form['price'] / $settings->platform_dues);
        }
    }

    public function getRules()
    {
        return [
            'form.number_of_days' => ['required', 'integer'],
            'form.price' => ['required', 'integer'],
            'form.description' => ['required', 'string', 'min:4'],
        ];
    }

    public function render()
    {
        $proposal = $this->proposal;

        return view('livewire.user.proposal.edit', compact('proposal'));
    }
}
