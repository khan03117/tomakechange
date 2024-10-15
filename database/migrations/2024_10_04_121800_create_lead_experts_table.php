<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_experts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expert_id');
            $table->unsignedBigInteger('lead_id');
            $table->double('amount');
            $table->enum('payment_confirm', ["0", "1"])->default("0");
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
        Schema::dropIfExists('lead_experts');
    }
};