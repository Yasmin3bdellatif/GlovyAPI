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
        Schema::create('a_i_forms', function (Blueprint $table) {
            $table->id();
            $table->string('Fo')->nullable();
            $table->string('Fio')->nullable();
            $table->string('Fhi')->nullable();
            $table->string('Jitter')->nullable();
            $table->string('Rap')->nullable();
            $table->string('Ppq')->nullable();
            $table->string('Shimmer')->nullable();
            $table->string('Dpq')->nullable();
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
        Schema::dropIfExists('a_i_forms');
    }
};
