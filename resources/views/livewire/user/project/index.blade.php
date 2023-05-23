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
    <div class="container mt-5" style="direction: ltr">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-md-1 text-right">
            <div class="col-lg-5 col-md-12 col-sm-12 mb-4">
                <div class="card border categories bg-transparent">
                    <div class="card-body">
                        {{--                        <h5 class="card-title">--}}
                        {{--                            التصنيف--}}
                        {{--                            <i class="fas fa-gift" style="color: palevioletred"></i>--}}
                        {{--                        </h5>--}}
                        {{--                        <button class="btn extra-purple" wire:click="$set('filters', [])">حذف الفلتر</button>--}}
                        <div class="row">
                            @foreach($categories as $category)
                                <div class="col-md-12 mt-2">
                                    <label class="form-check-label mr-4" for="">
                                        {{$category->title_ar}}
                                    </label>
                                    <input class="form-check-input mt-2" type="checkbox" value="{{$category->id}}"
                                           id="" wire:model="filters">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 mb-4">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="row advertisement row-cols-2 row-cols-md-3 py-1 text-center">
                            @foreach($ads as $ad)
                                <div class="col mb-2">
                                    <a href="" type="button" data-toggle="modal" data-target="#exampleModal{{$ad->id}}">
                                        <div class="card border-0">
                                            <img src="{{asset($ad->photo_url)}}" alt="">
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
    @foreach($ads as $ad)
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
                        <div
                            class="row row-cols-3 row-cols-lg-3 text-center row-cols-md-3 row-cols-sm-3">
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->snap_chat}}" class="join-us"><i
                                                class="fab fa-snapchat-ghost"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->website}}" class="join-us"><i
                                                class="fas fa-globe-europe"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->location}}" class="join-us"><i
                                                class="fas fa-map-marker-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->facebook}}" class="join-us"><i
                                                class="fab fa-facebook-square"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->instagram}}" class="join-us"><i
                                                class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-1">
                                <div class="card bg-transparent border-0">
                                    <div class="card-body">
                                        <a target="_blank" href="{{$ad->twitter}}" class="join-us"><i
                                                class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
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
    @endforeach
    <div class="container mt-5 projects-card">
        <div class="row row-cols-1 row-cols-md-2 text-right">

            @foreach($projects as $project)

                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <a href="">
                        <div class="card bg-transparent">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="card-title">{{$project->title}}</h6>
                                    <small class="small">{{$project->created_at->diffForHumans()}}</small>
                                </div>
                                <ul class="owner-details">
                                    <li>
                                        <i class="fas fa-user"></i>
                                        {{$project->user->first_name . ' ' . $project->user->last_name}}
                                    </li>
                                    <li>
                                        <i class="fas fa-paperclip"></i>
                                        {{$project->user->projects->count()}} <span class="d-inline-block">عرض  </span>
                                    </li>
                                </ul>
                                <button class="mx-2 mb-2 btn small-btn-border">
                                    {{($project->user?$project->user->city->name_ar:'')}}

                                    <i class="fas fa-home"></i>
                                </button>
                                <button class="mx-2 mb-2 btn small-btn-border">
                                    {{$project->created_at->diffForHumans()}}
                                    <i class="fas fa-clock"></i>
                                </button>
                                <button class="mx-2 mb-2 btn small-btn-border">
                                    {{$project->price}}
                                    <i class="fas fa-money-check-alt"></i>
                                </button>

                                <p class="card-text my-4 content">
                                    <span class="dots">{{$project->title}}</span>
                                    <span class="hide more">{{$project->description_ar}}</span>
                                </p>

                                <button class="btn extra-purple mb-2" onclick="readMore(this)">
                                    اقرا المزيد
                                </button>

                                <a href="/{{app()->getLocale()}}/user/projects/{{$project->id}}"
                                   style="text-decoration: none" class="btn extra-green more mb-2">
                                    تصفح المشروع
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            @if($loading)
                <div class="spinner">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>
            @endif

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

<style>
    .spinner {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner .dot1,
    .spinner .dot2 {
        width: 1em;
        height: 1em;
        border-radius: 50%;
        background-color: #333;
        animation: bounce 2s infinite ease-in-out;
    }

    .spinner .dot2 {
        animation-delay: -1s;
    }

    @keyframes bounce {
        0% {
            transform: translate(0, 0);
        }

        50% {
            transform: translate(0, 1em);
        }

        100% {
            transform: translate(0, 0);
        }
    }
</style>
