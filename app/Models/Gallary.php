<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    use HasFactory;

    protected $table = 'photo';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
