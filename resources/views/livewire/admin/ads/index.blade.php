 <main class="main-content">
          <!--head-->
          <x-admin.head/>
          <!--table-->
          <div class="border-div">

              <div class="b-btm flex-div-2">
                  <h4>{{$page_title}}</h4>
                  <a style='text-align:center' href='{{route('admin.new_ads')}}' class="button btn-red big">@lang('site.create_new')</a>
              </div>
            <div class="table-page-wrap">


                @if(count($records))
                <table class="table-page table">
                    <thead>
                    <tr>
                        <th>@lang('messages.Ad_Title')</th>
                        {{-- <th>@lang('messages.description')</th> --}}
                        <th>@lang('validation.attributes.campagin_id')</th>
                        <th>@lang('site.clicks')</th>
                        <th>@lang('site.budget')</th>
                        <th>@lang('site.remaining_budget')</th>
                        <th>@lang('site.status')</th>
                        <th>@lang('validation.attributes.start_date')</th>
                        <th>@lang('site.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                        <tr>
                            <td><a class="decor" href="{{route('admin.show_ad',$record->id)}}">{{$record->title}}</a></td>
                            {{-- <td>{{$record->short_description}}</td> --}}
                            <td>{{$record->camp->title}}</td>
                            <td>{{$record->clicks_count}}</td>
                            <td>{{$record->budget}}</td>
                            <td>{{$record->remaining_budget}}</td>
                            <td>
                                <div class="status {{$record->status_class}}">
                                    <span>@lang('site.'.$record->status)</span>
                                </div>
                            </td>
                            <td>{{$record->start_date}}</td>
                            <td>
                                <div class="actions">
                                    @if($record->status !='inactive')
                                        <button
                                            wire:click='deactivate({{$record->id}})'
                                            class="no-btn">
                                            <i class="fas @if($record->status=='inactive') fa-lock red @else fa-unlock green @endif"></i>
                                        </button>
                                    @endif


                                    <a href="{{route('admin.ad_stats',$record)}}" class='no-btn'><i class="far fa-chart-bar green"></i></a>
                                    <a href="{{route('admin.ad_soldiers',$record)}}" class='no-btn'><i class="far fa-user green"></i></a>

                                    @if($record->status != 'unpaid')
                                        <a href="{{route('admin.ads.edit',$record)}}" class='no-btn'><i class="far fa-edit red"></i></a>
                                    @endif

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
