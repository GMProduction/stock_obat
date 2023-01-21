<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Medicine;
use App\Models\MedicineIn;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class MedicineRepository extends BaseRepo
{

    public function validation()
    {
        request()->validate(
            [
                'name'        => 'required',
                'category_id' => 'required',
                'unit_id'     => 'required',
                'limit'       => 'required',
            ],
            [
                'name.required'        => 'Nama obat harus di isi',
                'category_id.required' => 'Kategori obat harus di isi',
                'unit_id.required'     => 'Satuan obat harus di isi',
                'limit.required'       => 'Limit obat harus di isi',
            ]
        );
    }

    public function fieldData()
    {
        $formData = request()->all();
        $category = Category::where('id', '=', $this->postField('category_id'))->orWhere('name', '=', $this->postField('category_id'))->first();
        if ($category == null) {
            $category = new Category();
            $category = $category->create(
                [
                    'name' => request('category_id'),
                ]
            );
            Arr::set($formData, 'category_id', $category->id);
        }

        $unit = Unit::where('id', '=', request('unit_id'))->orWhere('name', '=', request('unit_id'))->first();
        if ($unit == null) {
            $unit = new Unit();
            $unit = $unit->create(
                [
                    'name' => request('unit_id'),
                ]
            );
            Arr::set($formData, 'unit_id', $unit->id);
        }

        return $formData;
    }

    public function patchForm()
    {
        return $this->patchData(Medicine::class);
    }

    public function showDatatable()
    {
        $data             = Medicine::with(['category:id,name', 'unit:id,name']);
        $this->selectData = ['name', 'unit_id', 'limit', 'category_id'];
        $this->button     = ['edit', 'delete'];

        return $this->datatabe($data);

    }

    public function showDatatableStock()
    {

        $this->button = ['tambahStok'];

        return $this->datatabe(Medicine::query());
    }

    public function showDatatableStockDetail()
    {
        $data         = MedicineIn::with(['transaction_in.budget_source','unit'])->where('medicine_id', request('id'));

        $this->addColumn = [
            [
                'name' => 'lokasi',
                'string_value' => "Gudang"
            ]
        ];

//        $this->button = ['detail'];

        return $this->datatabe($data);
    }

    public function showDatatableStockExpired()
    {
        $data = Medicine::with('medicine_ins_expired')
                        ->get()
                        ->append('is_expired');

        $sort  = $data->sortBy('is_expired', SORT_REGULAR, false);
        $value = $sort->values()->all();



        $this->button = ['detail'];

        return $this->datatabe($value);
    }

    public function detail(){
        $id       = $this->data->id;
        return '<a href="'.route('stockbarang',['id' => $id]).'" target="_blank" id="detailData" data-id="'.$id.'"
                                    class="text-xs bg-secondary rounded-full text-white px-3 py-2">Detail</a></td>';
    }

    public function tambahStok()
    {
        $id = $this->data->id;

        return '<a href="'.route('stockbarang', ['id' => $id]).'"
                                    class="text-xs bg-secondary rounded-full text-white px-3 py-2">Tambah Stock</a></td>';
    }

    public function findAll($preload = [])
    {
        return Medicine::with($preload)->get();
    }

    public function findById($id, $preload = [])
    {
        return Medicine::with($preload)->find($id);
    }

    public function addStock($medicine_id, $addedStock = 0)
    {
        /** @var Medicine $medicine */
        $medicine = Medicine::find($medicine_id);
        $qty      = $medicine->qty;
        $new_qty  = $addedStock + $qty;

        return $medicine->update(
            [
                'qty' => $new_qty,
            ]
        );
    }

    public function reduceStock($medicine_id, $minusStock = 0)
    {
        /** @var Medicine $medicine */
        $medicine = Medicine::find($medicine_id);
        $qty      = $medicine->qty;
        $new_qty  = $qty - $minusStock;

        return $medicine->update(
            [
                'qty' => $new_qty,
            ]
        );
    }

    public function stock($medicine_id)
    {
        /** @var Medicine $medicine */
        $medicine = Medicine::find($medicine_id);

        return $medicine->qty;
    }

    public function real_stock($medicine_id)
    {
        return Medicine::realStock()
                       ->find($medicine_id);
    }

}
