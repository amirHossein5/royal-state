<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    public $fillable = ['name', 'display_name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function scopeFindByName($query, string $name): Role
    {
        return $query->where('name', $name)->first();
    }
}
