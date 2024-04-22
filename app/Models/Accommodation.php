<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $fillable = ['type', 'price_per_night', 'image'];
}
