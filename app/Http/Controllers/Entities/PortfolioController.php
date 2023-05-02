<?php

namespace App\Http\Controllers\Entities;



use App\Models\Entities\Portfolio;

class PortfolioController extends EntityController
{
    protected function getModel(): string
    {
        return Portfolio::class;
    }
}
