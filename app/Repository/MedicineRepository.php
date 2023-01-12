<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Medicine;
use App\Models\Unit;
use Illuminate\Support\Arr;

class MedicineRepository extends BaseRepo
{
    public function __construct()
    {

    }

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
        $category = Category::where('id', '=', request('category_id'))->orWhere('name', '=', request('category_id'))->first();
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
        $data             = Medicine::with(['category:id,name', 'unit:id,name'])->select();
        $this->selectData = ['name', 'unit_id', 'limit', 'category_id'];
        $this->button     = ['edit', 'delete'];

        return $this->datatabe($data);

    }

}
