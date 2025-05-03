<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['role_name' => 'admin'],
            ['role_name' => 'guest'],
            ['role_name' => 'user'],
        ];

        DB::table('roles')->insert($roles);
    }
}
