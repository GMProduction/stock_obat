<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'date',
        'batch_id',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function medicine_outs()
    {
        return $this->hasMany(MedicineOut::class, 'transaction_out_id');
    }

    public function getTotalAttribute()
    {
        $medicine_outs = $this->medicine_outs()->get();
        return $medicine_outs->sum('total');
    }
}
