<?php

namespace App\Http\Livewire\Admin\PaybackRequest;

use App\Http\Livewire\Traits\ValidationTrait;
use App\Models\PaybackRequest;

use Livewire\Component;

class Pay extends Component{
    use ValidationTrait;
    public $paybackRequest,$page_title;
    public $form;

    public function mount(PaybackRequest $paybackRequest){
        $this->paybackRequest = $paybackRequest;
        $this->page_title = __('site.pay_now');
    }

    public function printPage()
    {
        $this->dispatchBrowserEvent('printPage');
    }


    public function render(){
        return view('livewire.admin.payback-request.pay')->layout('layouts.admin');
    }
}
