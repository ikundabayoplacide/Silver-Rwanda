<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $admin = User::create([
            'name' => 'IKUNDABAYO Placide', 
            'email' => 'placide@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'Kigali',
            'phone' => '0789897235',
            'role' => 'admin',
            'gender'=>'male'
        ]);
        $admin->assignRole('Admin');

        // Creating Admin User
        $cooperativeManager = User::create([
            'name' => 'MUVUNYI Patrick', 
            'email' => 'muvunyi@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'RUHANGO',
            'phone' => '078163204',
            'role' => 'cooperative_manager',
            'gender'=>'male'
        ]);
        $cooperativeManager->assignRole('cooperative_manager');

        // Creating device Manager User
        $sedo = User::create([
            'name' => 'IRATUZI', 
            'email' => 'anitha@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'Rurindo',
            'phone' => '4225262626272',
            'role' => 'sedo',
            'gender'=> 'female'
        ]);
        $sedo->assignRole('sedo');
    }
}
