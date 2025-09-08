<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantAttribute extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantAttributeFactory> */
    use HasFactory;

    protected $fillable = [
        'variant_id',
        'key',
        'value',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
