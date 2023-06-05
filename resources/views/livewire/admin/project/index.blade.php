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

            @if(count($records))
                <table class="table-page table">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">@lang('site.user')</th>
                        <th class="text-center">@lang('site.title')</th>
                        <th class="text-center">@lang('site.number_of_days')</th>
                        <th class="text-center">@lang('site.price')</th>
                        <th class="text-center">@lang('site.status')</th>
                        <th>@lang('site.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class='text-center'>{{$record->user->first_name .' '. $record->user->last_name}}</td>
                            <td class='text-center'>{{$record->title}}</td>
                            <td class='text-center'>{{$record->number_of_days}}</td>
                            <td class="text-center">{{$record->price}}</td>
                            <td class="text-center">@lang('site.' . $record->status_from_admin)</td>
                            <td>
                                <div class="actions">

                                    @if($record->status_from_admin =='pending')
                                        <button wire:click='approve({{$record->id}})'
                                                class="no-btn">
                                            <i class="fa fa-check "></i>
                                        </button>

                                        <button
                                            wire:click='disApprove({{$record->id}})'
                                            class="no-btn">
                                            <i class="fa fa-window-close"></i>
                                        </button>
                                    @endif
                                        <a href="/admin/projects/{{$record->id}}"

                                            class="no-btn">
                                            <i class="fa fa-eye"></i>
                                        </a>

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
