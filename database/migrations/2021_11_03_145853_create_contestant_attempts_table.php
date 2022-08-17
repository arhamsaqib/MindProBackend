<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestantAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contestant_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('cid')->nullable();
            $table->string('word_id')->nullable();
            $table->string('time_taken')->nullable();
            $table->string('score')->nullable();
            $table->string('hint1_status')->nullable();
            $table->string('hint2_status')->nullable();
            $table->string('hint3_status')->nullable();
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
        Schema::dropIfExists('contestant_attempts');
    }
}
