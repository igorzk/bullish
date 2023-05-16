<?php

namespace App\Models\Events;

trait HasEventAttributes
{
    public function initializeHasEventAttributes()
    {
        $this->fillable = [
            ...$this->fillable,
            'transaction_date',
            'settlement_date',
            'type',
            'body'
        ];

        $this->casts = [
            ...$this->casts,
            'body' => 'array',
        ];
    }
}
