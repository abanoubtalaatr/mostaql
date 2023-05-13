<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function money()
    {
        return $this->belongsTo(Money::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, ProjectSkill::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

}
