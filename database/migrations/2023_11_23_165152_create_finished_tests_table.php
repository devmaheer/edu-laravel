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
        Schema::create('finished_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id')->nullable();
            $table->string('fill_score')->nullable();
            $table->string('mcqs_score')->nullable();
            $table->string('five_choice_score')->nullable();
            $table->string('total_score')->nullable();
            $table->json('test')->nullable();
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('finished_tests');
    }
};
