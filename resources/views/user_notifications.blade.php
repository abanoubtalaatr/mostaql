@extends('layouts.front')
@section('content')
     <main class="main-content" style="direction: rtl">
          <!--head-->
{{--          <x-user.head/>--}}
          <!--dashboard-->
          <section class="dashboard p-3">
              <div class="row">
                <div class="col-md-12">
                  <div class="border bg-white rounded p-lg-5 p-3 mb-3">
                    <h2 class="head-term text-right">{{$page_title}}</h2>
                    @if(count($records))
                        @foreach($records as $record)

                            <div class="notif  bg-white p-3 d-flex">
                                <img width="30" height="30" src="{{$record->image_url}}" alt="">
                                <div class="notif-info text-right">
                                    <h4>@lang('site.'.$record->type) <span class="float-start notif-time">{{$record->created_at->diffForHumans()}}</span></h4>
                                    <p>{{$record->{"content_".app()->getLocale()} }}</p>
                                </div>
                            </div>

                        @endforeach
                        {{$records->links()}}
                    @else
                        <div class="alert alert-warning text-right">
                            @lang('site.no_data_to_display')
                        </div>
                    @endif

                  </div>
                </div>

              </div>

          </section>

        </main>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/notifications.css')}}">
@endpush
