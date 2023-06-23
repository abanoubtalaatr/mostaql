@extends('layouts.front')
@section('content')

    <div class="user">
        <img src="{{asset('images/bg-user.png')}}" alt="Snow">
        <div class="container bg-white">
            <div class="row row-cols-1 row-cols-md-1 text-center">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                    <div class="card bg-transparent border-0 text-center">
                        <div class="card-body">
                            <div class="rounded">
                                <img width="80" height="80" class="rounded-circle" src="{{$user->avatar}}" alt="">
                            </div>
                            <p class="mt-2">
                                {{$user->first_name. ' '. $user->last_name}}
                                <img class="verified-account"
                                     style="width: 15px !important; height: 15px !important"
                                     src="{{asset('images/certi.svg')}}" alt="">
                            </p>

                            <ul class="d-flex justify-content-center">
                                <li class="mx-1">
                                    {{trans('site.'.$user->user_type)}}
                                    <i class="fas fa-money-check-alt"></i>
                                </li>
                                <li class="mx-1">
                                    {{$user->city? $user->city->name_ar:''}}
                                    - {{$user->country? $user->country->value :''}}
                                    <i class="fas fa-home"></i>
                                </li>
                                <li class="mx-1">
                                    {{$user->job_title}}
                                    <i class="fas fa-briefcase"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/{{app()->getLocale()}}/user/chats?chat={{$user->id}}" class="btn extra-green px-3"
               style="position: absolute; top: 10px; left: 20px">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>
    {{--    <div class="container mt-2">--}}
    {{--        <div class="row row-cols-2 row-cols-md-3 text-center" style="direction: rtl">--}}
    {{--                <div class="col mb-1">--}}
    {{--                    <div class="card bg-transparent border-0">--}}
    {{--                        <div class="card-body">--}}
    {{--                            <button class="btn extra-purple mb-3"--}}
    {{--                                    >--}}
    {{--                                --}}
    {{--                            </button>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--        </div>--}}
    {{--    </div>--}}

    @if(auth()->check() && auth()->user()->user_type !='freelancer' && auth()->id() != $user->id)
        <div class="text-center my-5">
            <button type="button" class="btn extra-purple" data-toggle="modal" data-target="#exampleModal">
                تقييم المنفذ
            </button>
        </div>
    @endif
    @if(session()->has('message'))
    <div class="alert alert-success text-right my-2">{{session()->get('message')}}</div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger text-right my-2">{{session()->get('error')}}</div>
    @endif
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('user.rating')}}">
                        @csrf
                        @method('post')
                        <input hidden name="freelancer_id" value="{{$user->id}}">
                        <div id="full-stars-example-two">
                            <div class="rating-group mb-2">
                                <input name="rating" disabled="" checked="" class="rating__input rating__input--none"
                                       id="rating3-none" value="0" type="radio">
                                <label aria-label="1 star" class="rating__label" for="rating3-1"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>

                                <input class="rating__input" name="rating" id="rating3-1" value="1" type="radio">
                                <label aria-label="2 stars" class="rating__label" for="rating3-2"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating3-2" value="2" type="radio">
                                <label aria-label="3 stars" class="rating__label" for="rating3-3"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating3-3" value="3" type="radio">
                                <label aria-label="4 stars" class="rating__label" for="rating3-4"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating3-4" value="4" type="radio">
                                <label aria-label="5 stars" class="rating__label" for="rating3-5"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating3-5" value="5" type="radio">
                            </div>
                        </div>

                        <div class="form-group text-right" style="direction: rtl">
                            <label for="rate-freelancer"> ما هو رايك في منفذ الخدمه ؟ </label>
                            <textarea name="comment" class="form-control rate-text-clinet" id="rate-freelancer"
                                      rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                اغلاق
                            </button>
                            <button type="submit" class="btn extra-purple">نشر التقييم</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid left-side-user mt-5">
        <div class="row row-cols-1 row-cols-md-1 text-right" style="direction: rtl">
            <div class="col-md-5 mb-4">
                <div class="card border mb-4">
                    <div class="card-body">
                        <h5 class="card-title">إحصائيات</h5>
                        <div class="row row-cols-2 text-right mx-2 row-cols-lg-2 row-cols-md-2 row-cols-sm-2">
                            <h6 class="my-2">رقم العضويه</h6>
                            <h6 class="my-2"
                                title="يمكنك من خلال رقم العضويه البحث عن المستخدم او ابلاغ الاداره من خلال رقم العضويه - اضغط للطباعه">
                                {{$user->id}}
                            </h6>
                            <h6 class="my-2">التقييمات</h6>
                            <h6 class="my-2">
                                @for ($i = 1; $i <= $user->averageRates(); $i++)
                                    <img src="{{asset('images/Star 1.png')}}" alt="">
                                @endfor

                            </h6>
                            <h6 class="my-2">المشاريع المكتملة</h6>
                            <h6 class="my-2">{{$completedProject}} مشاريع مكتمله</h6>
                            <h6 class="my-2">مشاريع تحت التنفيذ</h6>
                            <h6 class="my-2">{{$underWork}} تحت التنفيذ</h6>

                            <h6 class="my-2">تاريخ الانضمام</h6>
                            <h6 class="my-2">عام - {{$user->created_at->format("Y")}}</h6>
                            <h6 class="my-2">أوسمة</h6>

                            <h6 class="my-2" style="cursor: pointer">
                                @foreach($user->medals as $medal)
                                    <img src="{{asset('uploads/pics/'.$medal->picture)}}" style="width: 25px"
                                         class="mx-1"
                                         alt="5"
                                         title="مستخدم ملتزم قام بتسليم 5 مشاريع بنجاح">
                                @endforeach
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 card-center mb-4">
                <div class="card border mb-4">
                    <div class="card-body">
                        <h5 class="card-title">المهارات</h5>
                        <div class="row row-cols-2 text-right mx-2 row-cols-lg-2 row-cols-md-2 row-cols-sm-2"
                             style="direction: ltr">
                            @foreach($user->skills as $skill)
                                <div>
                                    <p class="mx-1 mb-1">
                                        {{$skill->name_ar}}
                                        <i class="fas mx-1 fa-circle"></i>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border mb-4">
                    <div class="card-body">
                        <h5 class="card-title">توثيقات</h5>
                        <div class="row row-cols-2 text-right mx-2 row-cols-lg-1 row-cols-md-1 row-cols-sm-1"
                             style="direction: rtl">

                            <div>
                                <p class="mx-1 mb-2" style="font-size: 15px">
                                    @if($user->isOnline())
                                        <span class="text-white">أونلاين الان</span>
                                    @else
                                        <span class="text-white">غير متاح الان</span>
                                    @endif
                                </p>

                            </div>
                            <div>
                                <p class="mx-1 mb-2" style="font-size: 15px">
                                    <i class="fas fa-check"></i>
                                    البريد الإلكتروني
                                </p>
                            </div>
                            <div>
                                <p class="mx-1 mb-2" style="font-size: 15px">
                                    <i class="fas fa-check"></i>
                                    رقم الجوال
                                </p>
                            </div>
                            <div>
                                <p class="mx-1 mb-2" style="font-size: 15px">
                                    <i class="fas fa-check"></i>
                                    الهوية الشخصية
                                </p>
                            </div>
                            <div>
                                <p class="mx-1 mb-2" style="font-size: 15px">
                                    <i class="fas fa-check"></i>
                                    عضو موثوق
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card bg-transparent right-side-user border" style="direction: rtl">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item mx-0" role="presentation">
                                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home"
                                        type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <i class="fas fa-user"></i>
                                    الملف الشخصي
                                </button>
                            </li>
                            {{--                            @if(isset($user->activePackage()->id) &&$user->activePackage()->hasFeature(4))--}}
                            <li class="nav-item mx-0" role="presentation">

                                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    <i class="fas fa-star"></i>
                                    التقييمات
                                </button>

                            </li>
                            {{--                            @endif--}}
                            {{--                            @if(isset($user->activePackage()->id) && $user->activePackage()->hasFeature(3))--}}
                            <li class="nav-item mx-0" role="presentation">
                                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact"
                                        type="button" role="tab" aria-controls="contact" aria-selected="false">
                                    <i class="fas fa-briefcase"></i>
                                    سابقه اعمالي
                                </button>
                            </li>
                            {{--                            @endif--}}
                        </ul>
                        <div class="tab-content border-0" id="myTabContent">
                            <div class="tab-pane fade show active my-5" id="home" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <div class="text-right">
                                    <h5 class="card-title">نبذة عني</h5>
                                </div>
                                <p class="card-text">
                                    {{$user->description}}
                                </p>
                            </div>
                            <div class="tab-pane fade my-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row row-cols-1 text-right mx-2 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                    @foreach($user->rates as $rate)

                                        <div class="col">
                                            <div class="card mb-3 border-0">
                                                <div class="card-body bg-white">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex">
                                                            <div>

                                                                @if($rate->owner->avatar)
                                                                    <img width="40" height="40"
                                                                         class="rounded-circle "
                                                                         src="{{asset($rate->owner->avatar)}}"
                                                                         alt="">
                                                                @else
                                                                    <img width="40" height="40"
                                                                         src="{{asset('images/Group 60.png')}}" alt="">
                                                                @endif
                                                                <a href="/{{app()->getLocale()}}/user/profile/{{$rate->owner->id}}">
                                                                    <strong
                                                                        class="m-1">{{$rate->owner->first_name . ' '.$rate->owner->last_name}}</strong>
                                                                </a>
                                                            </div>

                                                        </div>
                                                        <div class="mx-1">
                                                            @for ($i = 1; $i <= $rate->rating; $i++)
                                                                <img src="{{asset('images/Star 1.png')}}" alt="">
                                                            @endfor

                                                        </div>
                                                    </div>
                                                    <p class="card-text mt-2">
                                                        {{$rate->comment}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade my-5" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row row-cols-1 text-right row-cols-lg-4 row-cols-md-3 row-cols-sm-2">
                                    @foreach($user->works as $work)
                                        <div class="col mb-2">
                                            <a data-toggle="" data-target="#exampleModal">
                                                <div class="card border-0 bg-transparent">
                                                    <div class="card-body">
                                                        <img height="200"
                                                             src="{{asset(url('uploads/pics/' . $work->file))}}"
                                                             class="card-img-top mb-1">
                                                        <hr>
                                                        <h6 class="card-title">{{$work->name}}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let text = document.getElementById("idUser").innerHTML;
        const copyContent = async () => {
            try {
                await navigator.clipboard.writeText(text);
                console.log("Content copied to clipboard");
            } catch (err) {
                console.error("Failed to copy: ", err);
            }
        };
    </script>
@endsection
