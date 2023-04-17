<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource{

    public function toArray($request){

        $is_completed = optional(auth('api-users')->user())->task_level>=$this->id? 1 : 0;

        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'media_type'=>$this->media_type,
            'media'=>$this->media_url,
            'is_completed'=>$is_completed
        ];
    }
}
