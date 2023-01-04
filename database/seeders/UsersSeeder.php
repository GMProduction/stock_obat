<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
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
                'username' => 'pimpinan',
                'password' => Hash::make('pimpinan'),
                'role' => 'pimpinan'
            ],[
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ]
        ];

        foreach ($data as $value) {
            User::create([
                'username' => $value['username'],
                'password' => $value['password'],
                'role' => $value['role'],
            ]);
        }
    }
}
