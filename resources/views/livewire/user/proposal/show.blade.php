<div class="container-fluid mt-5">
    <div class="row row-cols-1 row-cols-md-2 details-proposal">
        <div class="col-md-7 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img width="50" height="50" src="{{$proposal->user->avatar}}" alt="">
                            <strong>{{$proposal->user->first_name .' '. $proposal->user->last_name}}</strong>
                        </div>
                        <div class="mx-1">
                            @for ($i = 1; $i <= $proposal->user->averageRates(); $i++)
                                <img src="{{asset('images/Star 1.png')}}" alt="">
                            @endfor
                        </div>
                    </div>

                    <div class="d-flex justify-content-around my-4">
                        <div>
                            <p class="card-text">مدة التسليم</p>
                            <p class="card-text">{{$proposal->number_of_days}} ايام</p>
                        </div>
                        <div>
                            <p class="card-text">قيمة العرض</p>
                            <p class="card-text">{{$proposal->price}} ريال </p>
                        </div>
                    </div>
                    <h6 class="card-title text-right">تفاصيل العرض المقدم</h6>
                    <p class="card-text text-right">
                        {{$proposal->description}}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card">
                <div class="card-body text-right">
                    <h5 class="card-title">الموافقه علي الصفقه</h5>
                    <p class="card-text my-4">
                        في حاله الموافقه علي الصفقه سوف يتم ارسال الاموال من خلال جهتكم
                        ليتم الاحتفاظ بها عن طريق الموقع ولن يتم تسليمها الي المستقل الا
                        في حاله تمت الموافقه علي تسليم الصفقه من خلالكم مع العلم سوف
                        يضمن لك الموقع الاحتفاظ بالاموال لمده 14 يوم من بعد نزولها في
                        حساب المستقل حيث لن يتمكن من سحب الارباح الا بعد مرور 14 يوما
                        بعد تسليم العمل بشكل كامل حيث في تلك الفتره هذه يضمن لك الموقع
                        استعاده اموالك في حاله اذا حدثت عمليه نصب من خلال المستقل
                    </p>
                    <button type="submit" class="btn extra-green mb-2" wire:click.prevent="pay">التوظيف وحجز المبلغ للتنفيذ
                    </button>
                    <a href="/{{app()->getLocale()}}/user/profile/{{$proposal->user->id}}"
                       class="btn extra-purple mb-2 text-decoration-none">
                        عرض ملف المستقل
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
