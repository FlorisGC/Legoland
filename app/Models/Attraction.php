<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    protected $fillable = ['title', 'description', 'image'];

     /**
     * Set the inauguration date attribute.
     *
     * @param  string  $value
     * @return void
     */
    public function setInaugurationDateAttribute($value)
    {
        $this->attributes['inauguration_date'] = date('Y-m-d', strtotime($value));
    }

    /**
     * Get the formatted inauguration date attribute.
     *
     * @param  string  $value
     * @return string
     */
    public function getInaugurationDateAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }
}