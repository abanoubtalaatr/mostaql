<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Support\{MyFcmNotificationInterface, MyFcmNotificationChannel, MyDatabaseNotificationInterface, MyDatabaseNotificationChannel};


class NotifySoliderNotEnoughDataNotification extends Notification implements MyDatabaseNotificationInterface, MyFcmNotificationInterface, ShouldQueue{
    use Queueable;
    public $ad_id;
    public function __construct(){
//        $this->ad_id = $ad_id;
//        dd($no)
    }

    public function via($notifiable){
        return [MyDatabaseNotificationChannel::class, MyFcmNotificationChannel::class];
    }

    public function toMyFcm($notifiable){}

    public function getFcmData($notifiable){
//        dd($notifiable);
        $subject_id = $notifiable->id;
        $title_ar = 'أدسولجرز';
        $title_en = 'Adsoldiers';
        $type = 'not_enough_data';

        $content_ar = ('حتى يتم بناء ملف البيانات الخاصة بك لتتمكن من مشاركة الإعلانات يجب مشاركة محتوى من المكتبة مع عدد أكبر من الأشخاص ويتجاوز عدد الزائرين 100 شخص على الأقل.');
        $content_en = ("So your data profile is built for you to share ads Content from the library must be shared with more people and the number of visitors exceeds at least 50 people.");

            return array_merge(
            ['user_id'=>$notifiable->id,'subject_id'=>$subject_id],
            compact('title_ar','title_en','content_ar','content_en','type','subject_id')
        );
    }

    public function toMyDatabase($notifiable){
        $subject_id = $notifiable->id;
        $title_ar = 'أدسولجرز';
        $title_en = 'Adsoldiers';
        $type = 'not_enough_data';

        $content_ar = ('حتى يتم بناء ملف البيانات الخاصة بك لتتمكن من مشاركة الإعلانات يجب مشاركة محتوى من المكتبة مع عدد أكبر من الأشخاص ويتجاوز عدد الزائرين 100 شخص على الأقل.');
        $content_en = ("So your data profile is built for you to share ads Content from the library must be shared with more people and the number of visitors exceeds at least 50 people.");
            return array_merge(
            ['user_id'=>$notifiable->id,'subject_id'=>$subject_id],
            compact('title_ar','title_en','content_ar','content_en','type','subject_id')
        );
    }
}
