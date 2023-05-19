@extends('layouts.front')
@section('content')
    <div class="container-fluid terms mt-5">
        <div class="box-title text-right d-flex justify-content-between mb-2">
            <div class="dropdown">
                <button class="btn extra-green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    التصنيفات
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#2">شروط الاستخدام</a>
                    <a class="dropdown-item" href="#3">حقوقك</a>
                    <a class="dropdown-item" href="#5">اسئله شائعه</a>
                    <a class="dropdown-item" href="#6">ارقام حساب البنوك</a>
                </div>
            </div>

            <h5 class="card-title">كيف يضمن موقع .. حقوقك</h5>
        </div>
        <div class="row row-cols-1 row-cols-md-1 text-right">
            <div class="col mb-4">
                <div class="card mb-3" id="2">
                    <div class="card-body">
                        {!! $conditionUse->desc_ar !!}
                    </div>
                </div>
                <div class="card mb-3" id="3">
                    <div class="card-body">
                        {!! $rights->desc_ar !!}
                    </div>
                </div>
                <div class="card mb-3" id="5">
                    <div class="card-body">
                        {!! $questions->desc_ar !!}
                    </div>
                </div>
                <div class="card mb-3" id="6">
                    <div class="card-body">
                        {!! $banks->desc_ar !!}
                    </div>
                </div>
                <h5>هذه البنود يتم تحديثها بشكل مستمر.</h5>
            </div>
        </div>

    </div>

@endsection
