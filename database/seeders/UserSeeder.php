<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name' => 'Arga',
                'email' => 'anggota@gmail.com',
                'role' => 'anggota',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Raden',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123456')
            ], [
                'name' => 'Silpi',
                'email' => 'ketua@gmail.com',
                'role' => 'ketua',
                'password' => bcrypt('123456')
            ],
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
