<div class="container-fluid project-id mt-5" style="direction: ltr">
    <div class="text-right">
        <h4 class="card-title">ملفي الشخصي</h4>
    </div>
    <form wire:submit.prevent="store" class="text-right">
        <div class="row row-cols-1 row-cols-md-2 text-right">
            <div class="col-md-4 mb-4 mt-5">
                <div class="card descripe-project text-center">
                    <div class="card-body">
                        @if(auth()->user()->avatar)
                            <img width="70" height="70" src="{{asset(auth()->user()->avatar)}}" class="mb-3 rounded-circle" alt="">
                        @else
                            <img src="{{asset('images/Ellipse 5.png')}}" class="mb-3" alt="">
                        @endif
                        <h5 class="card-title">{{auth()->user()->first_name . ' '. auth()->user()->last_name}}</h5>
                    </div>
                </div>
                <div class="card mt-4 px-2 pb-3 mb-4 descripe-project text-right">
                    <div class="text-right mt-4 mb-2">
                        <h5 class="card-title">إضافة عمل سابق</h5>
                    </div>
                    <div class="row row-cols-1 row-cols-lg-2">
                        <div class="col-lg-12 col-md-12 mb-2">
                            <label for="" class="text-white">عنوان العمل</label>
                            <input wire:model.defer="form.address" type="text" class="form-control text-right">
                            @error('form.address') <span class="error text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="col-lg-12 col-md-12 mb-2">
                            <label for="" class="text-white">صورة مصغرة</label>
{{--                           <img width='60' height="60" class="rounded-circle my-2" src="{{asset(auth()->user()->minimized_picture)}}">--}}
                            <input type="file" wire:model.defer="form.minimized_picture"  class="form-control text-right">
                            @error('form.minimized_picture') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">تعديل البيانات</h6>
                        <hr>
                        <div class="form-check">
                            <div class="text-right">نوع الحساب</div>

                            <label class="form-check-label chossen" for="user_type1">
                                صاحب مشاريع (أبحث عن منفذين لتنفيذ مشاريعي)
                            </label>
                            <input wire:model.defer="form.user_type" class="form-check-input" type="radio"
                                   name="user_type" id="user_type1" value="owner">

                        </div>
                        <div class="form-check">
                            <label class="form-check-label chossen" for="user_type2">
                                منفذ (أبحث عن مشاريع لتنفيذها)
                            </label>
                            <input wire:model.defer="form.user_type" class="form-check-input" type="radio"
                                   name="user_type" id="user_type2"
                                   value="freelancer">
                        </div>
                        <div class="form-check">
                            <label class="form-check-label chossen" for="user_type3">
                                صاحب مشاريع و منفذ
                            </label>
                            <input wire:model.defer="form.user_type" class="form-check-input" type="radio"
                                   name="user_type" id="user_type3"
                                   value="owner_freelancer">
                        </div>
                        @error('form.user_type') <span class="error text-danger">{{ $message }}</span> @enderror


                        <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 row-cols-sm-2"
                             style="direction: rtl">
                            <div class="col-lg-6 col-md-12 my-2">
                                <label for=""> الاسم الاول</label>
                                <input wire:model.defer="form.first_name" type="text" class="form-control text-right">
                                @error('form.user_type') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="col-lg-6 col-md-12 my-2">
                                <label for="">الاسم الاخير</label>
                                <input wire:model.defer="form.last_name" type="text" class="form-control text-right">
                                @error('form.last_name') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="col-lg-6 my-2" style="position: relative">
                                <label for="">البريد الالكتروني</label>
                                <input wire:model.defer="form.email" type="text" class="form-control text-right">
                                @error('form.email') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>

                            <div class="col-lg-6 col-sm-12 my-2">
                                <label for="">المسمى الوظيفي</label>
                                <input wire:model.defer="form.job_title" type="text" class="form-control text-right">
                                <small>أدخل مسمى وظيفي واحد لتظهر بنتائج البحث. مثال: مهندس معماري
                                </small>
                                @error('form.job_title') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>

                            <div class="col-lg-6 col-sm-12 my-2">
                                <label for="">الدولة</label>
                                <select wire:model.defer="form.country_id" wire:change="getCities" id=""
                                        class="form-control text-right">
                                    <option selected="">...اختار</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->value}}</option>
                                    @endforeach
                                </select>
                                @error('form.country_id') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                            <div class="col-lg-6 col-sm-12 my-2">
                                <label for="">رقم الجوال</label>
                                <div class="input-group mb-3">
                                    <input wire:model.defer="form.mobile" class="form-control"
                                           placeholder="ادخل الرقم الخاص بك فقط" aria-describedby="" type="tel">
                                    <div class="input-group-prepend">

                                        <span class="input-group-text" id="">{{$countryCode ??'+966'}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 my-2 " wire:ignore>
                                <label for="">المهارات المطلوبة</label>
                                <br>
                                <select id='skills' wire:model='form.skills' multiple
                                        class="@error('form.skills') is-invalid @enderror form-control text-right">
                                    @foreach($skills as $skill)
                                        <option value="{{$skill->id}}">{{$skill->name_ar}}</option>
                                    @endforeach

                                </select>
                                @error('form.skills')<span class="error text-danger text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-lg-6 col-sm-12 my-2">
                                <label for="">المدينه</label>
                                <select wire:model.defer="form.city_id" id="" class="form-control text-right">
                                    <option selected="">...اختار</option>
                                    @forelse($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                        @endforeach
                                </select>
                                @error('form.city_id') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>

                            <div class="col-lg-6 col-sm-12 my-2">
                                <label for="">صورة عرض الملف  ( اختياري ).</label>
                                <input type="file"  wire:model.defer="form.avatar" class="form-control text-right">
                                @error('form.avatar') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <label for="">النبذة التعريفية</label>
                                <textarea wire:model.defer="form.description" class="form-control text-right" id=""
                                          rows="3"></textarea>
                                <small>أضف نبذة مختصرة تعرف عن نفسك وتعليمك وخبراتك ومهاراتك.
                                </small>
                                @error('form.description') <span class="error text-danger">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success text-right" >{{ session('success') }}</div>
                            <script>
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            </script>
                        @endif
                        <button type="button" wire:click="store" class="btn extra-purple my-3">تعديل</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

