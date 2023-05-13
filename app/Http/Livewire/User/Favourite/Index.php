<?php

namespace App\Http\Livewire\User\Favourite;

use App\Models\Favourite;
use Livewire\Component;
use Livewire\WithPagination;
use function auth;
use function redirect;
use function session;
use function view;

class Index extends Component
{
    use WithPagination;

    public function destroy(Favourite $favourite)
    {
        $favourite->delete();
    }

    public function render()
    {
        $records = \App\Models\Favourite::where('user_id', auth()->id())->get();
        return view('livewire.user.favourite.index', compact('records'))->layout('layouts.front');
    }
}
