<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--table-->
    <div class="border-div">
        <div class="b-btm flex-div-2">
            <h4>{{$page_title}}</h4>
            {{-- <a style='text-align:center' href='{{route('user.create_ad')}}' class="button btn-red big">@lang('site.create_ad')</a> --}}
        </div>
        <div class="table-page-wrap">

            <div class="row">
                <div class="form-group col-3">
                    <label for="status-select">@lang('site.user_mobile')</label>
                    <input wire:model='mobile' type="text" class="form-control contact-input">
                </div>
                <div class="form-group col-3">
                    <label for="status-select">@lang('validation.attributes.username')</label>
                    <input wire:model='first_name' type="text" class="form-control contact-input">
                </div>

                <div class="form-group col-3">
                    <label for="status-select">@lang('validation.attributes.email')</label>
                    <input wire:model='email' type="text" class="form-control contact-input">
                </div>


{{--                <div class="form-group col-2">--}}
{{--                    <label for="status-select">@lang('site.status')</label>--}}
{{--                    <select wire:model='status' id='status-select' class="form-control  contact-input">--}}
{{--                        <option value>@lang('site.status')</option>--}}
{{--                        <option value="active">@lang('site.active')</option>--}}
{{--                        <option value="inactive">@lang('site.inactive')</option>--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="form-group col-2 my-3">
                    <label for="status-select">@lang('general.user_type')</label>
                    <select wire:model='user_type' id='status-select' class="form-control  contact-input">
                        <option value>@lang('general.user_type')</option>
                        <option value="freelancer">@lang('site.freelancer')</option>
                        <option value="owner">@lang('site.owner')</option>
                        <option value="owner_freelancer">@lang('site.owner_freelancer')</option>
                    </select>
                </div>

            </div>

            @if(count($records))
                <table class="table-page table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@lang('validation.attributes.username')</th>
                        <th class="text-center">@lang('validation.attributes.email')</th>
                        <th class="text-center">@lang('validation.attributes.user_type')</th>
                        <td class="text-center">الرصيد المتاح للسحب</td>
                        <th class="text-center">@lang('site.user_mobile')</th>
                        <th class="text-center">@lang('site.status')</th>
                        <th>@lang('site.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class='text-center'>{{$record->first_name . ' ' .$record->last_name}}</td>
                            <td class='text-center'>{{$record->email}}</td>
                            <td class="text-center">@lang('site.'.$record->user_type)</td>
                            <td class="text-center">{{round($record->wallets()->where('can_withdraw', 1)->sum('amount'),2)}}</td>
                            <td class="text-center">{{$record->mobile}}</td>
                            <td class='text-center'>
                                <div class="status {{$record->status_class}}">
                                    <span>@lang('site.'.$record->status)</span>
                                </div>
                            </td>

                            <td>
                                <div class="actions">
                                    @if($record->status =='active')
                                        <button
                                            wire:click='toggleStatus({{$record->id}})'
                                            class="no-btn">
                                            <i class="fas fa-lock red "></i>
                                        </button>
                                    @else
                                        <button
                                            wire:click='activeUser({{$record->id}})'
                                            class="no-btn">
                                            <i class="fas fa-unlock green "></i>
                                        </button>
                                    @endif
                                    {{--                                    <a href='{{route('admin.users.edit',$record->id)}}' class="no-btn"><i class="far fa-edit blue"></i></a>--}}

                                </div>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                {{$records->links()}}
            @else
                <div class="row" style='margin-top:10px'>
                    <div class="alert alert-warning">@lang('site.no_data_to_display')</div>
                </div>
            @endif
        </div>
    </div>
    @if($showPopup)
        <div class="popup">
            <div class="popup-content">
                <form wire:submit.prevent="updateUser">
                    <div class="form-group">
                        <label for="deActiveReason">سبب تعطيل المستخدم</label>
                        <textarea required wire:model.defer="de_active_reason" type="text" class="form-control"
                                  id="deActiveReason"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="deActiveFrom">يعطل من </label>
                        <input required wire:model.defer="de_active_from" type="date" class="form-control"
                               id="deActiveFrom">
                    </div>
                    <div class="form-group mb-3">
                        <label for="deActiveTo">يعطل الي</label>
                        <input required wire:model.defer="de_active_to" type="date" class="form-control"
                               id="deActiveTo">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" wire:click="togglePopup">Cancel</button>
                </form>
            </div>
        </div>
    @endif


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
</main>
