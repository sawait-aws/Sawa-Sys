<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swaida extends Model
{
    use HasFactory;

    protected $table = 'swaida';

    protected $fillable = [
        'date',
        'name_of_client',
        'submarket',
        'country',
        'total_amount',
        'delivery_cost',
        'payment_method',
        'market_name_app',
        'market_name_order',
        'cost_in_syp',
        'delivery_cost_syp',
        'delivery_area',
        'category',
        'amount',
        'notes',
        'client_type',
        'source',
        'employee',
        'pre_order',
        'delivery_date',
        'email',
        'phone_number'
    ];
}
