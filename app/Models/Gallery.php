<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public function scopeWhereAdvertise($builder,int $advertiseId)
    {
        return $builder->where('advertise_id',$advertiseId)->latest();
    }
}
