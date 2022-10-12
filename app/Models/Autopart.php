<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autopart extends Model
{
    use HasFactory;

    protected $table = 'autopart';

    protected $guarded = [];

    public function apcompany()
    {
        return $this->belongsTo(Company::class, 'company');
    }

    public function apmodel()
    {
        return $this->belongsTo(VModel::class, 'vmodel');
    }

    public function apcountry()
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function photos()
    {
        return $this->hasMany(AutopartPhoto::class, 'autopart_id');
    }
}
