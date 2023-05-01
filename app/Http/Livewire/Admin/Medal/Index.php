<?php

namespace App\Http\Livewire\Admin\Medal;

use App\Models\Category;
use App\Models\Medal;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->page_title = __('site.medals');
    }

    public function destroy(Medal $medal){
        $medal->delete();
    }

    public function render(){
        $records = Medal::latest()->paginate();
        return view('livewire.admin.medal.index',compact('records'))->layout('layouts.admin');
    }
}
