<?php

namespace App\Models;

use App\Traits\HasFixedSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory, SoftDeletes, HasFixedSlug;

    protected $fillable = ['name', 'slug', 'logo_url'];
}
