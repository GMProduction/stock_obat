<?php

namespace Database\Seeders;

use App\Models\BudgetSource;
use Illuminate\Database\Seeder;

class BudgetSourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'IFK',
            'BLUD',
            'BOK',
            'APBD',
            'APBN',
            'BTN',
        ];

        foreach ($data as $value) {
            BudgetSource::create([
                'name' => $value
            ]);
        }
    }
}
