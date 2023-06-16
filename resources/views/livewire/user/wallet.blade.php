<div class="container">
    @if(session()->has('payback_request_message_fail'))
        <div class="alert alert-danger text-right my-5">{{session()->get('payback_request_message_fail')}}</div>
    @endif
    @if(session()->has('payback_request_message_success'))
        <div class="alert alert-success text-right my-5">{{session()->get('payback_request_message_success')}}</div>
    @endif
    <div class="box-title text-right mb-3 mt-5">
        <h4 class="card-title">رصيد الحساب</h4>
    </div>
    <div class="row row-cols-1 pt-4 text-center row-cols-md-2 bg-white">
        <div class="col mb-4">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h5 class="card-title">الرصيد المعلق</h5>
                    <h2 class="card-title">
                        <span class="d-inline-block">  ريال  </span>
                        <span
                            class="d-inline-block">{{round( $user->wallets()->where('can_withdraw', 0)->sum('amount'),2)}} </span>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col mb-4">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h5 class="card-title">الرصيد الكلي</h5>
                    <h2 class="card-title">
                        <span class="d-inline-block">
                            ريال
                        </span>
                        <span class="d-inline-block">
                        {{round($user->wallet,2)}}
                        </span>
                    </h2>

                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h5 class="card-title">الرصيد القابل للسحب</h5>
                    <h2 class="card-title">
                        <span class="d-inline-block">ريال  </span>
                        <span
                            class="d-inline-block"> {{round($user->wallet,2)}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h5 class="card-title">الرصيد المتاح</h5>
                    <h2 class="card-title">
                        <span class="d-inline-block">ريال  </span>
                        <span class="d-inline-block">{{round($user->wallet,2)}}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
{{--    @if(round($user->wallets()->where('can_withdraw',1)->sum('amount'),3) > 0 && !\App\Models\PaybackRequest::where('user_id' , auth()->id())->where('status', 'not_paid')->exists())--}}
        <div class="text-center my-4">
            <button class="btn btn-info small-btn-border" data-toggle="modal" data-target="#staticBackdrop">
                طلب سحب الرصيد
            </button>
        </div>
        <div class="text-center my-4">
            <button class="btn btn-info small-btn-border" data-toggle="modal" data-target="#fillWallet">
شحن المحفظه            </button>
        </div>
{{--    @endif--}}
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('user.request_withdrawal')}}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-row text-right">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> المبلغ المالي</label>
                                <input name="amount" type="number" class="form-control" id="inputEmail4">
                                @error('form.amount') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> بريدك الاكتروني</label>
                                <input name="email" type="email" class="form-control" id="inputEmail4">
                                @error('form.email') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">اسم البنك </label>
                                <input name="bank_name" type="text" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> كود البنك </label>
                                <input name="bank_code" type="text" class="form-control" id="inputEmail4">
                                @error('form.bank_code') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4"> أسم حامل البطاقة </label>
                                <input name="card_holder" type="text" class="form-control" id="inputEmail4">
                                @error('form.card_holder') <span
                                    class="error text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">رقم البطاقة </label>
                                <input name="card_number" type="text" class="form-control" id="inputEmail4">
                                @error('form.cart_number') <span
                                    class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">عنوانك </label>
                                <input name="address" type="text" class="form-control" id="inputEmail4">
                                @error('form.address') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                تراجع
                            </button>
                            <button type="submit" class="btn btn-primary">طلب سحب</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
        <div class="modal fade" id="fillWallet" data-backdrop="fill" data-keyboard="false" tabindex="-1"
             aria-labelledby="fillWalletLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('user.recharge')}}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-row text-right">
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"> المبلغ المالي</label>
                                    <input name="amount" type="number" class="form-control text-right" id="inputEmail4">
                                    @error('form.amount') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    تراجع
                                </button>
                                <button type="submit" class="btn btn-primary">شحن</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

</div>
