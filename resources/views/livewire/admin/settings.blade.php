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
                        <input wire:model='form.email' placeholder="@lang('validation.attributes.email')"
                               class="@error('form.email') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.email') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.address')</label>
                        <input wire:model='form.address' placeholder="@lang('validation.attributes.address')"
                               class="@error('form.address') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.address') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.mobile')</label>
                        <input wire:model='form.mobile' placeholder="@lang('validation.attributes.mobile')"
                               class="@error('form.mobile') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.mobile') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.facebook')</label>
                        <input wire:model='form.facebook' placeholder="@lang('validation.attributes.facebook')"
                               class="@error('form.facebook') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.facebook') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.instagram')</label>
                        <input wire:model='form.instagram' placeholder="@lang('validation.attributes.instagram')"
                               class="@error('form.instagram') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.instagram') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.twitter')</label>
                        <input wire:model='form.twitter' placeholder="@lang('validation.attributes.twitter')"
                               class="@error('form.twitter') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.twitter') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="">@lang('validation.attributes.snap_chat')</label>
                        <input wire:model='form.snap_chat' placeholder="@lang('validation.attributes.snap_chat')"
                               class="@error('form.snap_chat') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.snap_chat') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                    <div class="col-6">
                        <label for="">@lang('validation.attributes.platform_dues')</label>
                        <input wire:model='form.platform_dues' placeholder="@lang('validation.attributes.snap_chat')"
                               class="@error('form.platform_dues') is-invalid @enderror form-control contact-input"
                               type="text"/>
                        @error('form.platform_dues') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <label for="">@lang('site.text_fo_accept_deal')</label>
                        <textarea rows="4" wire:model='form.text_fo_accept_deal'
                                  placeholder="@lang('site.text_fo_accept_deal')"
                                  class="@error('form.text_fo_accept_deal') is-invalid @enderror form-control contact-input"></textarea>
                        @error('form.text_fo_accept_deal') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>

                </div>

                <div class="row mb-5">
                    <div class="col-6">
                        <label for="">@lang('site.packages_is_active')</label>
                        <div class="form-group ">
                            <select wire:model='form.packages_is_active' id='status-select'
                                    class="form-control  contact-input">
                                <option value>@lang('site.status')</option>
                                <option value="1">@lang('site.active')</option>
                                <option value="0">@lang('site.inactive')</option>
                            </select>
                        </div>
                        @error('form.packages_is_active') <p class="text-danger">{{$message}}</p> @enderror
                    </div>
                </div>

                <div class="btns text-center">
                    <button type='submit' class="button btn-red big">@lang('site.save')</button>
                </div>

            </form>
        </div>
    </div>
</main>
