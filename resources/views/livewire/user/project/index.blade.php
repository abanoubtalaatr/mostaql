<div>
    <div class="bg">
        <div class="container bg-transparent">
            <div class="text-right">
                <h5 class="card-title mx-4">المشاريع المتاحه</h5>
            </div>
            <div class="row row-cols-1 text-right row-cols-md-2" style="direction: rtl">
                <div class="col-md-10 mb-1">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body">
                            <input wire:model='title' type="search" placeholder="ابحث عن عمل" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-1">
                    <div class="card border-0 bg-transparent">
                        <div class="card-body">
                            {{--                        <button class="btn extra-green py-2 px-5">بحث</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($ad))
        <div class="container mt-5">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-md-1 text-right">
                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                    <div class="card bg-transparent">
                        <div class="card-body">
                            <div
                                class="row advertisement row-cols-1 row-cols-md-1 py-1 text-center"
                            >
                                <div class="col-md-12 mb-1">

                                    <a
                                        href=""
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#exampleModal{{$ad->id}}"
                                    >
                                        <div class="card border-0 new-img-adds-v2">
                                            <img src="{{asset($ad->photo_url)}}" class="w-100" alt=""/>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="container mt-5 projects-card">
        @if($loading==true)
            <div class="loader" style="margin: auto;padding-bottom: 30px;margin-bottom: 30px;">
            </div>
        @endif
        <div class="row row-cols-1 row-cols-md-2 text-right">
            @foreach($projects as $project)
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <div class="card bg-transparent">
                        <div class="card-body">
                            <div class="top-pj-color">
                                <a href="/{{app()->getLocale()}}/user/projects/{{$project->id}}">
                                    <h6 class="card-title">{{$project->title}}</h6>
                                </a>
                                <button class="mx-2 mb-1 btn small-btn-border">
                                    <a href="/{{app()->getLocale()}}/user/profile/{{$project->user->id}}">
                                        {{$project->user->first_name .' '. $project->user->last_name}}
                                        <i class="fas fa-user"></i>
                                    </a>
                                </button>
                                <button class="mx-2 mb-1 btn small-btn-border">
                                    <a href="javascript:void(0)">
                                        {{($project->user?$project->user->city->name_ar:'')}}
                                        <i class="fas fa-home"></i>
                                    </a>
                                </button>
                                <button class="mx-2 mb-1 btn small-btn-border">
                                    <a href="javascript:void(0)">
                                        {{$project->created_at->diffForHumans()}}
                                        <i class="fas fa-clock"></i>
                                    </a>
                                </button>

                                <button class="mx-2 mb-1 btn small-btn-border">
                                    <a href="javascript:void(0)">
                                        {{$project->price}}
                                        <i class="far fa-money-bill-alt"></i>
                                    </a>
                                </button>
                            </div>

                            <p class="card-text my-3 content">
                                {{$project->description_ar}}
                            </p>

                            <button class="btn extra-purple mb-2" onclick="readMore(this)">
                                اقرا المزيد
                            </button>
                            @if($project->status_id !=3)
                                <a
                                    href="/{{app()->getLocale()}}/user/projects/{{$project->id}}"
                                    style="text-decoration: none"
                                    class="btn extra-green more mb-2"
                                >
                                    اضف عرضك الان
                                </a>
                            @endif

                            <button class="mx-2 mb-1 btn small-btn-border">
                                <a href="javascript:void(0)">
                                    <span> {{$project->proposals->count()}} </span>
                                    عرض
                                    <i class="fas fa-ticket-alt"></i>
                                </a>
                            </button>
                            <p class="my-2 card-text case-of-project">
                                <span> حاله المشروع : </span>
                                @if($project->status_id == 1 || $project->status_id ==0)
                                    <span>مرحله العروض</span>
                                @endif
                                @if($project->status_id == 2 )
                                    <span>تحت التنفيذ</span>
                                @endif
                                @if($project->status_id == 3 )
                                    <span>مكتمل</span>
                                @endif
                            </p>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="text-center mt-4">
            @if ($projects->hasMorePages())
                <div class="text-center mt-4">
                    <button class="btn extra-purple" wire:click="loadMore">المزيد</button>
                </div>
            @endif
        </div>

    </div>
</div>
@if($ad)
    <div class="modal fade" id="exampleModal{{$ad->id}}" tabindex="-1"
         aria-labelledby="exampleModalLabel{{$ad->id}}"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h5 class="modal-title text-right mx-3 mb-1 mt-3" id="exampleModalLabel{{$ad->id}}">
                    {{$ad->title}}
                </h5>
                <hr>
                <div class="modal-body text-center">
                    <img height="250" src="{{asset($ad->photo_url)}}" width="100%" alt="">
                    <p class="mt-3">يمكنكم التواصل عن طريق الوسائل المتاحة التاليه</p>
                    <div
                        class="row row-cols-6 p-0 mr-5 row-cols-lg-6 text-center row-cols-md-6 row-cols-sm-6">
                        @if(!empty($ad->snap_chat))
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->snap_chat}}" class="join-us"><i
                                                class="fab fa-snapchat-ghost"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($ad->website))
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->website}}" class="join-us"><i
                                                class="fas fa-globe-europe"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($ad->location))
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->location}}" class="join-us"><i
                                                class="fas fa-map-marker-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($ad->facebook))
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->facebook}}" class="join-us"><i
                                                class="fab fa-facebook-square"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($ad->instagram))
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->instagram}}" class="join-us"><i
                                                class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($ad->twitter))
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->twitter}}" class="join-us"><i
                                                class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn extra-purple" data-dismiss="modal">
                        اغلاق
                    </button>
                    <a href="/{{app()->getLocale()}}/support" type="button" class="btn extra-green">اعمل
                        اعلان</a>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
    .modal {
        z-index: 400000;
    }

    .loader {
        border: 10px solid #f3f3f3;
        border-radius: 50%;
        border-top: 10px solid var(---green);
        width: 100px;
        height: 100px;
        -webkit-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
