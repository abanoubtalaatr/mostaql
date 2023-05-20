<?php

namespace App\Http\Livewire\User\Package;

use App\Models\Package;
use Livewire\Component;
use function view;

class Index extends Component
{
    public $packages;
    public function mount()
    {
        $this->packages = Package::latest()->with('features')->get();
    }

    public function render()
    {
        return view('livewire.user.package.index');
    }
}
