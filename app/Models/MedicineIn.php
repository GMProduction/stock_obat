<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'unit_id',
        'expired_date',
        'qty',
        'price',
        'total',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
