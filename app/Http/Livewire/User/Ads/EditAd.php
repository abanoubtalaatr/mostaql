<?php

namespace App\Http\Livewire\User\Ads;

use App\Models\Ad;
use App\Models\Age;
use App\Models\Camp;
use App\Models\City;
use App\Models\Gender;
use App\Models\Country;
use Livewire\Component;
use App\Models\Audience;
use App\Models\Language;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Traits\ValidationTrait;

use Image;

class EditAd extends Component{
    use ValidationTrait,WithFileUploads;

    public $media_files=[];
    public $page_title;
    public $form;
    public $camps,$genders,$ages,$countries;
    public $ad_genders,$ad_countries,$ad_targeted_audiences,$ad_ages,$ad_languages,$ad_cities;
    public $cities_iteration=0;

    public $camp_types;
    public $camp=[];
    public $camp_title='';
    public $camp_type = '';
    public $whatsapp_thumbnail;

    public $ad;

    public function mount(Ad $ad){

        $this->ad = $ad;
        $this->camp_types= ['awarness','traffic','app_installs','video_views','messages','lead_generation'];
        $this->camp = ['title'=>null,'type'=>'awarness'];

        $this->form = Arr::except($this->ad->toArray(),['id','created_at','updated_at','user_id']);
        $this->page_title = __('site.create_ad');

        $this->camps = auth('users')->user()->camps()->whereStatus('active')->get();
        $this->genders = Gender::get();
        $this->ages = Age::get();
        $this->countries = Country::whereId(1)->get();
        $this->cities = City::get();
        $this->languages = Language::get();
        $this->audiences = Audience::get();

        $this->ad_genders = $ad->genders->pluck('id')->toArray();
        $this->ad_ages = $ad->ages->pluck('id')->toArray();
        $this->ad_targeted_audiences = $ad->audiences->pluck('id')->toArray();
        $this->ad_countries = $ad->countries->pluck('id')->toArray();
        $this->ad_cities = $ad->cities->pluck('id')->toArray();
        $this->ad_languages = $ad->languages->pluck('id')->toArray();

    }


    public function getMediaPreviewProperty(){
        return $this->media_files? $this->media_files[0]->temporaryUrl() : $this->ad->media_preview_url;
    }


    public function store(){
        $this->validate();

        //(1): upload media
        $path = date('Y/m/d');
        $media = [];

        foreach($this->media_files as $single_media){

            $hashed_name = Str::random(25).'_'.mt_getrandmax().'.'.$single_media->extension();
            $new_media = $single_media->storeAs($path,$hashed_name,'public');
            if($single_media->extension()=='mp4'){

                $media = [$new_media];
                $this->form['media_type']='video';
                break;
            }
            $media[] = $new_media;
            $this->form['media_type']='image';
        }

        if($media){
            $this->form['media'] = $this->form['media_type']=='slider'? array_merge($media,$this->form['media']) : $media;
            $this->form['media_type'] = count($this->form['media'])>1? 'slider' : $this->form['media_type'];
        }


        //(2): Upload video thumbnail
        $hashed_name = $this->whatsapp_thumbnail? Str::random(25).'_'.mt_getrandmax().'.'.$this->whatsapp_thumbnail->extension() : '';
        // $this->form['whatsapp_thumbnail'] = $this->whatsapp_thumbnail? $this->whatsapp_thumbnail->storeAs($path,$hashed_name,'public') : $this->form['whatsapp_thumbnail'];

        if($this->whatsapp_thumbnail){
            ini_set('memory_limit', '256M');
            $this->form['whatsapp_thumbnail'] = $this->whatsapp_thumbnail->storeAs($path,$hashed_name,'public');
            $new_pic_path = Storage::disk('public')->path($this->form['whatsapp_thumbnail']);
            Image::make($new_pic_path)->resize(300,200)->save(Storage::disk('public')->path($path.'/thumb_'.$hashed_name));
        }

        //(3): update ad
        $this->ad->update($this->form);

        //(4): Sync relations
        $this->ad->genders()->sync($this->ad_genders);
        $this->ad->countries()->sync($this->ad_countries);
        $this->ad->cities()->sync($this->ad_cities);
        $this->ad->audiences()->sync($this->ad_targeted_audiences);
        $this->ad->ages()->sync($this->ad_ages);
        $this->ad->languages()->sync($this->ad_languages);

        session()->flash('success_message',__('site.ad_updated_successfully'));
        return redirect()->to(route('user.show_ad',$this->ad->id));
    }


    public function updatedWhatsappThumbnail(){
        $this->withValidator(function ($validator) {
            if($validator->errors()->has('whatsapp_thumbnail')){
                $this->whatsapp_thumbnail = '';
            }
        })->validateOnly('whatsapp_thumbnail');
    }

    public function getWhatsappPreviewProperty(){
        return $this->whatsapp_thumbnail? $this->whatsapp_thumbnail->temporaryUrl() : url('uploads/pics/'.$this->form['whatsapp_thumbnail']);
    }

    public function getRules(){
        $rules = [
            'form.title'=>'required|min:3|max:300',
            'form.content'=>'required|min:3|max:500',
            'form.start_date'=>'required|date|date-format:Y-m-d|after:yesterday',
            'form.start_time'=>'required',
            'form.budget'=>'required|integer|gt:0|digits_between:1,7',
            'form.button_text'=>'required|min:2|max:200',
            'form.link'=>'required|active_url|max:300',
            'form.camp_id'=>'required|exists:camps,id',
            'form.short_description'=>'required|min:3|max:300',
            'whatsapp_thumbnail'=>'nullable|file|mimes:jpg,png,jpeg|max:300',

            'ad_genders'=>'required|array',
            'ad_genders.*'=>'integer|exists:genders,id',

            'ad_ages'=>'required|array',
            'ad_ages.*'=>'integer|exists:ages,id',

            'ad_targeted_audiences'=>'required|array',
            'ad_targeted_audiences.*'=>'integer|exists:audiences,id',

            'ad_countries'=>'required|array',
            'ad_countries.*'=>'integer|exists:countries,id',

            'ad_cities'=>'required|array',
            'ad_cities.*'=>'integer|exists:cities,id',

            'ad_languages'=>'required|array',
            'ad_languages.*'=>'exists:languages,id',
        ];

        $rules['form.media'] = 'nullable';

        return $rules;
    }

    public function deletePic($pic_path){
        $this->form['media'] = array_filter($this->form['media'],function($el) use ($pic_path){
            return $el!=$pic_path;
        });
    }


    public function storeCamp(){
        try {
            $this->validate([
                'camp.title'=>['required','max:200',Rule::unique('camps','title')->where('user_id',auth('users')->id())],
                'camp.type'=>'required|in:'.implode(',',$this->camp_types)
            ],
                [
                    'camp.title.required'=>__('site.camp_title_is_required'),
                    'camp.title.max'=>__('site.max_camp_title_is_200'),
                    'camp.title.unique'=>__('site.camp_title_must_be_unique'),
                ]
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatchBrowserEvent('notify-error',$e->validator->errors());
            $this->validate([
                'camp.title'=>['required','max:200',Rule::unique('camps','title')->where('user_id',auth('users')->id())],
                'camp.type'=>'required|in:'.implode(',',$this->camp_types)
            ]);
        }


        $new_camp = auth('users')->user()->camps()->create($this->camp);
        $this->camps = auth('users')->user()->camps()->whereStatus('active')->get();
        $this->form['camp_id'] = $new_camp->id;
        $this->camp = [];
        $this->dispatchBrowserEvent('hide-modal',['new_camp_id'=>$this->form['camp_id']]);
    }

    public function updated(){
        $this->dispatchBrowserEvent('onContentChanged');
    }

    public function render(){
        $data = [
            'ad'=>$this->ad
        ];
        return view('livewire.user.ads.edit-ad',$data);
    }
}
