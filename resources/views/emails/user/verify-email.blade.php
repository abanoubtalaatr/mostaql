
{{--    Please click the button below to verify your email address.--}}

{{--    <a class="btn btn-dark big" href="{{$verificationUrl}}"> اضغط هنا لتكملة تسجيل الدخول</a>--}}
{{--    {{ config('app.name') }}--}}

    @component('mail::message')

        برجاء الضغظ هنا

        @component('mail::button', ['url' => $verificationUrl])
        برجاء الضغظ
        @endcomponent

        شكرا لك
        <br>
        {{ config('app.name') }}
    @endcomponent
