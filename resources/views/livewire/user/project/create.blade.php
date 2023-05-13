<div class="container add-project mt-5">
    <div class="box-title text-right">
        <h5 class="card-title">أضف مشروع</h5>
    </div>
    <div class="row row-cols-1 row-cols-md-1">
        <div class="col mb-12">
            <form class="text-right" wire:submit.prevent="store">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-md-12 my-2">
                        <label for="">عنوان المشروع</label>
                        <input wire:model.defer="form.title" type="text" class="form-control text-right">
                        <small>أدرج عنوانا موجزا يصف مشروعك بشكل دقيق.</small>
                        @error('form.title') <span
                            class="error text-danger text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12 my-2">
                        <label for="">وصف المشروع</label>
                        <textarea wire:model.defer="form.description_ar" class="form-control text-right" id=""
                                  rows="3"></textarea>
                        <small>أدخل وصفاً مفصلاً لمشروعك وأرفق أمثلة لما تريد ان
                            أمكن.</small>
                        @error('form.description_ar') <span
                            class="error text-danger text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="col-md-6 my-2">
                        <label for="">المهارات المطلوبة</label>

                        <div class="dropdown bootstrap-select show-tick select form-control text-right">
                            <select wire:model.defer="form.skills" class="select form-control text-right selectpicker"
                                    multiple="" tabindex="-98">
                                <option disabled>اختر مهاراتك</option>

                                @foreach($skills as $skill)
                                    <option value="{{$skill->id}}">{{$skill->name_ar}}</option>
                                @endforeach
                            </select>
                            @error('form.skills') <span
                                class="error text-danger text-danger">{{ $message }}</span> @enderror

                        </div>
                        <small> حدد أهم المهارات المطلوبة لتنفيذ مشروعك. </small>

                    </div>
                    <div class="col-md-6 my-2">
                        <label for="">التصنيف</label>
                        <div class="dropdown bootstrap-select show-tick select form-control text-right">
                            <select wire:model.defer="form.category_id"
                                    class="select form-control text-right selectpicker" tabindex="-98">
                                <option disabled>التصنيف</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title_ar}}</option>
                                @endforeach
                            </select>

                            <div class="dropdown-menu ">
                                <div class="inner show" role="listbox" id="bs-select-2" tabindex="-1"
                                     aria-multiselectable="true">
                                    <ul class="dropdown-menu inner show" role="presentation"></ul>
                                </div>
                            </div>

                        </div>
                        @error('form.category_id') <span
                            class="error text-danger text-danger">{{ $message }}</span> @enderror
                        <small> حدد أهم المهارات المطلوبة لتنفيذ مشروعك. </small>

                    </div>
                    <div class="col-md-6 my-2">
                        <label for="">المدة المتوقعة للتسليم</label>
                        <div class="full-card">
                            <input wire:model.defer="form.number_of_days" type="number" class="form-control text-right">
                            <span class="small-left-card" style="font-size: 14px">ايام</span>
                        </div>
                        @error('form.number_of_days') <span
                            class="error text-danger text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 my-2">
                        <label for="">الميزانية المتوقعة</label>
                        <select id="" class="form-control text-right" wire:model.defer="form.money_id">
                            <option selected="">...اختار</option>
                            @foreach($moneys as $item)
                                <option value="{{$item->id}}">{{$item->name_ar}}</option>
                            @endforeach
                        </select>
                        <small>اختر ميزانية مناسبة لتحصل على عروض جيدة</small>
                        @error('form.money_id') <span
                            class="error text-danger text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12 my-2">
                        <label for="">اضافه ملف</label>
                        <input type="file" class="form-control-file"  wire:model.defer="form.file">
                        @error('form.file') <span
                            class="error text-danger text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <button type="submit" class="btn extra-green my-3">اضف الان</button>
            </form>
        </div>
        <div class="col mb-12 text-right">
            <div class="card bg-transparent border-0">
                <div class="card-body">
                    <h5 class="card-title">ابدأ بإنجاز مشروعك</h5>
                    <p class="card-text">
                        تستطيع إنجاز مشروعك بالشكل الذي تريده من خلال المنصه أدخل تفاصيل
                        المشروع والميزانية والمدة المتوقعة ليتم مراجعته ونشره بعد ذلك
                        سيظهر للمستقلين في صفحة المشاريع ويقدموا عروضهم عليه لتختار
                        العرض الأنسب لك ويبدأ المستقل بتنفيذ المشروع.
                    </p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">موقع ... يضمن حقوقك</h5>
                    <p class="card-text">
                        تقوم المنصه بدور الوسيط بينك وبين المستقل الذي توظفه لتنفيذ
                        مشروعك، فقط بعد انتهاء المستقل من تنفيذ المشروع كاملاً يتم تحويل
                        المبلغ إلى حسابه.
                    </p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">نصائح للحصول على عمل ناجح</h5>
                    <ul class="advise-ul">
                        <li class="my-1">وضح جميع التفاصيل والمهام المطلوب إنجازها</li>
                        <li class="my-1">
                            املأ جميع الحقول ووفّر أمثلة لما تريد تنفيذه
                        </li>
                        <li class="my-1">
                            جزّء المشروع والمهام الكبيرة على عدّة مراحل صغيرة
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
