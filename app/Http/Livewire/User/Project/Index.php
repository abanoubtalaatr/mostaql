<?php

namespace App\Http\Livewire\User\Project;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\Ad;
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

    protected $listeners = ['filters'];

    public $title;
    public $filters = [];
    public $perPage = 10;
    public $page = 1;
    protected $projects = [];
    protected $ads = [];

    public $loading = true;

    public function loadMore()
    {
        $this->perPage += 20;
    }

    public function render()
    {
        $categories = Category::all();
        $projects = Project::query();

//        ->whereHas('skills', function ($query) {
//        $query->whereIn('skill_id', auth()->user()->skills->pluck('id'));
//    })
        $this->loading = true;
        if (auth()->user()) {
            $projects = $projects->when(count($this->filters), function ($q) {
                $this->loading = true;
                $q->whereIn('category_id', $this->filters);
            })->when($this->title, function ($q) {
                $q->where('title', 'like', '%' . $this->title . '%');
            })->latest()->paginate($this->perPage);

        } else {
            $projects = Project::query()
                ->when($this->title, function ($query) {
                    $query->where('title', 'like', '%' . $this->title . '%');
                })->when(count($this->filters), function ($q) {
                    $this->loading = true;
                    $q->whereIn('category_id', $this->filters);
                })->latest()->paginate($this->perPage);

        }
        $ads = Ad::active();
        $this->loading = false;
        return view('livewire.user.project.index', compact('categories', 'projects', 'ads'));
    }
}

