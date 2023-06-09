<div class="container login mt-5">
    <div class="box-title text-right">
        <h4 class="card-title">تسجيل الدخول إلى حسابك</h4>
    </div>
    <div class="row row-cols-1 row-cols-md-1 mt-4 p-0">
        @if(session()->has('please_check_your_email_we_send_email_verification'))
            <div class="alert alert-danger text-right">
                {{session()->get('please_check_your_email_we_send_email_verification')}}
            </div>

        @endif

        <div class="col mb-4 text-right my-1 px-0">

            <form wire:submit.prevent="login" class="text-right px-3">
                @if($deActiveReason)
                    <div class="row row-cols-1 row-cols-md-2 text-right" style="direction: rtl;">
                        @if(isset($deActiveReason)) <span
                            class="error text-danger"> السبب :{{ $deActiveReason }}</span>  @endif
                    </div>
                @endif
                <div class="row row-cols-1 row-cols-md-2 text-right" style="direction: rtl;">
                    @if(isset($error_message)) <span class="error text-danger">{{ $error_message }}</span>  @endif
                </div>
                <div class=" row row-cols-1 row-cols-md-2 text-right">
                    <div class="col-md-12 my-2">
                        <label for="">الدولة</label>
                        <select wire:model.defer="country_id" wire:change="getCode" id=""
                                class="form-control text-right">
                            <option selected="">...اختار</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->value}}</option>
                            @endforeach
                        </select>
                        @error('form.country_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-md-12 my-2">
                        <label for="">رقم الجوال</label>
                        <input type="text" wire:model.defer="username" wire:change="changeUsername"
                               class="form-control text-right">
                        <div class="input-group-prepend"

                             style="
 position: absolute;
left: 15px;
top: 35px;
padding:2px "
                        >

                            <span class="input-group-text" id="">{{$code ??'+966'}}</span>

                        </div>
                        @error('username') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12 my-2">
                        <label for="">كلمه المرور</label>
                        <input wire:model.defer="password" type="password" class="form-control text-right">
                        @error('password') <span class="error text-danger">{{ $message }}</span> @enderror

                    </div>
                    <div class="col-md-12 my-2">
                        <label class="form-check-label mr-4" for="">حفظ البيانات
                        </label>
                        <input wire:model.defer="remember_me" class="form-check-input" type="checkbox" value="" id="">
                    </div>

                </div>
                <div class="row row-cols-1 help-me mt-4 row-cols-md-1" style="direction: rtl">
                    <div class="col-md-6 mb-2">
                        <button class="btn extra-green">تسجيل دخول</button>
                    </div>
                    <div class="col-md-6 mb-2 text-right">
                        {{--                        <p class="card-text">ساعدني</p>--}}
                        <a class="nav-link join-us-login" href="/{{app()->getLocale()}}/user/register">
                            ليس لدي حساب بعد
                        </a>
                        <a class="nav-link join-us-login" href="/{{app()->getLocale()}}/user/forgot-password">
                            لقد نسيت كلمة المرور
                        </a>
                        {{--                        <a class="nav-link join-us-login" href="resetpassword.html">--}}
                        {{--                            الرجاء إعادة إرسال الرمز--}}
                        {{--                        </a>--}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
