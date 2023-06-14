<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalEditRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'requests';


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class,'freelancer_id');
    }
}
