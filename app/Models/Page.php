<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model{
    use HasFactory;
    protected $guarded = [];

    public function getPictureUrlAttribute(){
        return url('uploads/pics/'.$this->picture);
    }
}
