<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySales extends Model
{
    use HasFactory;

    protected $table = 'daily_sales';

    protected $fillable = [
        'request_id',
        'date',
        'client_name',
        'market',
        'submarket',
        'client_country',
        'total_amount',
        'delivery_cost',
        'payment_method',
        'store_name_app',
        'store_request',
        'amount_in_syp',
        'delivery_cost_syp',
        'delivery_area',
        'category',
        'item_quantity',
        'rate',
        'client_request_method',
        'commission_quantity',
        'delivery_quantity',
        'best_seller',
        'product',
        'client_type',
        'discovery_method',
        'employee_name',
        'pre_order',
        'delivery_date',
        'client_phone',
        'notes'
    ];
}