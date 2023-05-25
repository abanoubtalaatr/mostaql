<?php

namespace App\Http\Livewire\User\Package;

use App\Models\Package;
use App\Models\User;
use App\Services\PayLinkService;
use Livewire\Component;
use function view;

class Index extends Component
{
    public $packages;

    public function mount()
    {
        $this->packages = Package::latest()->with('features')->get();
    }

    public function subscribe($packageId)
    {
        $pay = new PayLinkService();
        $package = Package::find($packageId);
        $user = User::find(auth()->id());

        if ($package) {
            $pay->pay($package->price, $user, 'payForPackage', $package);
        }
    }

    public function doSomething($id)
    {
        dd($id);
    }

    public function render()
    {
        return view('livewire.user.package.index')->layout('layouts.front');
    }
}
