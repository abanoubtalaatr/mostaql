@extends('layouts.front')
@section('content')
    <section class="page_404">
        <div class="container mt-1">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-12 col-sm-offset-1 bg-transparent text-center">
                        <div class="four-zero-four-bg">
                            <h1 class="text-center">
                                @if(isset($message))
                                    403
                                @else
                                    404
                                @endif
                            </h1>
                        </div>
                        <div class="contant-box-404 my-3">
                            <h5 class="card-title">
                                @if(isset($message))
                                    {{$message}}
                                @else
                                    عذرا هذه الصفحة غير موجوده
                                @endif
                            </h5>
                            @if(isset($message))
                                <a href="/{{app()->getLocale()}}/user/packages" class="btn extra-purple">
                                    للاشتراك الان</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
