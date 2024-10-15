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
        Schema::create('join_requests', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 200);
            $table->string('mobile', 14);
            $table->integer('state');
            $table->string('city', 100);
            $table->string('qualification', 100);
            $table->enum('apply_for', ['Counsellor', 'Coach']);
            $table->string('resume');
            $table->string('profile_img');
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
        Schema::dropIfExists('join_requests');
    }
};
