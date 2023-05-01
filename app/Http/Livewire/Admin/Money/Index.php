<?php

namespace App\Http\Livewire\Admin\Money;

use App\Models\Category;
use App\Models\Money;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->page_title = __('site.money');
    }

    public function destroy(Money $money){
        $money->delete();
    }

    public function render(){
        $records = Money::latest()->paginate();
        return view('livewire.admin.money.index',compact('records'))->layout('layouts.admin');
    }
}
