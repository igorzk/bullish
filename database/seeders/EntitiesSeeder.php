<?php

namespace Database\Seeders;

use App\Models\Entities\Custodian;
use App\Models\Entities\Investor;
use App\Models\Entities\Portfolio;
use Illuminate\Database\Seeder;

class EntitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Custodian::factory(1)->create();
        Investor::factory(1)->create();
        Portfolio::factory(1)->create();

    }
}
