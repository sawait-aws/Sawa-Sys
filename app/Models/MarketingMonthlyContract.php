<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingMonthlyContract extends Model
{
    use HasFactory;
    protected $table = 'marketing_monthly_contracts';
    protected $fillable = [
        'date',
        'market',
        'shop',
        'value'
    ];
}
