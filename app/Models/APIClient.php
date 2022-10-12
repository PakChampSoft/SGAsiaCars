<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIClient extends Model
{
    use HasFactory;

    protected $table = 'outsource_api_clients';

    protected $guarded = [];

    public $timestamps = false;
}
