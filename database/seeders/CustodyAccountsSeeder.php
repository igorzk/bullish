<?php

namespace Database\Seeders;

use App\Models\Accounts\CustodyAccount;
use App\Models\Entities\Custodian;
use App\Models\Entities\Investor;
use App\Models\Entities\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustodyAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAccounts(2);
        for ($i = 0; $i <= 5; $i++) {
            $this->createAccounts(1);
        }
    }

    private function createAccounts($number)
    {
        $investor = Investor::factory()->create();
        $portfolio = Portfolio::factory()->create();
        $custodian = Custodian::factory()->create();

        CustodyAccount::factory($number)->for($investor)->for($portfolio)->for($custodian)->create();
    }
}
