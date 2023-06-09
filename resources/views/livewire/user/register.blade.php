<div class="container-fluid signup mt-5" style="direction: ltr">
    <div class="box-title text-right">
        <h4 class="card-title">انشاء حساب جديد</h4>
    </div>
    <div class="row row-cols-1 p-2 row-cols-md-2 mt-4">
        <div class="col mb-4 text-right my-1 px-0">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h4 class="card-title">معلومات عنا</h4>
                    <p class="card-text">
                        موقع .. هو أكبر منصة للعمل الحر في المملكه العربيه السعوديه يعمل
                        موقع ..على وصل الشركات وأصحاب المشاريع بأفضل المنفذين المحترفين
                        لمساعدتهم على تنفيذ أفكارهم ومشاريعهم او توظيفهم بشكل دائم ، وفي
                        الوقت نفسه يتيح للمنفذين مكانا لإيجاد مشاريع يعملون عليها
                        وزيادة مصادر دخلهم.
                    </p>
                    <p class="card-text">
                        تستطيع من خلال موقع .. إضافة مشروعك الذي ترغب بتنفيذه بالاشتراك
                        في باقه من ضمن الباقات المتاحه لتحصل على عشرات العروض من أفضل
                        المنفذين بداخل المملكه

                        <br>
                        <br>
                        ، وتتمكن ايضا من الاشتراك في باقه للاعلان عن خدمتك داخل الموقع
                        يمكنك ايضا اختيار العرض المناسب لمشروعك ليبدأ المنفذ العمل على
                        تنفيذه. تضمن لك منصة .. حقوقك كصاحب مشروع أو منفذ، حيث يعمل
                        منفذ كوسيط بين الطرفين إلى أن يتم تسليم العمل كاملاً
                    </p>
                    <a href="/{{app()->getLocale()}}/user/login" class="btn extra-green" style="text-decoration: none">هل
                        لديك حساب ؟</a>
                </div>
            </div>
        </div>
        <div class="col mb-4">
            <form wire:submit.prevent="store" class="text-right">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-md-6 my-2">
                        <label for="">الاسم الاول</label>
                        <input wire:model.defer="form.first_name" type="text" class="form-control text-right"
                               id="first_name" name="first_name">
                        @error('form.first_name') <span
                            class="error text-danger text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for=""> الاسم الاخير</label>
                        <input wire:model.defer="form.last_name" type="text" class="form-control text-right">
                        @error('form.last_name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="">الجنسيه</label>
                        <select wire:model.defer="form.country_id" wire:change="getCities" id=""
                                class="form-control text-right">
                            <option selected="">...اختار</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->value}}</option>
                            @endforeach
                        </select>
                        @error('form.country_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6 my-2">
                        <label for="">المدينه</label>
                        <select wire:model.defer="form.city_id" id="" class="form-control text-right">
                            <option selected="">...اختار</option>
                            @forelse($cities as $city)
                                <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                @endforeach
                        </select>
                        @error('form.city_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6 my-2">
                        <label for="">رقم الجوال</label>
                        <div class="input-group mb-3">
                            <input wire:model.defer="form.mobile" class="form-control"
                                   placeholder="ادخل الرقم الخاص بك فقط" aria-describedby="" type="tel">
                            <div class="input-group-prepend">

                                <span class="input-group-text" id="">{{$countryCode ??'+966'}}</span>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="">البريد الالكتروني</label>
                        <input wire:model.defer="form.email" type="email" class="form-control text-right"
                               placeholder="ادخل بريدك الالكتروني صحيح لتتمكن من استعادة كلمة المرور مستقبلا">
                        @error('form.email') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="">انشاء كلمه مرور </label>
                        <div class="showBtn-password">
                            <input wire:model.defer="form.password" type="password" class="form-control text-right"
                                   id="passwordStrength">
                            <button id="showBtn-p" class="btn">show</button>
                        </div>
                        <p id="messageStrength">
                            كلمه مرور <span id="spanStrength"></span>
                        </p>
                        @error('form.password') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="">اعاده كلمه المرور</label>
                        <div class="showBtn-password">
                            <input wire:model.defer="form.password_confirmation" type="password"
                                   class="form-control text-right" id="repassStrength">
                            <button id="showBtn-Re-p" class="btn">show</button>
                        </div>
                        <p id="messageStrength">
                            كلمه مرور <span id="spanStrength"></span>
                        </p>
                        @error('form.password_confirmation') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="">البطاقه الشخصيه ( اختياري )</label>
                        <input wire:model.defer="form.id_image" type="file" class="form-control-file">
                        <small id="emailHelp" class="form-text text-muted">يجب عليك التقاط صوره لشخصك مع بطاقتك الشخصيه
                            لإثبات هويتك
                            وللوثوق بك من خلال اصحاب المشاريع
                        </small>
                        @error('form.id_image') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 ml-1 my-3">
                        <input class="form-check-input" type="checkbox" wire:model.defer="form.terms_accepted" value="1"
                               id="">
                        <label class="form-check-label mr-4 d-block" for="">
                            <a href="/{{app()->getLocale()}}/terms" class="user-conditions">
                                لقد قرأت ووافقت على شروط الاستخدام وبيان الخصوصية
                            </a>
                        </label>
                        @error('form.terms_accepted') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12 ml-1 my-3">
                        @if(session()->has('check_your_email'))
                            <div class="text-right alert alert-info">{{session()->get('check_your_email')}}</div>
                        @endif
                    </div>


                </div>
                <button class="btn extra-purple my-2">انشاء الحساب</button>
            </form>

        </div>

    </div>
</div>
