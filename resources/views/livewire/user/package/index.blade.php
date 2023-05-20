<div class="packedges mt-0">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col mb-4 content-1">
                <div class="card bg-transparent border-0">
                    <div class="card-body text-left">
                        <img src="{{asset('images/ksa-flag.png')}}" alt="ksa-flag">
                    </div>
                </div>
            </div>
            <div class="col mb-4 content-2">
                <div class="card bg-transparent border-0">
                    <div class="card-body text-right">
                        <h4 class="card-title">ترقية الحساب</h4>
                        <p class="card-text">
                            هذه الباقه تمكنك من العمل علي الموقع فا من خلال الاشتراك في
                            باقه سوف تتيح لك المزيد من المميزات داخل الموقع حيث من خلال
                            الاشتراك سوف تتمكن من تقديم عرضك داخل المشاريع حتي يتم توظيفك
                            من خلال اصحاب المشاريع وحصولك علي الاموال من خلال موقعنا
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container text-center">
    <img src="{{asset('images/ubgrades 1.png')}}" style="width: 100%" alt="">
</div>

<div class="container packedge-cards mt-5">
    <div class="row row-cols-1 py-5 row-cols-lg-4 row-cols-md-2">
        @foreach($packages as $package)
            <div class="col text-center mb-4">
                <div class="card border-0">
                    <div class="card-body">
                        <h5 class="card-title border py-3">{{$package->title_ar}}</h5>
                        <h5 class="card-title py-3" style="direction: rtl">
                            {{$package->price}} ريال سعودي
                        </h5>
                        @foreach($package->features as $feature)
                            <div class="d-flex justify-content-between align-center">
                                <p class="card-text">
                                    {{$feature->title_ar}}
                                </p>
                                <p class="card-text">
                                    <i class="fas fa-check"></i>
                                </p>
                            </div>
                        @endforeach
                        <hr class="text-white bg-white">
                        <div class="text-center">
                            <button class="btn small-btn-border text-white border">
                                <img src="{{asset('images/arrow-left.png')}}" class="bg-danger-white" alt="arrow">
                                اشترك الان
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
