<!DOCTYPE html>
<html class="no-js">

<head>
    <title>@lang('site.site_title') @isset($page_title) {{ ' - '.$page_title}}  @endisset</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="description">
    <meta name="Sard" content="sard">
    <meta name="robots" content="index">
    <link rel="icon" href="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/favicon.png" type="image/x-icon">
    <!--in case of ar only-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
          integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/css/style.css">
    <link rel="stylesheet"
          href="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/css/{{app()->getLocale()}}Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css"
          integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireStyles()
    @stack('styles')

</head>

<body class="home-page" x-data x-on:saved="toastr.success($event.detail.message);">
<div id="wrapper">
    <!--Sidebar-->
    <div id="sidebar-wrapper">
        <div class="sidebar-nav">
            <div class="logo-wrap"><h3 style="text-align: right;padding-right: 29px;color: white;">أخدمني</h3></div>
            @can('Manage dashboard')
                <li>
                    <a href="{{route('admin.dashboard')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/dashboard.svg"
                             alt="">
                        @lang('site.dashboard')
                    </a>
                </li>
            @endcan

            @can('Manage admins')
                <li>
                    <a href="{{route('admin.admins.index')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.admins')
                    </a>
                </li>
            @endcan
            @can('Manage roles')
                <li>
                    <a href="{{route('admin.role')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.roles')
                    </a>
                </li>
            @endcan
            @can('Manage users')
                <li>
                    <a href="{{route('admin.users.index')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.users')
                    </a>
                </li>
            @endcan

            @can('Manage ads')
                <li>
                    <a href="{{route('admin.ads')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.ads')
                    </a>
                </li>
            @endcan

            @can('Manage countries')
                <li>
                    <a href="{{route('admin.countries')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.countries')
                    </a>
                </li>
            @endcan

            @can('Manage cities')
                <li>
                    <a href="{{route('admin.cities')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.cities')
                    </a>
                </li>
            @endcan


            @can('Manage skills')
                <li>
                    <a href="{{route('admin.skills')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.skills')
                    </a>
                </li>
            @endcan

            @can('Manage money')
                <li>
                    <a href="{{route('admin.money')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.money')
                    </a>
                </li>
            @endcan

            @can('Manage medals')
                <li>
                    <a href="{{route('admin.medals')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.medals')
                    </a>
                </li>
            @endcan

            {{--            @can('Manage tasks')--}}
            {{--                <li>--}}
            {{--                    <a href="{{route('admin.task.index')}}">--}}
            {{--                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">--}}
            {{--                        @lang('site.tasks')--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('Manage libraries')--}}
            {{--                <li>--}}
            {{--                    <a href="{{route('admin.library')}}">--}}
            {{--                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/library.svg" alt="">--}}
            {{--                        @lang('site.library')--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('Manage payback_requests')--}}
            {{--                <li>--}}
            {{--                    <a href="{{route('admin.payback_requests')}}">--}}
            {{--                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/library.svg" alt="">--}}
            {{--                        @lang('site.payback_requests')--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('Manage ads')--}}
            {{--                <li>--}}
            {{--                    <a href="{{route('admin.ads')}}">--}}
            {{--                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/ads.svg" alt="">--}}
            {{--                        @lang('site.ads')--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            @can('Manage categories')
                <li>
                    <a href="{{route('admin.category')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.categories')
                    </a>
                </li>
            @endcan

            @can('Manage features')
                <li>
                    <a href="{{route('admin.features')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.package_features')
                    </a>
                </li>
            @endcan

            @can('Manage packages')
                <li>
                    <a href="{{route('admin.packages')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('site.packages')
                    </a>
                </li>
            @endcan


            @can('Manage contact_us')
                <li>
                    <a href="{{route('admin.contact_us')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/contact.svg" alt="">
                        @lang('site.contact_us')
                    </a>
                </li>
            @endcan

            @can('Manage pages')
                <li>
                    <a href="{{route('admin.pages.index')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('messages.pages')
                    </a>
                </li>
            @endcan

            {{--            @can('Manage sliders')--}}
            {{--                <li>--}}
            {{--                    <a href="{{route('admin.slider')}}">--}}
            {{--                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">--}}
            {{--                        @lang('general.slider')--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('Manage discounts')--}}
            {{--                <li>--}}
            {{--                    <a href="{{route('admin.discount')}}">--}}
            {{--                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">--}}
            {{--                        @lang('general.discounts')--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}

            {{--            @can('Manage partners')--}}
            {{--                <li>--}}
            {{--                    <a href="{{route('admin.partner')}}">--}}
            {{--                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">--}}
            {{--                        @lang('site.partners')--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endcan--}}


            @can('Manage settings')
                <li>
                    <a href="{{route('admin.settings')}}">
                        <img src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/tasks.svg" alt="">
                        @lang('messages.settings')
                    </a>
                </li>
            @endcan
            <li><a href="{{route('admin.logout')}}"><img
                        src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/imgs/home/logout.svg"
                        alt="">@lang('messages.logout')</a></li>
        </div>
    </div>
    <div id="page-content-wrapper">
        <!-- Main Content-->
    {{ isset($slot)? $slot : ''}}
    @yield('content')
    <!-- End Main Content-->
        <!-- Main footer-->
        <footer class="main-footer">
            <p>All rights reserved {{date('Y')}} </p>
        </footer>
        <!-- End Main footer-->
    </div>
</div>
<!-- End Main Content-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBr8fHyX4CFO0PMq4dxJlhPH8RrjXfyN8&amp;callback=initMap"></script>
<script src="{{asset('frontAssets')}}/assets_{{app()->getLocale()}}/js/functions.js"></script>
<script src="{{asset('frontAssets/plugins/toastr/toastr.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"
        integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .slick-list {
        height: 100% !important;
    }

    .slick-slide img {
        position: absolute;
        top: -20%;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        max-height: 80%;
        max-width: 100%;
        object-fit: contain;
    }

    .slick-slide {
        height: 230px;
        position: relative;
        text-align: center;
    }

    .select2-container--default {
        width: 100% !important;
    }
</style>
@if(session('success_message'))
    <script>
        toastr.success('{{session('success_message')}}');


    </script>
@endif

@livewireScripts()
@stack('scripts')
</body>

</html>
