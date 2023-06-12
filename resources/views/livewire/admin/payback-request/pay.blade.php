<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--table-->
    <div class="border-div  print-table">
        <div class="b-btm flex-div-2">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="table-page-wrap" >

            <div class="row">

                <table class='table table-responsive'>
                    <tr>
                        <td class='text-bold'>@lang('site.created_at')</td>
                        <td>{{$paybackRequest->created_at}}</td>
                    </tr>

                    <tr>
                        <td class='text-bold'>@lang('site.user')</td>
                        <td>{{ $paybackRequest->user->first_name. ' '. $paybackRequest->user->last_name}}</td>
                    </tr>

                    <tr>
                        <td class='text-bold'>@lang('site.email')</td>
                        <td>{{$paybackRequest->email}}</td>
                    </tr>

                    <tr>
                        <td class='text-bold'>@lang('site.address')</td>
                        <td>{{$paybackRequest->address}}</td>
                    </tr>

                    <tr>
                        <td class='text-bold'>@lang('site.bank_name')</td>
                        <td>{{$paybackRequest->bank_name}}</td>
                    </tr>

                    <tr>
                        <td class='text-bold'>@lang('site.bank_code')</td>
                        <td>{{$paybackRequest->bank_code}}</td>
                    </tr>

                    <tr>
                        <td class='text-bold'>@lang('site.card_holder')</td>
                        <td>{{$paybackRequest->card_holder}}</td>
                    </tr>

                    <tr>
                        <td class='text-bold'>@lang('site.card_number')</td>
                        <td>{{$paybackRequest->card_number}}</td>
                    </tr>

                    <tr>
                        <td class='text-bold'>@lang('site.amount_want_to_draw')</td>
                        <td>{{$paybackRequest->amount}}</td>
                    </tr>


                    <tr>
                        <td class='text-bold'>@lang('site.amount_can_draw')</td>
                        <td>{{$paybackRequest->user->wallets()->where('amount' ,'>',0)->sum('amount')}}</td>
                    </tr>
                </table>



            </div>
        </div>
    </div>
    <button  class="btn btn-success w-100"  wire:click="printPage">@lang('site.print')</button>
</main>
<script>
    window.addEventListener('printPage', function () {
        window.print();
    });
</script>
<style>
    .print-table,
    .print-table * {
        visibility: visible;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        .print-table,
        .print-table * {
            visibility: visible;
        }
        .print-table {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
