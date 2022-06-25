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
        Schema::create('goldbars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('safe_id')->constrained();
            $table->foreignId('safetype_id')->constrained();
            $table->foreignId('weight_id')->constrained();
            $table->string('SerialNumber');
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
        Schema::dropIfExists('goldbars');
    }
};
