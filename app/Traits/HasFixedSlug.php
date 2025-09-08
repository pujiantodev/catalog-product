<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasFixedSlug
{
    public static function bootHasFixedSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug) && !empty($model->slugSource())) {
                $model->slug = Str::slug($model->slugSource()) . '-' . Str::ulid();
            }
        });
    }

    // field / column resource for slug, like name, title
    public function slugSource(): ?string
    {
        return $this->name ?? null;
    }
}
