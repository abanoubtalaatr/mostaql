<div class="container-fluid project-id mt-5" style="direction:ltr">
    @if (session()->has('proposal_created'))
        <div class="alert alert-success w-75 mt-3 text-right" style="margin-left: 25%">
            {{ session()->get('proposal_created') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 text-right">

        <div class="col-md-4 mb-4">

            <div class="card descripe-project">

                <div class="card-body">
                    <h5 class="card-title">وصف المشروع</h5>
                    <hr>
                    <p class="card-text">
                        {{$project->description_ar??''}}
                    </p>
                    <hr>
                    @if(isset($project->file))
                        <a target="_blank" class="text-white" href="{{url('uploads/pics/' . $project->file)}}"> <i
                                class="fa fa-file mx-3"></i>مرفقات المشروع</a>
                    @endif
                </div>
            </div>

            <div class="card descripe-project my-4" dir="rtl">
                <div class="card-body">
                    <h5 class="card-title">المهارات المطلوبة</h5>
                    <hr>
                    <div class="row row-cols-2 text-center row-cols-lg-4 row-cols-md-3 row-cols-sm-3">

                        @foreach($project->skills as $skill)
                            <div>
                                <p class="mx-1 mb-1">{{$skill->name_ar}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card project-card">
                <div class="card-body mb-4">
                    <h5 class="card-title text-white">بطاقة المشروع</h5>
                    <hr>
                    <div class="row row-cols-2 text-right mx-2 row-cols-lg-2 row-cols-md-2 row-cols-sm-2">
                        <h6 class="my-2">{{$project->created_at->diffForHumans()}}</h6>
                        <h6 class="my-2">تاريخ النشر</h6>
                        <h6 class="my-2">{{$project->price}}</h6>
                        <h6 class="my-2">الميزانية</h6>
                        <h6 class="my-2">{{$project->number_of_days}}</h6>
                        <h6 class="my-2">مدة التنفيذ</h6>
                        <h6 class="my-2">{{$project->proposals->count()}}</h6>
                        <h6 class="my-2">عدد العروض</h6>
                    </div>
                </div>
                <div class="card-body mb-4">
                    <div class="row row-cols-2 text-right mx-2 row-cols-lg-3 row-cols-md-1 row-cols-sm-2"
                         style="direction: rtl">

                        @foreach($statuses as $status)
                            <button
                                class="btn p-1 @if($project->status_id == $status->id) status @endif">{{$status->name}}</button>
                        @endforeach
                    </div>
                </div>
                <div class="card-body mb-4">
                    <span>صاحب المشروع</span>
                    <hr>
                    <div class="mt-3">
                        <a class="text-white" href="/{{app()->getLocale()}}/user/profile/{{$user->id}}">
                            <span>{{$user? $user->first_name:''}} {{$user->last_name}}</span>
                        </a>
                        <img width="50" height="50" class="rounded-circle" src="{{$user?$user->avatar:""}}" alt="">
                    </div>
                    <ul class="d-flex justify-content-between mt-2 mb-0">
                        <li>{{$user? $user->city->name_ar:"" }} - {{$user? $user->country->value:''}}</li>
                        <li>{{$user->job_title}}</li>
                    </ul>
                </div>
            </div>
            @if(auth()->user())
                @if(!$isFavourite)
                    <button wire:click="addToFavourite" class="btn extra-purple">اضف الي المفضله</button>
                @endif
            @endif

            @if($showDeliverProject)
                <button wire:click="deliveryProject" class="btn extra-purple">تسليم الصفقة</button>
            @endif

            @if (session()->has('favourite'))
                <div class="alert alert-success w-75 mt-3" style="margin-left: 25%">
                    {{ session()->get('favourite') }}
                </div>
            @endif

            @if (session()->has('request_to_delivered'))
                <div class="alert alert-success w-75 mt-3" style="margin-left: 25%">
                    {{ session()->get('request_to_delivered') }}
                </div>
            @endif
        </div>
        <div class="col-md-8 mb-4">
            @if(!empty($messageToTellUserCanNotAddProposalOrAdd))
                <div class="alert alert-danger">{{$messageToTellUserCanNotAddProposalOrAdd}}</div>
            @endif
            @if($showAddProposal)
                <div class="card">
                    <form wire:submit.prevent="addProposal">
                        <div class="text-right">
                            <h4 class="card-title">{{$project->category->title_ar}}</h4>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">اضف عرضك الان</h6>
                            <hr>
                            <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 row-cols-sm-2"
                                 style="direction: rtl">
                                <div class="col-lg-4 col-md-12 my-2">
                                    <label for="">مدة التسليم</label>
                                    <input wire:model.defer="form.number_of_days" type="text"
                                           class="form-control text-right">
                                    @error('form.number_of_days') <span
                                        class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                                <div class="col-lg-4 my-2" style="position: relative">
                                    <label for="">قيمة العرض</label>
                                    <div class="full-card">
                                        <input wire:model.defer="form.price" wire:change="setPlatformDues" type="text"
                                               class="form-control text-right">
                                        <span class="small-left-card">ريال</span>


                                    </div>
                                    <small class="mobile-sc-2">
                                        ريال10 مستحقاتك بعد خصم عمولة الموقع</small>
                                    @error('form.price') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-lg-4 col-sm-12 my-2 mobile-sc">
                                    <label for="">مستحقاتك</label>
                                    <div class="full-card">
                                        <input wire:model.defer="dues" type="text" disabled=""
                                               class="form-control text-right"
                                               style="cursor: not-allowed" value="0 ريال">
                                        <span class="small-left-card disabled">ريال</span>
                                    </div>
                                    <small class="mobile-sc">بعد خصم عمولة موقع </small>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <label for="">تفاصيل العرض</label>
                                    <textarea wire:model.defer="form.description" class="form-control text-right" id=""
                                              rows="3"></textarea>
                                    @error('form.description') <span
                                        class="error text-danger">{{ $message }}</span> @enderror

                                </div>
                                {{--                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">--}}
                                {{--                                    <label for="">اضافه ملفات</label>--}}
                                {{--                                    <input type="file" wire:model.defer="form.file" class="form-control-file">--}}
                                {{--                                    @error('form.file') <span class="error text-danger">{{ $message }}</span> @enderror--}}

                                {{--                                </div>--}}
                            </div>
                            @if(auth()->user())
                                <button class="btn extra-purple my-3">اضف الان</button>
                            @else
                                <a href="/{{app()->getLocale()}}/user/login">
                                    <div class="alert alert-danger">
                                        سجل دخول اولا لتتمكن من اضافة عرض
                                    </div>
                                </a>
                                {{--                                <h6 class="text-danger"></h6>--}}
                            @endif
                        </div>
                    </form>
                </div>
            @endif

            @if($project->proposals->count() > 0)
                <h5> العروض علي هذا المشروع</h5>
            @endif
            @foreach($project->proposals as $proposal)
                <div class="card mb-3 purposal border">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>

                                <ul class="navbar-nav fr-user-settings">
                                    <li class="nav-item dropdown">
                                        <a
                                            class="nav-link dropdown-toggle"
                                            href="#"
                                            role="button"
                                            data-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            التفاصيل
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/{{app()->getLocale()}}/user/proposals/{{$proposal->id}}">تفاصيل العرض</a>
                                            <a class="dropdown-item" href="/{{app()->getLocale()}}/user/projects/{{$project->id}}">تعديل العرض</a>
                                            <a class="dropdown-item" href="/{{app()->getLocale()}}/support"
                                            >ارسال بلاغ</a
                                            >
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mx-2 d-flex">
                                    <div class="mx-1">
                                        @if($proposal->user)
                                            @for ($i = 1; $i <= $proposal->user->averageRates(); $i++)
                                                <img src="{{asset('images/Star 1.png')}}" alt="">
                                            @endfor
                                        @endif
                                    </div>

                                    <a class="text-dark"
                                       href="/{{app()->getLocale()}}/user/profile/{{$proposal->user->id}}">
                                        {{$proposal->user?$proposal->user->first_name:'' .$proposal->user->last_name}}
                                    </a>
                                </div>
                                <div>
                                    <img class="rounded-circle" height="50" width="50" src="{{$proposal->user->avatar}}"
                                         alt="">
                                </div>
                            </div>
                        </div>
                        <ul class="maker-details">
                            <li>
                                <i class="fas fa-briefcase"></i>

                                {{$proposal->user->job_title}}
                            </li>
                            <li>
                                <i class="fas fa-home"></i>
                                {{$proposal->user->city->name_ar??''}}
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                {{$proposal->created_at->diffForHumans()}}
                            </li>
                        </ul>
                        <p class="card-text mt-2">
                            {{$proposal->description}}
                        </p>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>
