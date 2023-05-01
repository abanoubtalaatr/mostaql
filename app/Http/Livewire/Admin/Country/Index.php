<?php

namespace App\Http\Livewire\Admin\Country;

use App\Models\Category;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){

        $this->page_title = __('site.countries');
    }

    public function destroy(Country $country){
        $country->delete();
    }

    public function render()
    {
        $records = Country::paginate();

        return view('livewire.admin.country.index',compact('records'))->layout('layouts.admin');
    }
}
