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
        Schema::create('fill_in_blanks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id');
            $table->longText('fill_1')->nullable();
            $table->longText('ans_first_1')->nullable();
            $table->longText('ans_first_2')->nullable();
            $table->longText('ans_first_3')->nullable();
            $table->longText('fill_2')->nullable();
            $table->longText('ans_sec_1')->nullable();
            $table->longText('ans_sec_2')->nullable();
            $table->longText('ans_sec_3')->nullable();
            $table->longText('fill_3')->nullable();
            $table->longText('ans_third_1')->nullable();
            $table->longText('ans_third_2')->nullable();
            $table->longText('ans_third_3')->nullable();
            $table->longText('fill_4')->nullable();
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
        Schema::dropIfExists('fill_in_blanks');
    }
};
