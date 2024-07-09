<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   Role::create(['name'=>'admin']);
        Role::create(['name' => 'rab']);
        Role::create(['name' => 'sedo']);
        Role::create(['name'=> 'naeb']);
        
        Role::create(['name'=> 'cooperative_manager']);
        Role::create(['name' => 'sector_agronome']);
        Role::create(['name'=> 'district_agronome']);
        Role::create(['name'=> 'self-farmer']);
    }
}
