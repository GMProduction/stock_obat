<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'unit_id',
        'name',
        'qty',
        'limit',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function medicine_ins()
    {
        return $this->hasMany(MedicineIn::class, 'medicine_id');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeRealStock($query)
    {

        return $query->with(['medicine_ins' => function ($q) {
            return $q->whereRaw('(qty - used) > ?', [0])
                ->orderBy('expired_date', 'ASC');
        }]);
    }

    public function stock()
    {
        return $this->hasOne(LocationStock::class, 'medicine_id');
    }

    public function stocks()
    {
        return $this->hasMany(LocationStock::class, 'medicine_id');
    }
}
