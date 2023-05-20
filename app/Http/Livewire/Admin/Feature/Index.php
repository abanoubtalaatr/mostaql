<?php

namespace App\Http\Livewire\Admin\Feature;

use App\Models\Ad;
use App\Models\Camp;
use App\Models\feature;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->page_title = __('site.package_features');
    }


    public function destroy(feature $feature)
    {
        $feature->delete();
    }

    public function getRecords()
    {
        return Feature::latest()->paginate();
    }

    public function render()
    {

        return view('livewire.admin.feature.index', ['records' => $this->getRecords()])->layout('layouts.admin');
    }
}
