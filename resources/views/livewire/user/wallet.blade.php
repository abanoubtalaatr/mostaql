<div class="container">
    <div class="box-title text-right mb-3 mt-5">
        <h4 class="card-title">رصيد الحساب</h4>
    </div>
    <div class="row row-cols-1 pt-4 text-center row-cols-md-2 bg-white">
        <div class="col mb-4">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h5 class="card-title">الرصيد المعلق</h5>
                    <h2 class="card-title">
                        <span class="d-inline-block">  دولار </span>
                        <span
                            class="d-inline-block">{{ $user->wallets()->where('can_withdraw', 0)->sum('amount')}} </span>
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
                            دولار
                        </span>
                        <span class="d-inline-block">
                        {{$user->wallets()->sum('amount')}}
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
                        <span class="d-inline-block">دولار </span>
                        <span class="d-inline-block"> {{$user->wallets()->where('can_withdraw', 1)->sum('amount')}}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h5 class="card-title">الرصيد المتاح</h5>
                    <h2 class="card-title">
                        <span class="d-inline-block">دولار </span>
                        <span class="d-inline-block">{{$user->wallets()->sum('amount')}}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
