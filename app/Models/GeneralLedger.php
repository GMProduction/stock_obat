<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'medicine_in_id',
        'qty',
        'type',
        'description'
    ];

    public function medicine_in()
    {
        return $this->belongsTo(MedicineIn::class, 'medicine_in_id');
    }
}
