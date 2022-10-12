<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Illuminate\Support\Str;
use Spatie\Sitemap\Tags\Url;

class Product extends Model implements Sitemapable
{
    use HasFactory;

    protected $table = 'product';

    protected $guarded = [];

    protected $dates = [
        'onhold_duration'
    ];

    public function toSitemapTag(): Url | string | array
    {
        return strtolower(route('landing.detail', [$this->vcompany->name,  $this->drive_type ?: 'Both', Str::slug($this->vtype->name, '_'), $this->engine_cc, $this->ref_no]));
    }

    public function vcompany()
    {
        return $this->belongsTo(Company::class, 'company');
    }

    public function v_model()
    {
        return $this->belongsTo(VModel::class, 'vmodel');
    }

    public function vtype()
    {
        return $this->belongsTo(Type::class, 'type');
    }

    public function vcolor()
    {
        return $this->belongsTo(Color::class, 'color');
    }

    public function vcountry()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function vdeal()
    {
        return $this->belongsTo(Deal::class, 'deal');
    }

    public function photos()
    {
        return $this->hasMany(Gallary::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal');
    }

    // public function toSearchableArray()
    // {
    //     $array = $this->toArray();

    //     $array['vsmaker'] = $this->vcompany->name;
    //     $array['vsmodel'] = $this->v_model->name;
    //     $array['vstype'] = $this->vtype->name;

    //     return $array;
    // }

    // public function getAccessoriesAttribute()
    // {
    //     return explode(',', $this->accessories());
    // }

    // protected $casts = [
    //     'manufacture_date' => 'date'
    // ];

}
