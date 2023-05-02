<?php

namespace App\Http\Controllers\Entities;


use App\Models\Entities\Investor;

class InvestorController extends EntityController
{
    protected function getModel(): string
    {
        return Investor::class;
    }
}
