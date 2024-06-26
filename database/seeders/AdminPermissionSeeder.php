<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Permission::create([ "name" => "Roles and permissions management" ]);
      Permission::create([ "name" => "Booking management" ]);
      Permission::create([ "name" => "Services and rooms management" ]);
    }
}
