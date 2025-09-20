<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name'=>'Ahmadiya Mammadli',
            'email'=>'ahmediyemamadli@gmail.com',
            'password'=>bcrypt(12345),
            'created_at'=>now()

        ]);
    }
}
