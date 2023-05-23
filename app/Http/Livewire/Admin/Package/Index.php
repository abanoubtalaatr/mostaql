<?php

namespace App\Http\Livewire\Admin\Package;

use App\Models\Ad;
use App\Models\Camp;
use App\Models\Package;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->page_title = __('site.packages');
    }


    public function destroy(Package $package)
    {
        $package->delete();
    }

    public function getRecords()
    {
        return
            Package::latest()->paginate();
    }

    public function render()
    {

        return view('livewire.admin.package.index', ['records' => $this->getRecords()])->layout('layouts.admin');
    }
}
