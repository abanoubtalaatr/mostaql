<div class="container-fluid current-msg mt-5" style="direction: ltr">
    <div class="text-right">
        <h4 class="card-title">الرسائل</h4>
    </div>
    <div class="row row-cols-1 row-cols-md-2 text-right">
        <div class="col-md-4 mb-4">
            <div class="card descripe-project-msg my-2">
                @foreach($users as $user)
                    <div class="card-body cursor-pointer" style="cursor: pointer"
                         wire:click="setReceiver({{$user->id}})">
                        <h5 class="card-title d-inline-block">{{$user->first_name . ' ' . $user->last_name}}</h5>
                        <img height="40" width="40" class="rounded-circle border" src="{{$user->avatar}}">
                        <p class="card-text">
                        </p>
                    </div>
                    <hr>
                @endforeach
            </div>

            {{--            <button type="button" class="btn extra-purple" data-toggle="modal" data-target="#exampleModal">--}}
            {{--                تسليم الصفقه--}}
            {{--            </button>--}}
        </div>


        <div class="col-md-8 mb-4">
            @if(count($messages) > 0)
                <div class="card available-msg border my-3" style="direction: rtl">
                    @foreach($messages as $message)
                        @if($message['sender_id'] != auth()->id())
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <img src="{{asset('images/Group 60.png')}}" alt="">
                                        <strong>{{$message['sender']['first_name'].' '. $message['sender']['last_name']}}</strong>
                                    </div>
                                </div>
                                <!-- Customer message -->
                                <p class="card-text mt-2">{{$message['message']}}</p>
                            </div>
                            <hr>
                        @else
                            {{--sender--}}
                            <div class="card-body text-left" style="direction: ltr;">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <img src="{{asset('images/Group 60.png')}}" alt="">
                                        <strong>{{$message['sender']['first_name'] . ' '. $message['sender']['last_name']}}</strong>
                                    </div>
                                </div>
                                <!-- freelancer resbonse -->
                                <p class="card-text mt-2">{{$message['message']}}</p>
                            </div>
                            <hr>
                        @endif

                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="send">
                        <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 row-cols-sm-2"
                             style="direction: rtl">
                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <label for="">رسالتك</label>
                                <textarea wire:model.defer="message" class="form-control text-right" id=""
                                          rows="3"></textarea>
                                @error('message') <span class="error text-danger">{{ $message }}</span> @enderror
                                @error('receiver') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn extra-purple my-3">ارسال الان</button>
                    </form>
                    <ul class="alert-warning p-2 rounded mt-3">
                        <li class="mb-1">
                            حتى تحافظ على حقوقك، لا تتواصل مع أي شخص خارج الموقع
                        </li>
                        <li class="mb-1">
                            طلب التواصل والدفع خارج منصة مستقل يؤدي لحظر حسابك مباشرة
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
