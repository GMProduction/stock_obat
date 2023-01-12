<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_out_id',
        'medicine_id',
        'unit_id',
        'qty',
        'price',
        'total'
    ];

    public function transaction_out()
    {
        return $this->belongsTo(TransactionOut::class, 'transaction_out_id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
