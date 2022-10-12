<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Blog extends Model implements Sitemapable
{
    use HasFactory;

    protected $guarded = [];

    public function toSitemapTag(): Url | string | array
    {
        return strtolower(route('landing.blog', [$this->slug]));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
