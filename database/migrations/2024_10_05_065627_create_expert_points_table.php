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
        Schema::create('expert_points', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('expert_id');
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->double('amount');
            $table->double('points');
            $table->enum('type', ['Credit', 'Debit']);
            $table->enum('is_confirm', ['0', '1'])->default("0");
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
        Schema::dropIfExists('expert_points');
    }
};
