<div class="container-fluid mycart mt-5">
    <div class="text-right">
        <h4 class="card-title">المشاريع المفضلة</h4>
    </div>
    <div class="row row-cols-1 text-right row-cols-lg-3 row-cols-md-2">
        @foreach($records as $record)
            <div class="col mb-4">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <h6 class="card-title">{{$record->project->category->title_ar}}</h6>
                        <details class="my-3">
                            <summary>وصف المشروع</summary>
                            <p class="card-text mt-3">
                                {{$record->project->description_ar}}
                            </p>
                        </details>
                        <div class="d-flex groub-button justify-content-between">

                            <button type="button" wire:click='destroy({{$record->id}})' class="btn extra-purple">
                                حذف من
                                المفضله
                            </button>


                            <a href="projectID.html" style="text-decoration: none" class="btn extra-green">شاهد
                                التفاصيل</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
