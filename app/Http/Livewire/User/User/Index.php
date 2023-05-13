<?php

namespace App\Http\Livewire\User\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $results;
    public $perPage = 10;


    public function mount()
    {

    }
    public function loadMore()
    {
        $this->perPage += 10;
    }


    public function render()
    {
        $users = User::where('user_type', 'freelancer')->where('id', '!=', auth()->id())
            ->when(isset($this->search), function ($q) {
                $q->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('id', $this->search);
            })->paginate($this->perPage);

        return view('livewire.user.user.index', compact('users'));
    }
}
