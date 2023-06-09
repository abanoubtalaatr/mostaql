<div class="container login mt-5">
    <div class="box-title text-right">
        <h4 class="card-title">استعادة كلمة السر</h4>
    </div>
    <div class="row row-cols-1 row-cols-md-1 mt-4">
        <div class="col mb-4 text-right my-1 px-0">
            <form class="text-right px-3"wire:submit.prevent="resetPassword">
                <div class="row row-cols-1 row-cols-md-2">


                    <div class="col-md-12 my-2">
                        <label for="">البريد الالكتروني</label>
                        <input  wire:model.defer="email" type="email" class="form-control text-right">
                        @error('email') <span class="text-danger d-block">{{$message}}</span> @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="">كلمة المرور</label>
                        <input  wire:model.defer="password" type="password" class="form-control text-right">
                        @error('password') <span class="text-danger d-block">{{$message}}</span> @enderror
                    </div>
                    <div class="col-md-12 my-2">
                        <label for="">تأكيد كلمة المرور</label>
                        <input  wire:model.defer="password_confirmation" type="password" class="form-control text-right">
                        @error('password_confirmation') <span class="text-danger d-block">{{$message}}</span> @enderror
                    </div>

                </div>
                @if(isset($message))
                    <div style="direction: rtl" class="row row-cols-1 row-cols-md-2 alert alert-info ml-auto  text-right px-3 text-right w-75">{{$message}}</div>
                @endif


                <button class="btn extra-purple px-5 reset-password my-5">
                    ارسال
                </button>
            </form>
        </div>
    </div>
</div>
