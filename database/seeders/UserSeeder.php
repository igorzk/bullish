<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Permission::query()
            ->where('name', 'admin')->get();

        User::factory()->hasAttached($role)
            ->create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => hash::make('mudar'),
            'approved' => true
        ]);
    }
}
