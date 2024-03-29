<?php

namespace App\Http\Livewire\User\User;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $results;
    public $perPage = 10;
    public $status;


    public function mount(Request $request)
    {
        $this->status = $request->query('status');
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }


    public function render()
    {
        $users = User::query()->where('id', '!=', auth()->id() ?? 0)->where('user_type', 'freelancer');
        $users = User::when(isset($this->search), function ($users) {
            $users
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('id', $this->search);
        })->paginate($this->perPage);

        return view('livewire.user.user.index', compact('users'));
    }
}
