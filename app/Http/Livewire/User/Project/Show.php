<?php

namespace App\Http\Livewire\User\Project;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Mail\Proposal as ProposalEmail;
use App\Models\Favourite;
use App\Models\Money;
use App\Models\Notification;
use App\Models\Proposal;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Kreait\Firebase\Http\Middleware;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Project;

class Show extends Component
{
    use WithFileUploads, ValidationTrait;

    public $title;
    public $description_ar;
    public $category_id;
    public $image;
    public $skills = [];
    public $moneys = [];
    public $form;
    public $project;
    public $statuses = [];
    public $isFavourite;
    public $dues;
    public $showAddProposal = true;
    public $user;
    public $userType;
    public $showDeliverProject = false;
    public $messageToTellUserCanNotAddProposalOrAdd = '';

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->statuses = Status::where('key', 'project')->get();
        $this->checkIsFavourite();
        $this->checkShowAddProposal();
        $this->user = $this->project->user;
        $this->userType = auth()->user() ? auth()->user()->user_type : '';
        $this->checkShowButtonDeliverProject();

    }

    public function checkShowButtonDeliverProject()
    {
        if (auth()->user()) {

            $proposal = Proposal::where('user_id', \auth()->id())
                ->where('project_id', $this->project->id)
                ->where('status_id', 12)
                ->first();

            if ($proposal && $this->project->status_id == 2) {
                $this->showDeliverProject = true;
            }

        }
    }

    public function deliveryProject()
    {

        $user = User::find($this->project->user_id);

//        Mail::to($user->email)->send(new ProposalEmail($this->project, 'طلب تسليم الصفقة'));

        $this->createNotification($user, $this->project, 'طلب تسليم الصفقة ', 'طلب تسليم الصفقة علي المشروع');

        $this->project->update(['request_to_delivered' => 1]);
        session()->flash('request_to_delivered', 'تم ارسال الطلب بنجاح');
    }

    public function checkShowAddProposal()
    {

        // we need if this user has proposal on this project if ok can edit it else can create
        $this->proposal = Proposal::where('user_id', \auth()->id())
            ->where('project_id', $this->project->id)
            ->first();

        if ($this->proposal && $this->proposal->status_id != 0) {
            $this->showAddProposal = false;
            $this->messageToTellUserCanNotAddProposalOrAdd = 'لاتستطيع ان تقدم عرض او تقوم بالتعديل لان هذا المشروع ليس في مرحله تقديم العروض';
        }

        if (empty($this->messageToTellUserCanNotAddProposalOrAdd)) {
            if ($this->proposal) {
                $this->form = $this->proposal->toArray();
                $this->showAddProposal = true;
            }

        }
        if (\auth()->user()->user_type == 'owner' || $this->project->user_id == \auth()->id()) {
            $this->showAddProposal = false;
        }
    }

    public function addToFavourite()
    {
        if (auth()->user()) {
            Favourite::create([
                'user_id' => auth()->id(),
                'project_id' => $this->project->id,
            ]);
            session()->flash('favourite', 'تم أضافة المشروع الي المفضلة');
        }
    }

    public function checkIsFavourite()
    {
        if (auth()->user()) {
            if (Favourite::where('project_id', $this->project->id)->where('user_id', auth()->id())->exists()) {
                $this->isFavourite = true;
            } else {
                $this->isFavourite = false;
            }
        }
    }

    public function addProposal()
    {
        $user = Auth::user();
        // Check if the user is subscribed to the package containing the feature
        if (!$user->isSubscribed()) {
            abort(403, 'انت غير مشترك في باقة لعمل هذا الاجراء');
        }

        // Check if the package has the specified feature
        if (!$user->activePackage()->hasFeature(2)) {
            abort(403, 'باقاتك الحاليه لاتسمح لك بعمل هذا الاجراء برجاء شراء باقة تدعم هذا الاجراء');
        }


        $this->validate();

        if ($this->proposal) {

            $this->proposal->update([
                'number_of_days' => $this->form['number_of_days'],
                'price' => $this->form['price'],
                'description' => $this->form['description'],
                'dues' => $this->dues,
            ]);
            $user = User::find($this->project->user_id);


//        Mail::to($user->email)->send(new ProposalEmail($this->project, 'عرض جديد علي مشروعك'));

            $this->createNotification($user, $this->project, ' تحديث العرض علي مشروعك', 'تحديث العرض علي مشروعك');

            session()->flash('proposal_created', 'تم تحديث عرضك');
        } else {
            Proposal::create([
                'user_id' => auth()->id(),
                'project_id' => $this->project->id,
                'number_of_days' => $this->form['number_of_days'],
                'price' => $this->form['price'],
                'description' => $this->form['description'],
                'dues' => $this->dues,
            ]);
            $user = User::find($this->project->user_id);


//        Mail::to($user->email)->send(new ProposalEmail($this->project, 'عرض جديد علي مشروعك'));

            $this->createNotification($user, $this->project, 'عرض جديد علي مشروعك', 'عرض جديد علي مشروعك يمكنك الان تصفحة');

            session()->flash('proposal_created', 'تم ارسال عرضك');
        }


        return redirect("user/projects/" . $this->project->id);
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
//            'form.file' => ['required', 'mimes:png,jpg', 'max:2048'],
        ];
    }

    public function store()
    {

        $validatedData = $this->validate();

        $imagePath = $this->form['file']->store('public/images');

        $project = Project::create([
            'title' => $this->form['title'],
            'description_ar' => $this->form['description_ar'],
            'money_id' => $this->form['money_id'],
            'category_id' => $this->form['category_id'],
            'file' => $imagePath,
            'number_of_days' => $this->form['number_of_days'],
            'user_id' => auth()->id(),
        ]);

        $project->skills()->sync($this->form['skills']);
        session()->flash('success', 'تم انشاء مشروعك بنجاج.');

        $this->reset();
    }


    public function render()
    {
        $categories = Category::all();

        return view('livewire.user.project.show', compact('categories'))->layout('layouts.front');
    }
}
