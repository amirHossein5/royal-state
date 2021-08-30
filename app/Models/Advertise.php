<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Advertise extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'address', 'amount', 'image', 'floor', 'year', 'storeroom', 'balcony', 'area', 'room', 'parking', 'toilet', 'tag', 'type', 'sell_status', 'cat_id', 'user_id', 'approved', 'be_on_slider'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
        'image' => 'array',
        'storeroom' => 'boolean',
        'balcony' => 'boolean',
        'parking' => 'boolean',
        'sell_status' => 'boolean'
    ];

    /**
     * Relations
     *
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function slide(): HasOne
    {
        return $this->hasOne(Slide::class);
    }

    /**
     * Scopes
     *
     */
    public function scopeWithOwner($query): Builder
    {
        return $query->with('owner:first_name,last_name,id');
    }

    public function scopeWithCategory($query): Builder
    {
        return $query->addSelect([
            'category_name' => Category::select('name')
                ->whereColumn('advertises.cat_id', 'categories.id')
        ]);
    }

    /**
     * Accssors
     *
     */
    public function getStoreRoomStatusAttribute(): string
    {
        return $this->storeroom
            ? 'دارد'
            : 'ندارد';
    }

    public function getBalconyStatusAttribute(): string
    {
        return $this->balcony
            ? 'دارد'
            : 'ندارد';
    }

    public function getParkingStatusAttribute(): string
    {
        return $this->parking
            ? 'دارد'
            : 'ندارد';
    }
}
