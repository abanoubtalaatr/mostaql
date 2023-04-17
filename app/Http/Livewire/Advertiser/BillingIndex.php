<?php

namespace App\Http\Livewire\Advertiser;

use Livewire\Component;
use Livewire\WithPagination;

class BillingIndex extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->page_title = __('site.billing');
    }

    public function render(){
        $records = auth('users')->user()->ads()->whereNotNull('payment_info')->paginate();
        return view('livewire.admin.billing.index',['records'=>$records]);
    }
}
