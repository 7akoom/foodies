<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    
    public function run(): void
    {
        $obj = new Admin();
        $obj->name = 'Hkmt Ali';
        $obj->email = 'a7akoom96@gmail.com';
        $obj->password = '123';
        $obj->save();
    }
}
