<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('cart_id');
            $table->double('base_amount');
            $table->double('conven_fee');
            $table->double('dis_package');
            $table->double('dis_promo');
            $table->double('total_pay')->nullable();
            $table->text('cca_response')->nullable();
            $table->string('cca_status')->nullable();
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
        Schema::dropIfExists('cart_payments');
    }
};
