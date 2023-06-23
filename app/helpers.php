<?php

use App\Models\Notification;

if (!function_exists('createNotificationInDatabase')) {
    function createNotificationInDatabase($message, $body, $user, $project)
    {
        $title_ar = $message;
        $content_ar = "$body ( $project->title )";
        $user_id = $user->id;
        $type = 'proposal';

        Notification::create([
            'title_ar' => $title_ar,
            'content_ar' => $content_ar,
            'user_id' => $user_id,
            'type' => $type,
            'link' => route('project.show',$project->id)
        ]);
    }
}

if (!function_exists('checkCanAddOfferOnProject')) {
    function checkCanAddOfferOnProject(\App\Models\Project $project)
    {

    }
}
