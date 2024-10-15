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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable();
            $table->integer('expert_id');
            $table->string('name', 100);
            $table->string('email');
            $table->string('mobile', 12);
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('pincode', 6)->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->integer('expert_fee_id');
            $table->string('mode', 50)->default('Online Video');
            $table->date('apt_date');
            $table->date('slot_id');
            $table->integer('quantity');


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
        Schema::dropIfExists('carts');
    }
};
