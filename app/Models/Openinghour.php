<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Openinghour extends Model
{
    protected $fillable = ['day', 'open', 'close'];
}
