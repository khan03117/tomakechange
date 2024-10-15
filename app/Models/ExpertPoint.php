<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExpertPoint extends Model
{
    use HasFactory;
    public static function getBalancePoints()
    {
        // Get the authenticated expert's ID
        $expertId = auth()->user()->uid;

        // Get the total credit points
        $totalCredit = self::where('expert_id', $expertId)
            ->where('type', 'Credit')->where('is_confirm', '1')
            ->sum('points');

        // Get the total debit points
        $totalDebit = self::where('expert_id', $expertId)
            ->where('type', 'Debit')->where('is_confirm', '1')
            ->sum('points');

        // Calculate the remaining balance
        $remainingBalance = $totalCredit - $totalDebit;

        // Return the result as an array
        return [
            'total_credit' => $totalCredit,
            'total_debit' => $totalDebit,
            'balance' => $remainingBalance,
        ];
    }
}
