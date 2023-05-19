
<main class="main-content">
          <!--head-->
          <x-admin.head/>
          <!--campaign-->
          <div class="border-div">
            <div class="b-btm">
              <h4>{{$page_title}}</h4>
            </div>
            <div class="edit-c">
                <form wire:submit.prevent='update'>
                    <div class="row">
                        <div class="col-6">
                            <label for="">@lang('validation.attributes.email')</label>
                            <input wire:model='form.email'  placeholder="@lang('validation.attributes.email')" class="@error('form.email') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.email') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <label for="">@lang('validation.attributes.address')</label>
                            <input wire:model='form.address'  placeholder="@lang('validation.attributes.address')" class="@error('form.address') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.address') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="">@lang('validation.attributes.mobile')</label>
                            <input wire:model='form.mobile'  placeholder="@lang('validation.attributes.mobile')" class="@error('form.mobile') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.mobile') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <label for="">@lang('validation.attributes.facebook')</label>
                            <input wire:model='form.facebook'  placeholder="@lang('validation.attributes.facebook')" class="@error('form.facebook') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.facebook') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="">@lang('validation.attributes.instagram')</label>
                            <input wire:model='form.instagram'  placeholder="@lang('validation.attributes.instagram')" class="@error('form.instagram') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.instagram') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <label for="">@lang('validation.attributes.twitter')</label>
                            <input wire:model='form.twitter'  placeholder="@lang('validation.attributes.twitter')" class="@error('form.twitter') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.twitter') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="">@lang('validation.attributes.snap_chat')</label>
                            <input wire:model='form.snap_chat'  placeholder="@lang('validation.attributes.snap_chat')" class="@error('form.snap_chat') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.snap_chat') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <label for="">@lang('validation.attributes.platform_dues')</label>
                            <input wire:model='form.platform_dues'  placeholder="@lang('validation.attributes.snap_chat')" class="@error('form.platform_dues') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.platform_dues') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                    </div>

                     {{-- <div class="row">
                        <div class="col-6">
                            <label for="">@lang('validation.attributes.publisher_video')</label>
                            <input wire:model='form.publisher_video'  placeholder="@lang('validation.attributes.publisher_video')" class="@error('form.publisher_video') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.publisher_video') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                        <div class="col-6">
                            <input wire:model='form.advertiser_video'  placeholder="@lang('validation.attributes.advertiser_video')" class="@error('form.advertiser_video') is-invalid @enderror form-control contact-input" type="text"/>
                            @error('form.advertiser_video') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                    </div> --}}

{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.google_play')</label>--}}
{{--                            <input wire:model='form.google_play'  placeholder="@lang('validation.attributes.google_play')" class="@error('form.google_play') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.google_play') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}

{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.app_store')</label>--}}
{{--                            <input wire:model='form.app_store'  placeholder="@lang('validation.attributes.app_store')" class="@error('form.app_store') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.app_store') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}
{{--                    </div>--}}



{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.lat')</label>--}}
{{--                            <input wire:model='form.lat'  placeholder="@lang('validation.attributes.lat')" class="@error('form.lat') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.lat') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}

{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.lng')</label>--}}
{{--                            <input wire:model='form.lng'  placeholder="@lang('validation.attributes.lng')" class="@error('form.lng') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.lng') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.ad_min_budget')</label>--}}
{{--                            <input wire:model='form.ad_min_budget'  placeholder="@lang('validation.attributes.ad_min_budget')" class="@error('form.ad_min_budget') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.ad_min_budget') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}

{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.ad_click_price')</label>--}}
{{--                            <input wire:model='form.ad_click_price'  placeholder="@lang('validation.attributes.ad_click_price')" class="@error('form.ad_click_price') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.ad_click_price') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="row">
{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.soldier_ad_click_price')</label>--}}
{{--                            <input wire:model='form.soldier_ad_click_price'  placeholder="@lang('validation.attributes.soldier_ad_click_price')" class="@error('form.soldier_ad_click_price') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.soldier_ad_click_price') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}



{{--                        <div class="col-6">--}}
{{--                            <label>@lang('validation.attributes.ad_click_price_currency')</label>--}}
{{--                            <select wire:model='form.ad_click_price_currency' class="form-control @error('form.ad_click_price_currency') is-invalid @enderror">--}}
{{--                                <option value="sar">@lang('site.sar_short')</option>--}}
{{--                                <option value="usd">@lang('site.usd')</option>--}}
{{--                            </select>--}}
{{--                            @error('form.ad_click_price_currency') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}
                    </div>
                    <div class="row">
{{--                        <div class="col-4">--}}
{{--                            <label for="">@lang('validation.attributes.min_ad_view_duration')</label>--}}
{{--                            <input wire:model='form.min_ad_view_duration'  placeholder="@lang('validation.attributes.min_ad_view_duration')" class="@error('form.min_ad_view_duration') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.min_ad_view_duration') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}

{{--                        <div class="col-4">--}}
{{--                            <label for="">@lang('validation.attributes.solider_ad_max_profit')</label>--}}
{{--                            <input wire:model='form.solider_ad_max_profit' placeholder="@lang('validation.attributes.solider_ad_max_profit')" class="@error('form.solider_ad_max_profit') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.solider_ad_max_profit') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}


{{--                        <div class="col-4">--}}
{{--                            <label for="">@lang('validation.attributes.minimum_payback_amount')</label>--}}
{{--                            <input wire:model='form.minimum_payback_amount' placeholder="@lang('validation.attributes.minimum_payback_amount')" class="@error('form.minimum_payback_amount') is-invalid @enderror form-control contact-input" type="text"/>--}}
{{--                            @error('form.minimum_payback_amount') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}

                    </div>


                     <div class="row">
{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.mission_ar')</label>--}}
{{--                            <textarea wire:model='form.mission_ar'  placeholder="@lang('validation.attributes.mission_ar')" class="@error('form.mission_ar') is-invalid @enderror form-control contact-input"></textarea>--}}
{{--                            @error('form.mission_ar') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}

{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.mission_en')</label>--}}
{{--                            <textarea wire:model='form.mission_en' placeholder="@lang('validation.attributes.mission_en')" class="@error('form.mission_en') is-invalid @enderror form-control contact-input"></textarea>--}}
{{--                            @error('form.mission_en') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}

{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.vision_ar')</label>--}}
{{--                            <textarea wire:model='form.vision_ar'  placeholder="@lang('validation.attributes.vision_ar')" class="@error('form.vision_ar') is-invalid @enderror form-control contact-input"></textarea>--}}
{{--                            @error('form.vision_ar') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}

{{--                        <div class="col-6">--}}
{{--                            <label for="">@lang('validation.attributes.vision_en')</label>--}}
{{--                            <textarea wire:model='form.vision_en' placeholder="@lang('validation.attributes.vision_en')" class="@error('form.vision_en') is-invalid @enderror form-control contact-input"></textarea>--}}
{{--                            @error('form.vision_en') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                            <hr/>--}}
{{--                        </div>--}}
{{--                         <div class="col-6">--}}
{{--                             <label for="">@lang('validation.attributes.number_of_days_will_send_notification_to_solider')</label>--}}
{{--                             <input wire:model='form.number_of_days'  placeholder="@lang('validation.attributes.number_of_days_will_send_notification_to_solider')" class="@error('form.number_of_days') is-invalid @enderror form-control contact-input" type="number"/>--}}
{{--                             @error('form.number_of_days') <p class="text-danger">{{$message}}</p> @enderror--}}
{{--                             <hr/>--}}
{{--                         </div>--}}

                    </div>




                    <div class="btns text-center">
                        <button type='submit' class="button btn-red big">@lang('site.save')</button>
                    </div>

                </form>
            </div>
          </div>
        </main>
