<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_sales', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->nullable();
            $table->date('date');
            $table->string('client_name');
            $table->string('market');
            $table->string('submarket')->nullable();
            $table->string('client_country')->nullable();
            $table->decimal('total_amount', 20, 2);
            $table->decimal('delivery_cost', 20, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('store_name_app')->nullable();
            $table->string('store_request')->nullable();
            $table->decimal('amount_in_syp', 20, 2)->nullable();
            $table->decimal('delivery_cost_syp', 20, 2)->nullable();
            $table->string('delivery_area')->nullable();
            $table->string('category')->nullable();
            $table->string('item_quantity')->nullable();
            $table->decimal('rate', 20, 2)->nullable();
            $table->string('client_request_method')->nullable();
            $table->integer('commission_quantity')->nullable();
            $table->integer('delivery_quantity')->nullable();
            $table->boolean('best_seller')->default(false);
            $table->string('product')->nullable();
            $table->string('client_type')->nullable();
            $table->string('discovery_method')->nullable();
            $table->string('employee_name')->nullable();
            $table->boolean('pre_order')->default(false);
            $table->datetime('delivery_date')->nullable();
            $table->string('client_phone')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_sales');
    }
}
