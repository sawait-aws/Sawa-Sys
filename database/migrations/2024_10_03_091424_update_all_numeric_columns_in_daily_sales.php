<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAllNumericColumnsInDailySales extends Migration
{
    public function up()
    {
        Schema::table('daily_sales', function (Blueprint $table) {
            // Update all numeric columns to have larger precision and scale
            $table->decimal('total_amount', 20, 2)->change();  // Allow very large total amounts
            $table->decimal('delivery_cost', 20, 2)->change(); // Allow larger delivery costs
            $table->decimal('amount_in_syp', 20, 2)->change(); // Allow larger amounts in SYP
            $table->decimal('delivery_cost_syp', 20, 2)->change(); // Allow larger delivery cost in SYP
            $table->decimal('commission_quantity', 20, 2)->change(); // Large commission quantities
            $table->decimal('delivery_quantity', 20, 2)->change(); // Large delivery quantities
            $table->decimal('rate', 20, 2)->change(); // Update rate even though it may not need large values
            
            // If there are any other numeric columns that you might have, ensure they are updated as well.
            // Here’s an example in case you have other numeric columns:
           
        });
    }

    public function down()
    {
        Schema::table('daily_sales', function (Blueprint $table) {
            // Revert changes back to the previous state
            $table->decimal('total_amount', 10, 2)->change(); // Back to original precision and scale
            $table->decimal('delivery_cost', 10, 2)->change();
            $table->decimal('amount_in_syp', 15, 2)->change();
            $table->decimal('delivery_cost_syp', 15, 2)->change();
            $table->decimal('commission_quantity', 10, 2)->change();
            $table->decimal('delivery_quantity', 10, 2)->change();
            $table->decimal('rate', 5, 2)->change(); // Reverting back to original precision and scale
            
            // Revert any other numeric columns here
           });
    }
}
