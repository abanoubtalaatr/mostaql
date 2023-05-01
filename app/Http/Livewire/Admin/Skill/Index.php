<?php

namespace App\Http\Livewire\Admin\Skill;

use App\Models\Category;
use App\Models\Skill;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component{
    use WithPagination;
    public $page_title;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->page_title = __('site.skills');
    }

    public function destroy(Skill $skill){
        $skill->delete();
    }

    public function render(){
        $records = Skill::latest()->paginate();
        return view('livewire.admin.skill.index',compact('records'))->layout('layouts.admin');
    }
}
