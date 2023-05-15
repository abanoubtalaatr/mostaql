<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--table-->
    <div class="border-div">

        <div class="b-btm flex-div-2">
            <h4>{{$page_title}}</h4>
            <a style='text-align:center' href='{{route('admin.new_ads')}}'
               class="button btn-red big">@lang('site.create_new')</a>
        </div>
        <div class="table-page-wrap">


            @if(count($records))
                <table class="table-page table">
                    <thead>
                    <tr>
                        <th>@lang('messages.Ad_Title')</th>
                        <th>@lang('messages.start_at')</th>
                        <th>@lang('messages.end_at')</th>
                        {{-- <th>@lang('messages.description')</th> --}}

                        <th>@lang('site.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{$record->title}}</td>
                            <td>{{\Carbon\Carbon::parse($record->start_at)->format('Y-m-d')}}</td>
                            <td>{{\Carbon\Carbon::parse($record->end_at)->format('Y-m-d')}}</td>
                            <td>
                                <div class="actions">

{{--                                    <a href="{{route('admin.ads.delete',$record)}}" class='no-btn'><i--}}
{{--                                            class="far fa-user green"></i></a>--}}


                                    <a href="{{route('admin.ads.edit',$record)}}" class='no-btn'><i
                                            class="far fa-edit red"></i></a>

                                </div>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                {{$records->links()}}
            @else
                <div class="row" style='margin-top:10px'>
                    <div class="alert alert-warning">@lang('messages.no_ads')</div>
                </div>
            @endif
        </div>
    </div>
</main>
