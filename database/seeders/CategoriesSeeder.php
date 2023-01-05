<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'OBAT ORAL',
            'ANTIBIOTIK',
            'NPP, OOT, PREKURSOR',
            'PROGRAM HIV',
            'SEDIAAN INJEKSI / CAIRAN / SERUM',
            'OBAT LUAR',
            'BAHAN MEDIS HABIS PAKAI',
            'LAIN LAIN',
        ];

        foreach ($data as $value) {
            Category::create([
                'name' => $value
            ]);
        }
    }
}
