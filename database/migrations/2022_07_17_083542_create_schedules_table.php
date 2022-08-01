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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('program');
            $table->string('phone');
            $table->string('date');
            $table->string('time')->nullable();
            $table->string('duration')->nullable();
            $table->string('study_level')->nullable();
            $table->text('lesson')->nullable();
            $table->string('teacher');
            $table->text('address')->nullable();
            $table->string('etc')->nullable();
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
        Schema::dropIfExists('schedules');
    }
};
