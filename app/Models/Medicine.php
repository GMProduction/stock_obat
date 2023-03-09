<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function medicine_ins_expired()
    {
        return $this->hasOne(MedicineIn::class, 'medicine_id')->orderBy('expired_date', 'ASC');
    }

    public function medicine_ins_expired_all()
    {
        return $this->hasMany(MedicineIn::class, 'medicine_id')->orderBy('expired_date', 'ASC');
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeRealStock($query)
    {

        return $query->with(
            [
                'medicine_ins' => function ($q) {
                    return $q->whereRaw('(qty - used) > ?', [0])
                        ->orderBy('expired_date', 'ASC');
                },
            ]
        );
    }

    public function scopeExpired($query)
    {
        return $query->with(
            [
                'medicine_ins' => function ($q) {
                    return $q->orderBy('expired_date', 'ASC');
                },
            ]
        );
    }


    public function getIsExpiredAttribute()
    {
        if ($this->medicine_ins_expired) {
            $now = new \DateTime();
            $expired = date_create($this->medicine_ins_expired->expired_date);
            $diff = date_diff($now, $expired);
            if ($diff->format('%R') == '+') {
//                return $diff->format("%m");
                return ($diff->invert ? -1 : 1) * ($diff->m + (12 * $diff->y));
            }
            return $diff->format("0");
        }
        return '+0';

    }

//    public function setExpiredDate($data){
//        if ($data->medicine_ins[0]){
//            $now = new \DateTime();
//            $expired = date_create($data->medicine_ins[0]->expired_date);
//            $diff    = date_diff($now, $expired);
//            dump($data->medicine_ins[0]);
//            return $diff->format("%R%m");
//        }
//        return '';
//    }

//    public function stock()
//    {
//        return $this->hasOne(LocationStock::class, 'medicine_id');
//    }

    public function stocks()
    {
//        return $this->hasMany(LocationStock::class, 'medicine_id');
        return $this->hasMany(MedicineStock::class, 'medicine_id')->orderBy('expired_date', 'ASC');
    }

    public function getStockAttribute()
    {
        return $this->stocks()->get()->sum('qty');
    }

    public function getExpirationAttribute()
    {
        $stocks = $this->stocks()->get();
        if (count($stocks) > 0) {
            $first = $stocks[0];
            $now = Carbon::now();
            $expired = date_create($first->expired_date);
            $interval = $now->diff($expired);
            if ($interval->format('%R') == '+') {
                $diff = $interval->format("%m");
                return ($interval->invert ? -1 : 1) * ($interval->m + (12 * $interval->y));
            } else {
                return 0;
            }
        }
        return 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicine_stock(){
        return $this->hasMany(MedicineStock::class,'medicine_id');
    }
}
