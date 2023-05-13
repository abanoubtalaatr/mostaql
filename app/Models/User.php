<?php

namespace App\Models;

use App\Models\Camp;
use Illuminate\Support\Str;
use App\Services\FCMService;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Services\GenerateCodeService;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function acceptedProposals()
    {
        return $this->hasMany(Proposal::class)->where('status_id',3);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, SkillUser::class);
    }

    public function getAvatarAttribute($value)
    {
        return url('uploads/pics/' .$value);
    }

    public function getMinimizedPictureAttribute($value)
    {
        return url('uploads/pics/' .$value);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function completedProposals()
    {
        return $this->hasMany(Proposal::class)->where('status_id',5);
    }

    public function processingProposals()
    {
        return $this->hasMany(Proposal::class)->where('status_id',6);
    }

    public function rejectedProposals()
    {
        return $this->hasMany(Proposal::class)->where('status_id',4);
    }

    public function averageRates()
    {
        // sum of of rate for this user divided by rate rows
        $sumRate = $this->rates()->sum('rate');
        $countRate = $this->rates()->count();
        if($sumRate > 0 && $countRate > 0) {
            return round($sumRate / $countRate);
        }
        return  0;
    }

    public function medals()
    {
        return $this->hasManyThrough(Medal::class, MedalUser::class, 'user_id', 'id', 'id', 'medal_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function camps()
    {
        return $this->hasMany(Camp::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function tasks()
    {
        return Task::whereStatus('active')->where('id', '<=', $this->task_level + 1);
    }

    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function notPaidWallets()
    {
        return $this->hasMany(Wallet::class)->whereNull('payback_request_id');
    }

    public function paybackRequests()
    {
        return $this->hasMany(PaybackRequest::class);
    }

    public function statsSessionsSoldier()
    {
        return $this->hasMany(StatsSessionsSoldier::class)->where('item_type', 'ad');
    }

    public function statsLibrarySessionsSoldier()
    {
        return $this->belongsToMany(Library::class, 'stats_sessions_soldier', 'user_id', 'ad_id')->wherePivot('item_type', 'library')->withPivot('visitors_number');
    }

    public function statsAgeSoldier()
    {
        return $this->hasMany(StatsAgeSoldier::class);
    }

    public function statsCountrySoldier()
    {
        return $this->hasMany(StatsCountrySoldier::class);
    }

    public function statsGenderSoldier()
    {
        return $this->hasMany(StatsGenderSoldier::class);
    }

    public function statsAudienceSoldier()
    {
        return $this->hasMany(StatsAudienceSoldier::class);
    }

    public function statsAudienceSoldierView()
    {
        return $this->hasMany(StatsAudienceSoldierView::class);
    }

    public function statsCitySoldierView()
    {
        return $this->hasMany(StatsCitySoldierView::class);
    }


    public function getAllowedToShowAdsAttribute()
    {
        return $this->last_share == 'library';
    }

    public function getStatusClassAttribute()
    {
        return $this->is_active == 1 ? 'green' : 'yellow';
    }

    public function getStatusAttribute()
    {
        return $this->is_active == 1 ? 'active' : 'inactive';
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar == 'default_user_avatar.png' ? asset('frontAssets/assets_' . app()->getLocale() . '/imgs/home/logo.svg')
            :
            url('uploads/pics/' . $this->avatar);
    }


    public function filters()
    {
        return $this->hasMany(Filter::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($query) {
            $query->avatar = 'default_user_avatar.png';
            $query->default_language = app()->getLocale();
            $query->resend_verification_code_num = 1;
            $query->task_level = 0;
            $query->is_active = 1;
            $query->is_verified = $query->user_type == 'soldier' ? 0 : 1;
            // here last share was ad but when client want to share ad always without share library first
            // if he needs to return to previous example (want first share library then ad will replace library with ad)
            $query->last_share = $query->user_type == 'soldier' ? 'library' : '';
            $query->utm = $query->user_type == 'soldier' ? Str::random(20) : null;
        });

        static::created(function ($model) {
            if ($model->user_type == 'soldier') {
                // $notifiable = $model;

                // $title_ar = 'أدسولجرز';
                // $title_en = 'Adsoldiers';

                // $content_ar = sprintf('برجاء مشاهدة الشرح التوضيحي من خلال زيارة صفحة المهام');

                // $content_en = sprintf('Please view the tutorial by visiting Tasks');

                // $title = ($notifiable->default_language=='ar')? $title_ar : $title_en;
                // $body = ($notifiable->default_language=='ar')? $content_ar : $content_en;
                // $type = 'soldier_show_tutorial';
                // $subject_id = $model->id;


                // FCMService::spark_send_fcm(
                //     $notifiable,
                //     $title,
                //     $body,
                //     compact('content_ar','content_en','title_ar','title_en','type','subject_id')
                // );
            }
        });
    }


    //JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
