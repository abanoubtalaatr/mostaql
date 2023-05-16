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

    public $title;
    public $filters = [];
    public $perPage = 10;
    public $page = 1;
    protected $projects = [];
    protected $ads= [];

    public function mount()
    {
        $this->ads = Ad::get();
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        $categories = Category::all();
        $projects = Project::query();

        if (auth()->user()) {
            $projects = $projects->when(count($this->filters), function ($q) {
                $q->whereIn('category_id', $this->filters);
            })->whereHas('skills', function ($query) {
                $query->whereIn('skill_id', auth()->user()->skills->pluck('id'));
            })->latest()->paginate($this->perPage);
        } else {
            $projects = Project::query()
                ->when($this->title, function ($query, $title) {
                    $query->where('title', 'like', '%' . $title . '%');
                })->when(count($this->filters), function ($q) {
                    $q->whereIn('category_id', $this->filters);
                })->latest()->paginate($this->perPage);;
        }
        $ads = $this->ads;

        return view('livewire.user.project.index', compact('categories', 'projects', 'ads'));
    }
}
