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
                        <h5 class="card-title">
                            التصنيف
                            <i class="fas fa-gift" style="color: palevioletred"></i>
                        </h5>
                        <button  class="btn extra-purple"  wire:click="$set('filters', [])">حذف الفلتر</button>
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
                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="{{asset('images/adds.png')}}" alt="">
                                    </div>
                                </a>
                            </div>

                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="images/adds.png" alt="">
                                    </div>
                                </a>
                            </div>

                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="images/adds.png" alt="">
                                    </div>
                                </a>
                            </div>

                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="images/adds.png" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="images/adds.png" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="images/adds.png" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="images/adds.png" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="images/adds.png" alt="">
                                    </div>
                                </a>
                            </div>
                            <div class="col mb-2">
                                <a href="" type="button" data-toggle="modal" data-target="#exampleModal">
                                    <div class="card border-0">
                                        <img src="images/adds.png" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 projects-card">
        <div class="row row-cols-1 row-cols-md-2 text-right">
            @foreach($projects as $project)
                <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                    <div class="card bg-transparent">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="card-title">{{$project->category->title_ar}}</h6>
                                <small class="small">{{$project->created_at->diffForHumans()}}</small>
                            </div>
                            <button class="mx-2 mb-2 btn small-btn-border">
                                {{($project->user?$project->user->city->name_ar:'')}}

                                <i class="fas fa-home"></i>
                            </button>
                            {{--                        <button class="mx-2 mb-2 btn small-btn-border">--}}
                            {{--                            دوام كامل--}}
                            {{--                            <i class="fas fa-briefcase"></i>--}}
                            {{--                        </button>--}}
                            <button class="mx-2 mb-2 btn small-btn-border">
                                {{$project->money->name_ar}}
                                <i class="fas fa-money-check-alt"></i>
                            </button>

                            <p class="card-text my-4 content">
                                <span class="dots"></span>
                                <span class="hide more">{{$project->description_ar}}</span>
                            </p>

                            <button class="btn extra-purple mb-2" onclick="readMore(this)">
                                اقرا المزيد
                            </button>

                            <a href="/{{app()->getLocale()}}/user/projects/{{$project->id}}"
                               style="text-decoration: none" class="btn extra-green more mb-2">
                                أضف عرض / تصفح المشروع
                            </a>
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
