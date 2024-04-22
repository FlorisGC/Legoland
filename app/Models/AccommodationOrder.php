<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationOrder extends Model
{
    protected $fillable = ['email', 'accommodation_id', 'number_of_nights'];
}
