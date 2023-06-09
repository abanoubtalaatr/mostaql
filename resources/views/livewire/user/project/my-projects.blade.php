<div class="container mt-5 projects-card">
    <div class="text-right">
        <h4 class="card-title"> مشاريعي</h4>
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success text-right" role="alert">
          {{session()->get('success')}}
        </div>
    @endif
    <div class="row row-cols-1 row-cols-md-2 text-right">
        @foreach($projects as $project)
            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="/{{app()->getLocale()}}/user/projects/{{$project->id}}">
                                <h6 class="card-title">{{$project->title}}</h6>
                            </a>
                        </div>
                        @if($project->request_to_delivered && $project->status_id ==2 )
                            <button wire:click="acceptDelivery({{$project->id}})" class="btn btn-danger mb-2">
                                المواقفة علي استلام المشروع
                                <i class="fas fa-briefcase"></i>
                            </button>
                        @endif
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
                            <span class="hide more">{{$project->description_ar}}</span>
                        </p>

                        <button class="btn extra-purple mb-2" onclick="readMore(this)">
                            اقرا المزيد
                        </button>

                        <a href="/{{app()->getLocale()}}/user/projects/{{$project->id}}"
                           style="text-decoration: none" class="btn extra-green more mb-2">
                            تصفح المشروع
                        </a>
                        <br>
                        @if($project->status_id == 0 || $project->status_id == 1)
                            <a href="/{{app()->getLocale()}}/user/edit-project/{{$project->id}}"
                               style="cursor: pointer" class="far fa-edit btn btn-info">

                            </a>
                        @endif

                        <i class="fas fa-trash btn btn-danger" wire:click="deleteProject({{$project->id}})"></i>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($showPopup)
        <div class="popup">
            <div class="popup-content text-right">
                <p>هل انت متاكك من حذف مشروعك</p>
                <button type="submit" class="btn btn-danger" wire:click="confirmDelete">تاكيد الحذف</button>
                <button type="button" class="btn btn-secondary" wire:click="deleteProject">الغاء</button>
            </div>
        </div>
    @endif
</div>

<style>
    .popup {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        width: 40%;
        overflow: auto;
    }
</style>
