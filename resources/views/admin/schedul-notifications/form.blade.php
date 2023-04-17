@php
	$all_selected=0;
	if(session('all_users_selected')){
		$all_selected = 1;
	}
@endphp
<div class="row">
	   <div class="form-group mb-4 col">
        <label for="exampleFormControlInput2">{{trans('messages.ar_title')}}</label>
        {!! Form::text('ar_title', null, ['class' => 'form-control' , 'id'=> 'exampleFormControlInput2', 'placeholder' => trans('messages.ar_title')]) !!}
        @if ($errors->has('ar_title'))
           <span class="help-block">  <strong style="color: red;">{{ $errors->first('ar_title') }}</strong>  </span>
        @endif
    </div>
    <div class="form-group mb-4 col">
        <label for="exampleFormControlInput2">{{trans('messages.en_title')}}</label>
        {!! Form::text('en_title', null, ['class' => 'form-control' , 'id'=> 'exampleFormControlInput2', 'placeholder' => trans('messages.en_title')]) !!}
        @if ($errors->has('en_title'))
           <span class="help-block">  <strong style="color: red;">{{ $errors->first('en_title') }}</strong>  </span>
        @endif
    </div>
</div>

<div class="row">
	   <div class="form-group mb-4 col">
        <label for="exampleFormControlTextarea1"> {{trans('messages.ar_content')}}</label>
        {!! Form::textarea('ar_content',null, ['class' => 'form-control ' ,'id'=>"exampleFormControlTextarea1",'rows'=>"3", 'placeholder' => trans('messages.ar_content')]) !!}
        @if ($errors->has('ar_content'))
            <span class="help-block">  <strong style="color: red;">{{ $errors->first('ar_content') }}</strong>  </span>
        @endif
    </div>

    <div class="form-group mb-4 col">
        <label for="exampleFormControlTextarea1">{{trans('messages.en_content')}} </label>
        {!! Form::textarea('en_content',null, ['class' => 'form-control ' ,'id'=>"exampleFormControlTextarea1",'rows'=>"3", 'placeholder' => trans('messages.en_content')]) !!}
        @if ($errors->has('en_content'))
            <span class="help-block">  <strong style="color: red;">{{ $errors->first('en_content') }}</strong>  </span>
        @endif
    </div>
</div>

	<div class="row">


    <div class="form-group mb-4 col">
        <label for="exampleFormControlInput2"> {{trans('messages.url')}}</label>
        {!! Form::text('link', null, ['class' => 'form-control' , 'id'=> 'exampleFormControlInput2', 'placeholder' => trans('messages.url')]) !!}
        @if ($errors->has('link'))
            <span class="help-block">  <strong style="color: red;">{{ $errors->first('link') }}</strong>  </span>
        @endif
    </div>
    <div class="form-group mb-4 col">
        <label for="exampleFormControlInput2">
									@lang('messages.users')
									<span id="select_all_span" class='btn btn-sm btn-primary'>({{$all_selected? __('site.deselect_all') : __('site.select_all')}} )</span>
								</label>

								<p id="all_users_selected" style="@if(!$all_selected) display:none @endif">
									@lang('site.all_users_selected')
								</p>

								<select
									id='users_select'
									name="users[]"
									multiple data-placeholder="@lang('site.users')"
									style="@if($all_selected) display:none @endif"
									>
									<option value>@lang('site.users')</option>
										@foreach ( App\User::where('is_verified',1)->pluck('id_number','id') as $id=>$name)
											<option value="{{$id}}">{{$name}}</option>
										@endforeach
								</select>

								<input type="hidden" name="all_users" value='{{$all_selected}}'>
        @if ($errors->has('users'))
            <span class="help-block" id='users-error'><strong style="color: red;">{{ $errors->first('users') }}</strong>  </span>
        @endif
    </div>
	</div>
	<div class="row">

    <div class="form-group mb-4 col">
        <label for="exampleFormControlInput2"> {{trans('messages.send_date')}}</label>
        {!! Form::date('send_date',old('send_date'), ['class' => 'form-control flatpickr flatpickr-input active' , 'id'=> 'basicFlatpickr', 'placeholder' => trans('messages.send_date')]) !!}
        @if ($errors->has('send_date'))
            <span class="help-block">  <strong style="color: red;">{{ $errors->first('send_date') }}</strong></span>
        @else
            @if ($errors->has('full_date_time'))
                <span class="help-block">  <strong style="color: red;">{{ $errors->first('full_date_time') }}</strong></span>
            @endif
        @endif
    </div>
    <div class="form-group mb-4 col">
        <label for="exampleFormControlInput2"> {{trans('messages.send_time')}}</label>
        {!! Form::time('send_time',null, ['class' => 'form-control flatpickr flatpickr-input active' , 'id'=> 'timeFlatpickr', 'placeholder' => trans('messages.send_time')]) !!}
        @if ($errors->has('send_time'))
            <span class="help-block">  <strong style="color: red;">{{ $errors->first('send_time') }}</strong></span>
        @else
            @if ($errors->has('full_date_time'))
                <span class="help-block">  <strong style="color: red;">{{ $errors->first('full_date_time') }}</strong></span>
            @endif
        @endif
    </div>
</div>
        <div class="text-right">
            <button class="btn btn-primary mt-3" type="submit"> {{ trans('messages.save') }}</button>
        </div>

						<style>
							.selectMultiple {
									position: relative;
									@if($all_selected) display:none @endif
							}
							.selectMultiple select {
									display: none;
							}
							.selectMultiple > div {
									position: relative;
									z-index: 2;
									padding: 8px 12px 2px 12px;
									background: #fff;
									font-size: 14px;
									min-height: 44px;
									border: 2px solid #eff0f1;
									border-radius: 4px;
							}

							.selectMultiple > div .arrow {
								@php
									if(app()->getLocale()=='ar'){
										echo 'left:15px;';
									}else{
										echo 'right:15px;';
									}
								@endphp


									top: 0;
									bottom: 0;
									cursor: pointer;
									width: 28px;
									position: absolute;
							}
							.selectMultiple > div .arrow:before,
							.selectMultiple > div .arrow:after {
									content: "";
									position: absolute;
									display: block;
									width: 2px;
									height: 8px;
									border-bottom: 8px solid #99a3ba;
									top: 43%;
									-webkit-transition: all 0.3s ease;
									transition: all 0.3s ease;
							}
							.selectMultiple > div .arrow:before {
									right: 12px;
									-webkit-transform: rotate(-130deg);
									transform: rotate(-130deg);
							}
							.selectMultiple > div .arrow:after {
									left: 9px;
									-webkit-transform: rotate(130deg);
									transform: rotate(130deg);
							}
							.selectMultiple > div span {
								width:100%;
								height: 100%;
									color: #99a3ba;
									display: block;
									position: absolute;
									@php
										if(app()->getLocale()=='ar'){
											echo 'right: 12px;';
										}else{
											echo 'left: 12px;';
										}
									@endphp

									cursor: pointer;
									top: 8px;
									line-height: 28px;
									-webkit-transition: all 0.3s ease;
									transition: all 0.3s ease;
							}
							.selectMultiple > div span.hide {
									opacity: 0;
									visibility: visible;
									-webkit-transform: translate(-4px, 0);
									transform: translate(-4px, 0);
							}
							.selectMultiple > div a {
									position: relative;
									padding: 0 24px 6px 8px;
									line-height: 28px;
									color: #1e2330;
									display: inline-block;
									vertical-align: top;
									margin: 0 6px 0 0;
							}
							.selectMultiple > div a em {
									font-style: normal;
									display: block;
									white-space: nowrap;
							}
							.selectMultiple > div a:before {
									content: "";
									left: 0;
									top: 0;
									bottom: 6px;
									width: 100%;
									position: absolute;
									display: block;
									background: rgba(228, 236, 250, 0.7);
									z-index: -1;
									border-radius: 4px;
							}
							.selectMultiple > div a i {
									cursor: pointer;
									position: absolute;
									top: 0;
									right: 0;
									width: 24px;
									height: 28px;
									display: block;
							}
							.selectMultiple > div a i:before,
							.selectMultiple > div a i:after {
									content: "";
									display: block;
									width: 2px;
									height: 10px;
									position: absolute;
									left: 50%;
									top: 50%;
									background: #009a93;
									border-radius: 1px;
							}
							.selectMultiple > div a i:before {
									-webkit-transform: translate(-50%, -50%) rotate(45deg);
									transform: translate(-50%, -50%) rotate(45deg);
							}
							.selectMultiple > div a i:after {
									-webkit-transform: translate(-50%, -50%) rotate(-45deg);
									transform: translate(-50%, -50%) rotate(-45deg);
							}
							.selectMultiple > div a.notShown {
									opacity: 0;
									-webkit-transition: opacity 0.3s ease;
									transition: opacity 0.3s ease;
							}
							.selectMultiple > div a.notShown:before {
									width: 28px;
									-webkit-transition: width 0.45s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0.2s;
									transition: width 0.45s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0.2s;
							}
							.selectMultiple > div a.notShown i {
									opacity: 0;
									-webkit-transition: all 0.3s ease 0.3s;
									transition: all 0.3s ease 0.3s;
							}
							.selectMultiple > div a.notShown em {
									opacity: 0;
									-webkit-transform: translate(-6px, 0);
									transform: translate(-6px, 0);
									-webkit-transition: all 0.4s ease 0.3s;
									transition: all 0.4s ease 0.3s;
							}
							.selectMultiple > div a.notShown.shown {
									opacity: 1;
							}
							.selectMultiple > div a.notShown.shown:before {
									width: 100%;
							}
							.selectMultiple > div a.notShown.shown i {
									opacity: 1;
							}
							.selectMultiple > div a.notShown.shown em {
									opacity: 1;
									-webkit-transform: translate(0, 0);
									transform: translate(0, 0);
							}
							.selectMultiple > div a.remove:before {
									width: 28px;
									-webkit-transition: width 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0s;
									transition: width 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44) 0s;
							}
							.selectMultiple > div a.remove i {
									opacity: 0;
									-webkit-transition: all 0.3s ease 0s;
									transition: all 0.3s ease 0s;
							}
							.selectMultiple > div a.remove em {
									opacity: 0;
									-webkit-transform: translate(-12px, 0);
									transform: translate(-12px, 0);
									-webkit-transition: all 0.4s ease 0s;
									transition: all 0.4s ease 0s;
							}
							.selectMultiple > div a.remove.disappear {
									opacity: 0;
									-webkit-transition: opacity 0.5s ease 0s;
									transition: opacity 0.5s ease 0s;
							}
							.selectMultiple > ul {
								height:200px;
								overflow-y:scroll;
									margin: 0;
									padding: 0;
									list-style: none;
									font-size: 16px;
									z-index: 1;
									position: absolute;
									top: 100%;
									left: 0;
									right: 0;
									visibility: hidden;
									opacity: 0;
									border-radius: 8px;
									-webkit-transform: translate(0, 20px) scale(0.8);
									transform: translate(0, 20px) scale(0.8);
									-webkit-transform-origin: 0 0;
									transform-origin: 0 0;
									-webkit-filter: drop-shadow(0 12px 20px rgba(22, 42, 90, 0.08));
									filter: drop-shadow(0 12px 20px rgba(22, 42, 90, 0.08));
									-webkit-transition: all 0.4s ease,
											-webkit-transform 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44),
											-webkit-filter 0.3s ease 0.2s;
									transition: all 0.4s ease,
											-webkit-transform 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44),
											-webkit-filter 0.3s ease 0.2s;
									transition: all 0.4s ease,
											transform 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44), filter 0.3s ease 0.2s;
									transition: all 0.4s ease,
											transform 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44), filter 0.3s ease 0.2s,
											-webkit-transform 0.4s cubic-bezier(0.87, -0.41, 0.19, 1.44),
											-webkit-filter 0.3s ease 0.2s;
							}
							.selectMultiple > ul li {
									color: #1e2330;
									background: #fff;
									padding: 12px 16px;
									cursor: pointer;
									overflow: hidden;
									position: relative;
									-webkit-transition: background 0.3s ease, color 0.3s ease,
											opacity 0.5s ease 0.3s, border-radius 0.3s ease 0.3s,
											-webkit-transform 0.3s ease 0.3s;
									transition: background 0.3s ease, color 0.3s ease, opacity 0.5s ease 0.3s,
											border-radius 0.3s ease 0.3s, -webkit-transform 0.3s ease 0.3s;
									transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease 0.3s,
											opacity 0.5s ease 0.3s, border-radius 0.3s ease 0.3s;
									transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease 0.3s,
											opacity 0.5s ease 0.3s, border-radius 0.3s ease 0.3s,
											-webkit-transform 0.3s ease 0.3s;
							}
							.selectMultiple > ul li:first-child {
									border-radius: 8px 8px 0 0;
							}
							.selectMultiple > ul li:first-child:last-child {
									border-radius: 8px;
							}
							.selectMultiple > ul li:last-child {
									border-radius: 0 0 8px 8px;
							}
							.selectMultiple > ul li:last-child:first-child {
									border-radius: 8px;
							}
							.selectMultiple > ul li:hover {
									background: #009a93;
									color: #fff;
							}
							.selectMultiple > ul li:after {
									content: "";
									position: absolute;
									top: 50%;
									left: 50%;
									width: 6px;
									height: 6px;
									background: rgba(0, 0, 0, 0.4);
									opacity: 0;
									border-radius: 100%;
									-webkit-transform: scale(1, 1) translate(-50%, -50%);
									transform: scale(1, 1) translate(-50%, -50%);
									-webkit-transform-origin: 50% 50%;
									transform-origin: 50% 50%;
							}
							.selectMultiple > ul li.beforeRemove {
									border-radius: 0 0 8px 8px;
							}
							.selectMultiple > ul li.beforeRemove:first-child {
									border-radius: 8px;
							}
							.selectMultiple > ul li.afterRemove {
									border-radius: 8px 8px 0 0;
							}
							.selectMultiple > ul li.afterRemove:last-child {
									border-radius: 8px;
							}
							.selectMultiple > ul li.remove {
									-webkit-transform: scale(0);
									transform: scale(0);
									opacity: 0;
							}
							.selectMultiple > ul li.remove:after {
									-webkit-animation: ripple 0.4s ease-out;
									animation: ripple 0.4s ease-out;
							}
							.selectMultiple > ul li.notShown {
									display: none;
									-webkit-transform: scale(0);
									transform: scale(0);
									opacity: 0;
									-webkit-transition: opacity 0.4s ease, -webkit-transform 0.35s ease;
									transition: opacity 0.4s ease, -webkit-transform 0.35s ease;
									transition: transform 0.35s ease, opacity 0.4s ease;
									transition: transform 0.35s ease, opacity 0.4s ease,
											-webkit-transform 0.35s ease;
							}
							.selectMultiple > ul li.notShown.show {
									-webkit-transform: scale(1);
									transform: scale(1);
									opacity: 1;
							}
							.selectMultiple.open > div {
									box-shadow: 0 4px 20px -1px rgba(22, 42, 90, 0.12);
							}
							.selectMultiple.open > div .arrow:before {
									-webkit-transform: rotate(-50deg);
									transform: rotate(-50deg);
							}
							.selectMultiple.open > div .arrow:after {
									-webkit-transform: rotate(50deg);
									transform: rotate(50deg);
							}
							.selectMultiple.open > ul {
									-webkit-transform: translate(0, 12px) scale(1);
									transform: translate(0, 12px) scale(1);
									opacity: 1;
									visibility: visible;
									-webkit-filter: drop-shadow(0 16px 24px rgba(22, 42, 90, 0.16));
									filter: drop-shadow(0 16px 24px rgba(22, 42, 90, 0.16));
							}

							@-webkit-keyframes ripple {
									0% {
											-webkit-transform: scale(0, 0);
											transform: scale(0, 0);
											opacity: 1;
									}
									25% {
											-webkit-transform: scale(30, 30);
											transform: scale(30, 30);
											opacity: 1;
									}
									100% {
											opacity: 0;
											-webkit-transform: scale(50, 50);
											transform: scale(50, 50);
									}
							}

							@keyframes ripple {
									0% {
											-webkit-transform: scale(0, 0);
											transform: scale(0, 0);
											opacity: 1;
									}
									25% {
											-webkit-transform: scale(30, 30);
											transform: scale(30, 30);
											opacity: 1;
									}
									100% {
											opacity: 0;
											-webkit-transform: scale(50, 50);
											transform: scale(50, 50);
									}
							}
 </style>
