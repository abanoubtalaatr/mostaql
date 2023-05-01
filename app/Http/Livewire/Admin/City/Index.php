<?php

namespace App\Http\Livewire\Admin\City;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){

        $this->page_title = __('site.cities');
    }

    public function destroy(City $city){
        $city->delete();
    }

    public function render()
    {
        $records = City::with('country')->latest()->paginate();


        return view('livewire.admin.city.index',compact('records'))->layout('layouts.admin');
    }
}
