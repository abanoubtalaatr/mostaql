<main class="main-content">
    <!--head-->
    <x-admin.head/>


    <!--campaign-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{$page_title}}</h4>
        </div>
        <div class="edit-c">
            <form wire:submit.prevent='store' enctype="multipart/form-data">
                <div class="row">
                    <div class="col-6">
                        <label>@lang('site.title')</label>
                        <input wire:model.defer='form.title'
                               class="@error('form.title') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.title')"/>
                        @error('form.title') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label>@lang('validation.attributes.snap_chat')</label>
                        <input wire:model.defer='form.snap_chat'
                               class="@error('form.snap_chat') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.snap_chat')"/>
                        @error('form.snap_chat') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label>@lang('validation.attributes.location')</label>
                        <input wire:model.defer='form.location'
                               class="@error('form.location') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.location')"/>
                        @error('form.location') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label>@lang('validation.attributes.website')</label>
                        <input wire:model.defer='form.website'
                               class="@error('form.website') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.website')"/>
                        @error('form.website') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label>@lang('validation.attributes.facebook')</label>
                        <input wire:model.defer='form.facebook'
                               class="@error('form.facebook') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.facebook')"/>
                        @error('form.facebook') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>


                    <div class="col-6">
                        <label>@lang('validation.attributes.instagram')</label>
                        <input wire:model.defer='form.instagram'
                               class="@error('form.instagram') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.instagram')"/>
                        @error('form.instagram') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label>@lang('validation.attributes.twitter')</label>
                        <input wire:model.defer='form.twitter'
                               class="@error('form.twitter') is-invalid @enderror form-control contact-input"
                               type="text" placeholder="@lang('validation.attributes.twitter')"/>
                        @error('form.twitter') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="row">
                        <div class="col-6 " data-provide="datepicker">
                            <label>@lang('validation.attributes.start_at')</label>
                            <input wire:model='form.start_at'
                                   class="@error('form.start_at') is-invalid @enderror form-control" type="date"
                                   placeholder="@lang('validation.attributes.start_at')">
                            @error('form.start_at') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>
                        <div class="col-6 " data-provide="datepicker">
                            <label>@lang('validation.attributes.end_at')</label>
                            <input wire:model='form.end_at'
                                   class="@error('form.end_at') is-invalid @enderror form-control" type="date"
                                   placeholder="@lang('validation.attributes.end_at')">
                            @error('form.end_at') <p class="text-danger">{{$message}}</p> @enderror
                            <hr/>
                        </div>

                    </div>
                    <div class="row">
                        <div class="custom-file-upload">
                            @if($photo)
                                <img  style='max-width:100%'  src="{{$photo->temporaryUrl()}}" alt="">
                            @else
                                @isset($ad)
                                    <img style='max-width:100%' src="{{$ad->photo_url}}" alt="">
                                @endisset
                            @endif
                            <img src="{{asset('frontAssets')}}/imgs/wallet/upload.svg" alt="">
                            <span>@lang('validation.attributes.picture')</span>
                            <input wire:model='photo' class='form-control @error('photo') is-invalid @enderror' type="file"/>
                            @error('photo') <p class="text-danger">{{$message}}</p> @enderror
                        </div>
                    </div>

                </div>

                <div class="btns text-center">
                    <button type='submit' class="button btn-red big">@lang('site.save')</button>
                </div>

            </form>
        </div>
    </div>
</main>

