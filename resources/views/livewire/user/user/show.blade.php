<div class="container-fluid mt-5">
    <div class="container">
        <div class="row row-cols-1 text-right row-cols-md-2" style="direction: rtl">
            <div class="col-md-10 mb-1">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <input type="search" placeholder="ابحث عن طريق الاسم او رقم العضويه" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-1">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        <button wire:model="query" class="btn extra-green py-2 px-5">بحث</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 text-right">
        @foreach($users as $user)
            <div class="col mb-4">
                <div class="card mb-3 purposal border bg-transparent">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="user.html" style="text-decoration: none"
                                   class="btn extra-green px-2 py-1">عرض</a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mx-2 mt-1 d-flex">
                                    <div class="mx-1">
                                        <img src="images/Star 1.png" alt="">
                                        <img src="images/Star 1.png" alt="">
                                        <img src="images/Star 1.png" alt="">
                                        <img src="images/Star 1.png" alt="">
                                        <img src="images/Star 1.png" alt="">
                                    </div>
                                    <strong>Mostafa O.</strong>
                                </div>
                                <div>
                                    <img src="images/Group 60.png" alt="">
                                </div>
                            </div>
                        </div>
                        <p class="card-text mt-2 txt-lines">
                            اعمل في مجال تصميم الدعايا و الاعلان من ١٠ سنوات . املك خبرة
                            كافية تماما لتصميم ما تريد اتسم بالسرعة و الدقة . استطيع تنفيذ
                            مشروعك في خلال ٢٤ ساعه . ببساطه ... انا الرجل المناسب لتنفيذ
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="text-center">
        <button class="btn extra-purple">المزيد</button>
    </div>
</div>
