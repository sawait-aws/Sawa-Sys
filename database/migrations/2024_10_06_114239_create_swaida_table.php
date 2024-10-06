<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwaidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swaida', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name_of_client');
            $table->string('submarket')->nullable();
            $table->string('country')->nullable();
            $table->decimal('total_amount', 20, 2);
            $table->decimal('delivery_cost', 20, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('market_name_app')->nullable();
            $table->string('market_name_order')->nullable();
            $table->decimal('cost_in_syp', 20, 2)->nullable();
            $table->decimal('delivery_cost_syp', 20, 2)->nullable();
            $table->string('delivery_area')->nullable();
            $table->string('category')->nullable();
            $table->integer('amount')->nullable();
            $table->text('notes')->nullable();
            $table->string('client_type')->nullable();
            $table->string('source')->nullable();
            $table->string('employee')->nullable();
            $table->boolean('pre_order')->default(false);
            $table->date('delivery_date')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
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
        Schema::dropIfExists('swaida');
    }
}
