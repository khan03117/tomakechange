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
        Schema::create('conven_fees', function (Blueprint $table) {
            $table->id();
            $table->time('duration');
            $table->enum('mode', ['video', 'audio']);
            $table->double('rate');
            $table->double('fixed_fee');
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
        Schema::dropIfExists('conven_fees');
    }
};
