<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingMonthlyEarning extends Model
{
    use HasFactory;

    protected $table = 'marketing_monthly_earnings';

    protected $fillable = [
        'date',
        'market',
        'category',
        'publishing_from',
        'shop',
        'ad_kind',
        'amount',
        'value',
        'notes',
    ];
}
