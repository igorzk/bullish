<?php

namespace App\Services\Events;

use App\Models\Events\AccountEvent;

class BovConfirmation
{
    public function getBody(array $input): array
    {
        $body = [
            'net_value' => round($input['net_value'], 2) *
                (($input['credit_debit'] == 'credit') ? 1 : -1),
            'withholding_tax' => round($input['withholding_tax'], 2),
            'fees' => round($input['fees'], 2),
            'transactions' => array_map(fn ($transaction) => [
                'asset_id' => (int)$transaction['asset_id'],
                'type' => $transaction['type'],
                'price' => round($transaction['price'], 2),
                'quantity' => (int)$transaction['quantity'] *
                    (($transaction['purchase_sale'] == 'purchase') ? 1 : -1)
            ], $input['transactions'])
        ];
        return $body;
    }

    public function validate($input): bool | string
    {
        $validation = $this->validateValues($input);
        if (!$validation) {
            return "Valores da nota não estão coerentes";
        }
        $validation = $this->validateDayTrade($input['transactions']);
        if (!$validation) {
            return "Operações de day-trade não estão completas";
        }
        return true;
    }
    private function validateValues($input): bool
    {
        $sumTransactions = array_reduce($input['transactions'],
            fn($sum, $trans) =>
                $sum +
                $trans['quantity'] * $trans['price'] * ($trans['purchase_sale'] == 'purchase' ? -1 : 1));
        return round(($sumTransactions - $input['withholding_tax'] + $input['fees']),2) ==
            round($input['net_value'] * ($input['credit_debit'] == 'credit' ? 1 : -1), 2);
    }

    private function validateDayTrade($transactions)
    {
        $dt = array_filter($transactions, fn($t) => $t['type'] == 'day-trade');
        if (sizeof($dt) == 0) {
            return true;
        }
        $sums = array_reduce($dt, function ($sums, $t) {
            if (!is_array($sums)) {
                $sums = [];
            }
            if (!array_key_exists($t['asset_id'], $sums)) {
                $sums[$t['asset_id']] = 0;
            }
            $sums[$t['asset_id']] = $sums[$t['asset_id']] +
                ($t['quantity'] * (($t['purchase_sale'] == 'purchase') ? 1 : -1));
            return $sums;
        });
        $sum = array_reduce($sums, fn($sum, $val) => $sum + $val);
        return $sum == 0;
    }
}
