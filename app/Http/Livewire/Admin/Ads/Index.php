<?php

namespace App\Http\Livewire\Admin\Ads;

use App\Models\Ad;
use App\Models\Camp;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $page_title;
    public $title, $camp_id, $status;
    public $camps;
    protected $queryString = ['title', 'camp_id', 'status'];

    public function mount()
    {
        $this->page_title = __('site.ads');
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function deactivate(Ad $ad)
    {
        $ad->update(['status' => 'inactive']);
    }


    public function destroy(Ad $advertisement)
    {
        $advertisement->delete();
    }

    public function getRecords()
    {

        return
            Ad::latest()->paginate();
    }

    public function render()
    {
        return view('livewire.admin.ads.index', ['records' => $this->getRecords()])->layout('layouts.admin');
    }
}
