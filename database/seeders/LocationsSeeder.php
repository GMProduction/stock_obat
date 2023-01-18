<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'PUSKESMAS KELILING',
            'UGD DAN RUANG JAGA',
            'KOTAK EMERGENCY',
            'RUANG OBAT',
        ];

        foreach ($data as $value) {
            Location::create([
                'name' => $value
            ]);
        }
    }
}
