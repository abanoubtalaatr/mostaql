<!DOCTYPE html>
<html lang="ar">
<!-- Start head -->
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
  <style>
      .online-point {
          display: inline-block;

          width: 20px;
          height: 20px;
          background-color: green;
          border-radius: 50%;
          margin-right: 5px;
      }
  </style>
    @livewireStyles()
</head>
<!-- start body -->
<body dir="ltr">
<!-- start navbar -->

<x-front.navbar-items/>

<!-- side menu -->
<a class="suppport" title="الدعم الفني" href="/{{app()->getLocale()}}/support">
    <i class="fas fa-info-circle"></i>
</a>


@yield('content')

{{--<livewire:chat-component :receiver="99"/>--}}


<footer class="p-4 mt-5">
    <p class="card-text text-center">
        © 2023 منصه اخدمني. جميع الحقوق محفوظة
    </p>
</footer>
<div class="container-mobile">
    <ul class="nav-mobile">
        <li>
            <a href="/{{app()->getLocale()}}/user/projects"><i class="fas fa-home"></i> </a>
            <br/>
            <span>الرئيسيه</span>
        </li>
        @if(!auth()->user() || auth()->user()->user_type !='freelancer' )
            <li>
                <a href="/{{app()->getLocale()}}/user/create-project"><i class="fas fa-plus"></i></a>
                <br/>
                <span> اضف</span>
            </li>
        @endif
        <li>
            <a href="/{{app()->getLocale()}}/user/all-users"><i class="fas fa-search"></i></a>
            <br/>
            <span>البحث</span>
        </li>
        <li
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <a href="javascript:void(0)"><i class="fas fa-list"></i></a>
            <br/>
            <span>قائمتي</span>
        </li>
    </ul>
</div>
<!-- start scripts included -->
<!-- bootstrap included -->
<script src="{{asset('bootstrap-4.6.1-dist/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('bootstrap-4.6.1-dist/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap-4.6.1-dist/js/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="{{asset('js/main.js')}}"></script>

<script>
    let noOfCharac = 250;
    let contents = document.querySelectorAll(".content");

    contents.forEach((content) => {
        if (content.textContent.length < noOfCharac) {
            content.nextElementSibling.style.display = "none";
        } else {
            let displayText = content.textContent.slice(0, noOfCharac);
            let moreText = content.textContent.slice(noOfCharac);
            content.innerHTML = `${displayText}<span class="dots">...</span>
          <span class="hide more">${moreText}</span>`;
        }
    });
    function readMore(btn) {
        let post = btn.parentElement;
        post.querySelector(".dots").classList.toggle("hide");
        post.querySelector(".more").classList.toggle("hide");
        btn.textContent == "اقرا اقل"
            ? (btn.textContent = "اقرا المزيد")
            : (btn.textContent = "اقرا اقل");
    }
</script>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = false;

    var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        forceTLS: true,
        pusherOptions: {
            authTimeout: 10000 // Set the authorization timeout to 10 seconds.
        }
    });

    var channel = pusher.subscribe('chat');
    channel.bind('message{{auth()->id()}}', function (data) {
        Livewire.emit('messageReceived', data.message);
    });
</script>
@livewireScripts()
</body>

<!-- end of body -->
</html>
<!-- end of code -->
