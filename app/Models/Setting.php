<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'site_name',
        'address',
        'phone',
        'email',
        'short_description',
        'long_description',
        'social_medias'
    ];

    protected $casts = [
        'social_medias' => 'array'
    ];

    /**
     * Scopes.
     *
     */
    public function scopeCreateOrUpdate($query, ?array $information): bool
    {
        return $query->firstOrCreate([], $information)
            ->update($information);
    }
}
