<div class="container mt-5 projects-card">
    <div class="text-right">
        <h4 class="card-title">عروضي </h4>
    </div>
    <div class="row row-cols-1 row-cols-md-2 text-right">
        @foreach($projects as $project)
            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="card-title">{{$project->title}}</h6>
                        </div>
{{--                        @if($project->request_to_delivered && $project->status_id ==2 )--}}
{{--                            <button wire:click="acceptDelivery({{$project->id}})" class="btn btn-danger mb-2">--}}
{{--                                المواقفة علي استلام المشروع--}}
{{--                                <i class="fas fa-briefcase"></i>--}}
{{--                            </button>--}}
{{--                        @endif--}}
                        <div>

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
                        </div>

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
            </div>
        @endforeach

    </div>
</div>
