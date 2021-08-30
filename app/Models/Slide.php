<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'image',
        'title',
        'address',
        'description',
        'amount'
    ];

    /**
     * Relations
     *
     */
    public function advertise(): BelongsTo
    {
        return $this->belongsTo(Advertise::class);
    }
}
