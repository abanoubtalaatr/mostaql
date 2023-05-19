<main class="main-content">
    <!--head-->
    <x-admin.head/>
    <!--campaign-->
    <div class="border-div">
        <div class="b-btm">
            <h4>{{ $page_title }}</h4>
        </div>
        <div class="edit-c">
            <form wire:submit.prevent='store'>
                <div class="row">
                    <div class="col-12">
                        <label>@lang('site.title_ar')</label>
                        <input wire:model.defer='title_ar' class="@error('title_ar') is-invalid @enderror form-control contact-input" type="text" placeholder="@lang('validation.attributes.title_ar')"/>
                        @error('title_ar') <p class="text-danger">{{$message}}</p> @enderror
                        <hr/>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-12" wire:ignore>
                        <label>@lang('validation.attributes.desc_ar')</label>
                        <div wire:ignore>
                            <textarea id="my-editor" wire:model="desc_ar" style="height: 300px"></textarea>
                            @error('desc_ar') <p class="text-danger">{{$message}}</p> @enderror
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
<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#my-editor'),{
            language: 'ar'
        })
        .then(editor => {
            editor.setData(@json($desc_ar));

            editor.model.document.on('change:data', () => {
            @this.set('desc_ar', editor.getData());
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
