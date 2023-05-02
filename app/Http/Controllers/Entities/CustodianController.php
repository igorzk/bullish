<?php

namespace App\Http\Controllers\Entities;

use App\Models\Entities\Custodian;

class CustodianController extends EntityController
{
    protected function getModel(): string
    {
        return Custodian::class;
    }
}
