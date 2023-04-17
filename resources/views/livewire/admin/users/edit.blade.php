<main class="main-content">
<x-admin.head/>
    <!--campaign-->
    <div class="border-div">
    <div class="b-btm">
        <h4>{{$page_title}}</h4>
    </div>
    <div class="row mt-30">
        <div class="col-lg-12">


        <form  wire:submit.prevent='update' action="" class="contac-form row">

            <div class="form-group col-6">
                <label for="form.username">@lang('validation.attributes.username')</label>
                <input wire:model.defer='form.username' class="form-control" type="text" placeholder="@lang('validation.attributes.username')"/>
                @error('form.username')<p style='color:red'> {{$message}} </p>@enderror
            </div>

             <div class="form-group col-6">
                <label for="form.email">@lang('validation.attributes.email')</label>
                <input wire:model.defer='form.email' class="form-control" type="text" placeholder="@lang('validation.attributes.email')"/>
                @error('form.email')<p style='color:red'> {{$message}} </p>@enderror
            </div>




            <hr>

            <div class="form-group col-6">
                <label for="form.mobile">@lang('validation.attributes.mobile')</label>
                <input wire:model.defer='form.mobile' class="form-control" type="text" placeholder="@lang('validation.attributes.mobile')"/>
                @error('form.mobile')<p style='color:red'> {{$message}} </p>@enderror
            </div>



                <div class="form-group col-6">
                    <label for="form.password">@lang('validation.attributes.password')</label>
                    <input wire:model.defer='form.password' class="form-control" type="password" placeholder="@lang('validation.attributes.password')"/>
                    @error('form.password')<p style='color:red'> {{$message}} </p>@enderror
                </div>

                <div class="form-group col-6">
                    <label for="form.password_confirmation">@lang('validation.attributes.password_confirmation')</label>
                    <input wire:model.defer='form.password_confirmation' class="form-control" type="password" placeholder="@lang('validation.attributes.password_confirmation')"/>
                    @error('form.password_confirmation')<p style='color:red'> {{$message}} </p>@enderror
                </div>

            <hr>



            <div class="btns text-center">
                <button type = 'submit' class="button btn-red big">@lang('site.edit_user')</button>
            </div>

        </form>


        </div>

    </div>
    </div>
</main>
