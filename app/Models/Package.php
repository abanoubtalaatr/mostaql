<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['features'];

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_packages');;
    }

    public function hasFeature($featureId)
    {

        if($this->features->where('id', $featureId)->first()) {
            return true;
        }
        return false;
    }
}
