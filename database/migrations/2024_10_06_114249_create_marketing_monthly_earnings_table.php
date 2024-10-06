<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingMonthlyEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_monthly_earnings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('market');
            $table->string('category')->nullable();
            $table->string('publishing_from')->nullable();
            $table->string('shop')->nullable();
            $table->string('ad_kind')->nullable();
            $table->decimal('amount', 20, 2);
            $table->decimal('value', 20, 2)->nullable();
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
        Schema::dropIfExists('marketing_monthly_earnings');
    }
}
