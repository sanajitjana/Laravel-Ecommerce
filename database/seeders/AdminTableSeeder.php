<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'id' => 1,
            'name' => 'Master Admin',
            'phone' => '0123456789',
            'email' => 'admin@gmail.com',
            'admin_role_id' => 1,
            'image' => 'def.png',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(60),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
