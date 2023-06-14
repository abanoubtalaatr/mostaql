<div class="container mt-5 projects-card" style="direction: rtl">
    <div class="text-right">
        <h4 class="card-title"> تعديل العروض</h4>
    </div>
    <div class="row row-cols-1 row-cols-md-2 text-right">
        @foreach($requests as $request)
            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <a class="d-block"
                           href="/{{app()->getLocale()}}/user/projects/{{$request->project->id}}">{{$request->project->title}} </a>
                        <hr>
                        <div>
                            <span>البيانات السابقة</span>
                            <button class="mb-2 btn small-btn-border d-block">
                                {{$request->proposal->description}}
                            </button>
                            <button class="mb-2 btn small-btn-border">
                                {{$request->proposal->price}}
                                السعر
                                <i class="fas fa-money-check-alt"></i>
                            </button>
                            <button class="mb-2 btn small-btn-border">
                                {{$request->proposal->number_of_days}}
                                عدد الايام
                                <i class="fas fa-clock"></i>
                            </button>

                        </div>
                        <hr>
                        <span>البيانات الجديدة</span>

                        <div>
                            <button class="mb-2 btn small-btn-border d-block">
                                {{$request->description}}
                            </button>
                            <button class="mb-2 btn small-btn-border">
                                {{$request->price}}
                                السعر
                                <i class="fas fa-money-check-alt"></i>
                            </button>
                            <button class="mb-2 btn small-btn-border">
                                {{$request->number_of_days}}
                                عدد الايام
                                <i class="fas fa-clock"></i>
                            </button>
                        </div>

                        <hr>
                        <div>
                            @if($request->status =='pending')
                                <button class="mb-2 btn btn-primary">
                                    الموافقة
                                </button>
                                <button class="mb-2 btn btn-danger" wire:click="rejectRequest({{$request->id}})">
                                    رفض
                                </button>
                            @else
                                <p>حاله الطلب : {{trans('site.'. $request->status)}}</p>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
