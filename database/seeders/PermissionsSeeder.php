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
            ['name' => 'can_view_files'],
            ['name' => 'can_view_investors'],
            ['name' => 'can_create_entity'],
            ['name' => 'can_create_event'],
            ['name' => 'can_create_account'],
            ['name' => 'can_update_portfolios'],
            ['name' => 'can_see_portfolio_results'],
        ]);
        //
    }
}
