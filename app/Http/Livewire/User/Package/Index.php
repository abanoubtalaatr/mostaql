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
        $user = User::find(auth()->id());

        $currentPackageIdForUser = $user->activePackage() ? $user->activePackage()->id : 0;

        $this->packages = Package::where('id', '!=', $currentPackageIdForUser)->latest()->with('features')->get();
    }

    public function subscribe($packageId)
    {
        $pay = new PayLinkService();
        $package = Package::find($packageId);
        $user = User::find(auth()->id());


        if($user->wallet >= $package->price) {
            \App\Models\PackageUser::create([
                'user_id' => \auth()->id(),
                'package_id' => $package->id,
                'end_at' => \Carbon\Carbon::now()->addMonths($package->period),
            ]);

            $user->update(['wallet' => $user->wallet - $package->price]);

            session()->flash('message', 'تم خصم قيمة الباقة من محفظتك');
            return redirect()->to(route('user.get_profile', auth()->id()));
        }
        if ($package) {
            $pay->pay($package->price, $user, 'payForPackage', $package, null, null);
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
