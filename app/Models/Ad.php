<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPhotoUrlAttribute()
    {
        return url('uploads/pics/' . $this->photo);
    }

    public static function active()
    {
        return static::where('start_at', '<=', now())
            ->where('end_at', '>=', now())
            ->inRandomOrder()
            ->limit(1)
            ->first();
    }
}
