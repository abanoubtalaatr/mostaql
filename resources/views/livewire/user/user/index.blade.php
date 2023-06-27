<div class="container-fluid mt-5" style="direction: ltr">
    <div class="container">
        <div class="row row-cols-1 text-right row-cols-md-2" style="direction: rtl">
            <div class="col-md-10 mb-1">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <input wire:model="search" type="search" placeholder="ابحث عن طريق الاسم او رقم العضويه"
                               class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-1">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        {{--                        <button wire:model="query" class="btn extra-green py-2 px-5">بحث</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 text-right">
        @foreach($users as $user)
            <div class="col mb-4">
                <div class="card mb-3 purposal border bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="/{{app()->getLocale()}}/user/profile/{{$user->id}}"
                                   style="text-decoration: none"
                                   class="btn extra-green px-2 py-1">عرض</a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mx-2 mt-1 d-flex " style="align-items: center">
                                    @for ($i = 1; $i <= $user->averageRates(); $i++)
                                        <img width="15" height="15" src="{{asset('images/Star 1.png')}}" alt="">
                                    @endfor
                                    <strong class="mx-2">{{$user->first_name.' '. $user->last_name}}.</strong>
                                </div>
                                <div>
                                    <img width="50" height="50" class="rounded-circle" src="{{$user->avatar}}" alt="">
                                </div>
                            </div>

                        </div>
                        <div class="">
                            <ul class="d-flex justify-content-between">
                                <li>
                                    <a href="javascript:void(0)">{{$user->job_title}}</a>
                                    <i class="fas fa-briefcase"></i>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">{{$user->city->name_ar}}</a>
                                    <i class="fas fa-home"></i>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">{{$user->country->value}}</a>
                                    <i class="fas fa-home"></i>
                                </li>

                            </ul>
                        </div>
                        <p class="card-text mt-2 txt-lines">
                            {{$user->description}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        @if ($users->hasMorePages())
            <div class="text-center mt-4">
                <button class="btn extra-purple" wire:click="loadMore">المزيد</button>
            </div>
        @endif
    </div>
</div>
