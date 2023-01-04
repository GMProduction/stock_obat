<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Pcs',
            'Box',
            'Kapsul',
            'Botol',
            'Tablet',
            'Vial',
            'Roll',
            'Sachet',
        ];

        foreach ($data as $value) {
            Unit::create([
                'name' => $value
            ]);
        }
    }
}
