<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutopartPhoto extends Model
{
    use HasFactory;

    protected $table = 'autopartphoto';

    protected $guarded = [];

    public function part()
    {
        return $this->belongsTo(Autopart::class);
    }
}
