<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageMeta extends Model
{
    use HasFactory;
    protected $fillable=['seo_title','meta_description', 'meta_keywords', 'page_url', 'page_name'];
}
