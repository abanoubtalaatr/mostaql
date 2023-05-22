<div class="container">
<div class="row row-cols-1 pt-4 text-center row-cols-md-2 bg-white">
    <div class="col mb-4">
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <h5 class="card-title">الرصيد المعلق</h5>
                <h2 class="card-title">دولار {{$user->wallets()->where('can_withdraw', 0)->sum('amount')}}</h2>
            </div>
        </div>
    </div>

    <div class="col mb-4">
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <h5 class="card-title">الرصيد الكلي</h5>
                <h2 class="card-title">دولار {{$user->wallets()->sum('amount')}}</h2>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <h5 class="card-title">الرصيد القابل للسحب</h5>
                <h2 class="card-title">دولار {{$user->wallets()->where('can_withdraw', 1)->sum('amount')}}</h2>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <h5 class="card-title">الرصيد المتاح</h5>
                <h2 class="card-title">دولار {{$user->wallets()->sum('amount')}}</h2>
            </div>
        </div>
    </div>
</div>
</div>
