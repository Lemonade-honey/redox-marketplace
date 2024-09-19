<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'categorie_id');
    }
}
