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
        Schema::create('find_experts', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('sub_cats');
            $table->integer('end_cats');
            $table->integer('state');
            $table->integer('city');
            $table->string('pincode', 6);
            $table->string('contact_mode', 20);
            $table->string('languages', 100);
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
        Schema::dropIfExists('find_experts');
    }
};
