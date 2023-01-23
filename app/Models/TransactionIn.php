<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'budget_source_id',
        'date',
        'batch_id',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function budget_source()
    {
        return $this->belongsTo(BudgetSource::class, 'budget_source_id');
    }

    public function medicine_ins()
    {
        return $this->hasMany(MedicineIn::class, 'transaction_in_id');
    }

    public function getTotalAttribute()
    {
        $medicine_ins = $this->medicine_ins()->get();
        return $medicine_ins->sum('total');
    }
}
