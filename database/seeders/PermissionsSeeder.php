<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::factory()->createMany([
            ['name' => 'admin'],
            ['name' => 'pode_ver_arquivos'],
            ['name' => 'pode_ver_investidores'],
            ['name' => 'pode_criar_entidades'],
            ['name' => 'pode_criar_eventos'],
            ['name' => 'pode_criar_contas'],
        ]);
        //
    }
}
