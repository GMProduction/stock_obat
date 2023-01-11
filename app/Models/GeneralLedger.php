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
        'medicine_out_id',
        'transaction_in_id',
        'transaction_out_id',
        'qty',
        'type',
        'description'
    ];

    public function medicine_in()
    {
        return $this->belongsTo(MedicineIn::class, 'medicine_in_id');
    }

    public function medicine_out()
    {
        return $this->belongsTo(MedicineOut::class, 'medicine_out_id');
    }

    public function transaction_in()
    {
        return $this->belongsTo(TransactionIn::class, 'transaction_in_id');
    }

    public function transaction_out()
    {
        return $this->belongsTo(TransactionOut::class, 'transaction_out_id');
    }
}
