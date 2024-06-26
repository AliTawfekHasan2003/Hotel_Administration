<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $user =  User::create([
        "full_name"=>"admin admin",
        "email"=>"adminadmin@gmail.com",
        "password"=>Hash::make("adminadmin333222"),
   ]);

    $user->assignRole("Admin");
    $user->givePermissionTo("Roles and permissions management");
    $user->givePermissionTo("Booking management");
    $user->givePermissionTo("Services and rooms management");
    
    }
}
