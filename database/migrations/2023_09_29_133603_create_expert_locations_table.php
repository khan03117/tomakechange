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
        Schema::create('expert_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('expert_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('address');
            $table->string('pincode', 6);
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
        Schema::dropIfExists('expert_locations');
    }
};
