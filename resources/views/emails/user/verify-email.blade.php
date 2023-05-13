
{{--    Please click the button below to verify your email address.--}}

{{--    <a class="btn btn-dark big" href="{{$verificationUrl}}"> اضغط هنا لتكملة تسجيل الدخول</a>--}}
{{--    {{ config('app.name') }}--}}

    @component('mail::message')

        Please click the button below to verify your email address

        @component('mail::button', ['url' => $verificationUrl])
            Click Here
        @endcomponent

        Thanks,<br>
        {{ config('app.name') }}
    @endcomponent
