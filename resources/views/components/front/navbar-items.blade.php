<nav class="navbar navbar-expand-lg py-5 navbar-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav my-2 my-lg-0 on-responsive">
            @if(auth()->user())
                <li class="nav-item dropdown">
                    <ul class="on-responsive-circle-img">
                        <a
                            class="nav-link dropdown-toggle"
                            data-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <img width="40" height="40" class="rounded-circle" src="{{auth()->user()->avatar}}" alt="">
                        </a>
                        <li class="nav-item dropdown">
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                   href="/{{app()->getLocale()}}/user/profile/{{auth()->id()}}">حسابي</a>
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/user/my-favourite">مفضلتي</a>
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/user/wallet">الرصيد</a>
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/user/edit-profile"
                                >تعديل الحساب</a
                                >
                                <a class="dropdown-item" href="/{{app()->getLocale()}}/support">الدعم الفني</a>
                                @if(auth()->check())
                                    <div class="dropdown-divider"></div>

                                    <form action="{{route('user.logout')}}" method="get">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-white"> تسجيل خروج</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="nav-item mx-4 mt-1">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/notifications">
                        <i class="fas fa-bell"></i>
                        <span
                            class="text-white"
                            style="Font-weight : bold;">{{auth()->user()->notifications()->whereNull('when_read')->count()}}</span>
                    </a>
                </li>
                <li class="nav-item mx-4 mt-1">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/chats">
                        <i class="fas fa-envelope"></i>
                        <span>{{\App\Models\Chat::unReadByConversation()}}</span>
                    </a>
                </li>
                <li class="nav-item mx-4 mt-1">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/all-users">
                        <i class="fas fa-search"></i>
                    </a>
                </li>
            @endif

            @if(!auth()->user()) {
            <li class="nav-item mx-4 mt-1">
                <a class="nav-link" href="/{{app()->getLocale()}}/user/register">
                    أنشاء حساب
                </a>
            </li>
            <li class="nav-item mx-4 mt-1">
                <a class="nav-link" href="/{{app()->getLocale()}}/user/login">
                    تسجيل دخول
                </a>
            </li>

            @endif
        </ul>
        <ul class="navbar-nav ml-auto text-right">
            <li class="nav-item mx-4">
                <a class="nav-link" href="/{{app()->getLocale()}}/terms"> حقوقك</a>
            </li>
            <div class="data-usr-aftr-access-hole">

                <li class="nav-item mx-4">
                    <a class="nav-link" href="/{{app()->getLocale()}}/terms"> ضمان الحقوق</a>
                </li>
                @if(auth()->check())
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/{{app()->getLocale()}}/user/profile/{{auth()->id()}}"> حسابي</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/{{app()->getLocale()}}/user/my-favourite"> مفضلتي</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/{{app()->getLocale()}}/user/wallet"> الرصيد</a>
                    </li>

                    <li class="nav-item mx-4">
                        <a class="nav-link" href="/{{app()->getLocale()}}/user/edit-profile"> تعديل الحساب </a>
                    </li>
                @endif
                <li class="nav-item mx-4">
                    <a class="nav-link" href="/{{app()->getLocale()}}/support"> الدعم الفني </a>
                </li>
            </div>
            <li class="nav-item mx-4">
                <a class="nav-link" href="/{{app()->getLocale()}}/user/packages">الباقات</a>
            </li>
            @if(isset(auth()->user()->user_type) &&  auth()->user()->user_type !='owner')
                <li class="nav-item mx-4">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/my-proposals">عروضي</a>
                </li>
            @endif
            @if(isset(auth()->user()->user_type) && auth()->user()->user_type !='freelancer')
                <li class="nav-item mx-4">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/my-projects">مشاريعي</a>
                </li>

            @endif

            <li class="nav-item mx-4">
                <a class="nav-link" href="/{{app()->getLocale()}}/user/projects">تصفح المشاريع</a>
            </li>

            @if(!auth()->user() || auth()->user()->user_type !='freelancer' )
                <li class="nav-item mx-4">
                    <a class="nav-link" href="/{{app()->getLocale()}}/user/create-project">اضف مشروع</a>
                </li>
            @endif

            @if(auth()->user())
                <div class="dropdown-divider"></div>
                <li class="nav-item mx-4 logout">
                    <form action="{{route('user.logout')}}" method="get">
                        @csrf
                        <button type="submit" class="dropdown-item text-white"> تسجيل خروج</button>
                    </form>
                </li>
            @endif

        </ul>
    </div>
    <a class="navbar-brand mb-3 mt-3" href="#">Logo</a>
</nav>
