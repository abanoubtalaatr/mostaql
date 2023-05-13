<div class="container-fluid bids mt-5">
    <div class="text-right">
        <h4 class="card-title">عروضي ومشاريعي</h4>
    </div>
    <div class="row row-cols-1 text-right row-cols-lg-2 row-cols-md-2">
        @foreach($projects as $project)
            <div class="col mb-4">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h6 class="card-title">{{$project->category->title_ar}}</h6>
                            <small class="small">{{$project->created_at->diffForHumans()}}</small>
                        </div>
                        <button class="mx-2 mb-2 btn small-btn-border">
                            {{$project->user->city ? $project->user->city->name_ar:''}}
                            <i class="fas fa-home"></i>
                        </button>

                        <button class="mx-2 mb-2 btn small-btn-border">
                            {{$project->money?$project->money->name_ar:''}}
                            <i class="fas fa-money-check-alt"></i>
                        </button>

                        <p class="card-text my-4 content">
                            <span class="dots">{{$project->title}}</span>
                            <span class="hide more">{{$project->description_ar }}</span>
                        </p>

                        <button class="btn extra-purple mb-2" onclick="readMore(this)">
                            اقرا المزيد
                        </button>
                        <a style="text-decoration: none" href="/{{app()->getLocale()}}/user/projects/{{$project->id}}" class="btn extra-green mb-2">مشاهدة
                            الان</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
