<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_in_id',
        'medicine_id',
        'unit_id',
        'expired_date',
        'qty',
        'price',
        'total',
        'used',
    ];

    public function transaction_in()
    {
        return $this->belongsTo(TransactionIn::class, 'transaction_in_id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function getRestAttribute()
    {
        return $this->qty - $this->used;
    }

    public function getIsExpiredAttribute(){
        $now = new \DateTime();
        $expired = date_create($this->expired_date);
        $diff=date_diff($now,$expired);
        return $diff->format("%R%m");
    }
}
