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
                                <img src="{{asset('images/Ellipse 5.png')}}" alt="">
                            </div>
                            <p class="mt-2">{{$user->first_name. ' '. $user->last_name}}</p>
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
        </div>
    </div>
    <div class="container mt-2">
        <div class="row row-cols-2 row-cols-md-3 text-center" style="direction: rtl">
            <div class="col mb-1">
                <div class="card bg-transparent border-0">
                    <div class="card-body">
                        <button class="btn extra-green px-3 mb-3">عضو موثوق</button>
                    </div>
                </div>
            </div>
            @if(auth()->id() != $user->id )
                <div class="col mb-1">
                    <div class="card bg-transparent border-0">
                        <div class="card-body">
                            <button class="btn extra-purple mb-3" id="idUser" onclick="copyContent()"
                                    title="يمكنك من خلال رقم العضويه البحث عن المستخدم او ابلاغ الاداره من خلال رقم العضويه - اضغط للطباعه">
                                {{$user->id}}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col mb-1">
                    <div class="card bg-transparent border-0">
                        <div class="card-body">
                            <a href="{{route('user.chats',['chat' => $user->id])}}" class="btn extra-green px-3 mb-3">تواصل
                                الان</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container-fluid left-side-user mt-5">
        <div class="row row-cols-1 row-cols-md-1 text-right" style="direction: rtl">
            <div class="col-md-5 mb-4">
                <div class="card border mb-4">
                    <div class="card-body">
                        <h5 class="card-title">إحصائيات</h5>
                        <div class="row row-cols-2 text-right mx-2 row-cols-lg-2 row-cols-md-2 row-cols-sm-2">
                            <h6 class="my-2">التقييمات</h6>
                            <h6 class="my-2">

                                @for ($i = 1; $i <= $user->averageRates(); $i++)
                                    <img src="{{asset('images/Star 1.png')}}" alt="">
                                @endfor

                            </h6>
                            <h6 class="my-2">المشاريع المكتملة</h6>
                            <h6 class="my-2">{{$user->completedProposals->count()}} مشاريع مكتمله</h6>
                            <h6 class="my-2">مشاريع تحت التنفيذ</h6>
                            <h6 class="my-2">{{$user->processingProposals->count()}} تحت التنفيذ</h6>

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
                            <li class="nav-item mx-0" role="presentation">
                                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile"
                                        type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    <i class="fas fa-star"></i>
                                    التقييمات
                                </button>
                            </li>
                            <li class="nav-item mx-0" role="presentation">
                                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact"
                                        type="button" role="tab" aria-controls="contact" aria-selected="false">
                                    <i class="fas fa-briefcase"></i>
                                    سابقه اعمالي
                                </button>
                            </li>
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
                                                                @if($user->avatar)
                                                                    <img width="40" height="40"
                                                                         class="rounded-circle mb-3"
                                                                         src="{{asset($user->minimized_picture)}}"
                                                                         alt="">
                                                                @else
                                                                    <img width="40" height="40"
                                                                         src="{{asset('images/Group 60.png')}}" alt="">
                                                                @endif

                                                            </div>
                                                            <strong
                                                                class="m-1">{{$rate->project?$rate->project->user->first_name :''}}</strong>
                                                        </div>
                                                        <div class="mx-1">
                                                            @for ($i = 1; $i <= $rate->rate; $i++)
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
                                    @foreach($user->acceptedProposals as $proposal)
                                        <div class="col mb-2">
                                            <a data-toggle="modal" data-target="#exampleModal">
                                                <div class="card border-0 bg-transparent">
                                                    <div class="card-body">
                                                        <img src="{{asset('images/project-1.png')}}"
                                                             class="card-img-top mb-1">
                                                        <h6 class="card-title">{{$proposal->project->title}}</h6>
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
