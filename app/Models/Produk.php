<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pembuat(): HasMany
    {
        return $this->hasMany(produk::class);
    }

    public function penjualan(): HasOne
    {
        return $this->hasOne(penjualan::class);
    }
}
