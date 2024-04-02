<?php

namespace App\Models;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'inventory_id',
        'name',
        'slug',
        'description',
        'image',
        'quantity',
    ];

    //define slug as route key name
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    //define title column for making slug unique
    public function getSluggableColumnName(): string
    {
        return 'name';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}
