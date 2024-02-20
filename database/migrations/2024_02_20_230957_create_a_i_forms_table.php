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
            $table->string('Fo');
            $table->string('Fio');
            $table->string('Fhi');
            $table->string('Jitter');
            $table->string('Rap');
            $table->string('Ppq');
            $table->string('Shimmer');
            $table->string('Dpq');
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
