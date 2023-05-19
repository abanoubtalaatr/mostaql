@extends('layouts.front')
@section('content')

    <div class="container-fluid mt-5">
        <div class="box-title text-right">
            <h4 class="card-title">الدعم الفني</h4>
        </div>
        <div class="row row-cols-1 text-right row-cols-md-1">
            <div class="col mb-4">
                <div class="card bg-transparent border-0">
                    <div class="card-body">
                        <p class="">
                            {!! $support->desc_ar !!}
                        </p>
                        <button type="button" class="btn extra-green p-2" data-toggle="modal"
                                data-target="#exampleModal">
                            ارسل رساله عبر البريد
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container support mt-5">
        <div class="row row-cols-2 pt-4 text-center row-cols-lg-4 row-cols-md-4" style="direction: rtl">
            <div class="col mb-4">
                <div class="card bg-transparent border-0">
                    <div class="card-body">
                        <a href="{{$settings->facebook??''}}" target="_blank" class="join-us"><i
                                class="fab fa-facebook-square"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card bg-transparent border-0">
                    <div class="card-body">
                        <a href="{{$settings->instagram??''}}" target="_blank" class="join-us"><i
                                class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card bg-transparent border-0">
                    <div class="card-body">
                        <a href="{{$settings->twitter??''}}" target="_blank" class="join-us"><i
                                class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card bg-transparent border-0">
                    <div class="card-body">
                        <a href="{{$settings->snap_chat??''}}" target="_blank" class="join-us"><i
                                class="fab fa-snapchat-ghost"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="direction: rtl">
                    <form class="text-right text-right" action="{{route('user.contact_us')}}" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group text-right">
                            <label for="exampleInputEmail1">البريد الالكتروني</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">لن نشارك بريدك الإلكتروني مع أي شخص
                                آخر.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">رسالتك</label>
                            <textarea name="message" class="form-control text-right textarea-popup" id="" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn extra-purple">ارسال</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
