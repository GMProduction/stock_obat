<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'medicine_id',
        'qty',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
