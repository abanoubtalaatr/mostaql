
{{--@extends('layouts.front')--}}
{{--@section('content')--}}
{{--    @livewire('user.project.index')--}}
{{--@endsection--}}
    <!DOCTYPE html>
<html lang="ar">
<head>
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>@lang('site.site_title') @isset($page_title) {{$page_title}} @endisset</title>
        <!-- bootstrap included -->
        <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/bootstrap.min.css"/>
        <!-- font Awesome  library-->
        <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/all.min.css"/>
        <!-- slick slider -->
    {{--    <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/slick-theme.css"/>--}}
    {{--    <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/slick.css"/>--}}

    <!-- start css file -->
        <link rel="stylesheet" href="{{asset('assets_ar')}}/css/style.css"/>

        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <!-- start responsive -->
        {{--        <link rel="stylesheet" href="{{asset('assets_'.app()->getLocale())}}/css/responsive.css"/>--}}
        @livewireStyles()
    </head>
    <title>ابقوا متابعين</title>
</head>
<body style="background-color: #47325b">
<div class="stay-tuned">
    <h1>
        <i class="far fa-heart"></i>
        نحن في خدمتكم
    </h1>
    <p>في موقع ما هناك أشياء لا تصدق، في الانتظار يمكنك أن تعرفها.</p>
</div>

<p class="card-text text-center footer-stay-tuned">
    Developed by <span>IconicServ</span> ©2023
</p>

<script src="bootstrap-4.6.1-dist/js/jquery-3.6.0.min.js"></script>
<script src="bootstrap-4.6.1-dist/js/popper.min.js"></script>
<script src="bootstrap-4.6.1-dist/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
