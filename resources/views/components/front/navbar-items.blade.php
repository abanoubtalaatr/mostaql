<nav class="navbar navbar-expand-lg py-5 navbar-dark" dir="ltr" xmlns="http://www.w3.org/1999/html">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if(auth()->user())
            <ul class="navbar-nav my-2 my-lg-0 on-responsive">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                       aria-expanded="false">
                        <img width="40" height="40" class="rounded-circle" src="{{auth()->user()->avatar}}" alt="">
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/{{app()->getLocale()}}/user/profile/{{auth()->id()}}"> حسابي </a>
                        <a class="dropdown-item" href="/{{app()->getLocale()}}/user/my-favourite"> مفضلتي </a>
                        <a class="dropdown-item" href="/{{app()->getLocale()}}/terms"> ضمان الحقوق </a>
                        <a class="dropdown-item" href="payments.html"> الرصيد </a>
                        <a class="dropdown-item" href="/{{app()->getLocale()}}/user/edit-profile">
                            تعديل الحساب
                        </a>
                        <a class="dropdown-item" href="/{{app()->getLocale()}}/support"> الدعم الفني </a>
                        <div class="dropdown-divider"></div>
                        <form action="{{route('user.logout')}}" method="get">
                            @csrf
                            <button type="submit" class="dropdown-item text-white"> تسجيل خروج</button>
                        </form>

                    </div>
                </li>
                <li class="nav-item mx-2 mt-1">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/notifications">
                        <i class="fas fa-bell"></i><span class="text-danger" > {{auth()->user()->notifications->count()}}</span>
                    </a>
                </li>
                <li class="nav-item mx-2 mt-1">
                    <a class="nav-link" href="">
                        <i class="fas fa-envelope"></i>
                    </a>
                </li>
                <li class="nav-item mx-2 mt-1">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/all-users">
                        <i class="fas fa-search"></i>
                    </a>
                </li>
            </ul>
        @endif
        @if(!auth()->user())
            <ul class="navbar-nav my-2 my-lg-0 text-right">
                <li class="nav-item mx-4">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/register">انشاء حساب</a>
                </li>
                <li class="nav-item mx-4">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/login">تسجيل دخول</a>
                </li>
            </ul>
        @endif
        <ul class="navbar-nav ml-auto text-right">
            <li class="nav-item mx-4">
                <a class="nav-link" href="/{{app()->getLocale()}}/terms"> حقوقك</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link" href="packedges.html">الباقات</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link" href="/{{app()->getLocale()}}/user/my-proposals">عروضي</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link" href="/{{app()->getLocale()}}/user/projects">تصفح المشاريع</a>
            </li>
            @if(!auth()->user() || auth()->user()->user_type !='freelancer' )
                <li class="nav-item mx-4">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/create-project">اضف مشروع</a>
                </li>
            @endif
        </ul>
    </div>
    <a class="navbar-brand" href="#">LOGO</a>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
