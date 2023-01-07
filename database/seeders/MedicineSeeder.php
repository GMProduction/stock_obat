<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_id' => 1,
                'unit_id' => 3,
                'name' => 'Acetylsistein kapsul 200 mg',
                'qty' => 0,
                'limit' => 0
            ],
            [
                'category_id' => 1,
                'unit_id' => 5,
                'name' => 'Acyclovir tablet 200 mg',
                'qty' => 0,
                'limit' => 0
            ],
            [
                'category_id' => 1,
                'unit_id' => 5,
                'name' => 'Acyclovir tablet 400 mg',
                'qty' => 0,
                'limit' => 0
            ],
            [
                'category_id' => 1,
                'unit_id' => 4,
                'name' => 'Albendazol sirup 200 mg/ 5 ml',
                'qty' => 0,
                'limit' => 0
            ],
            [
                'category_id' => 1,
                'unit_id' => 5,
                'name' => 'Albendazole tablet 400 mg',
                'qty' => 0,
                'limit' => 0
            ],
        ];

        foreach ($data as $value) {
            Medicine::create([
                'category_id' => $value['category_id'],
                'unit_id' => $value['unit_id'],
                'name' => $value['name'],
                'qty' => $value['qty'],
                'limit' => $value['limit'],
            ]);
        }
    }
}
