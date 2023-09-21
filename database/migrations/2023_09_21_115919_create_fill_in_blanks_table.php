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
            $table->longText('fill_1'); 
            $table->longText('ans_1'); 
            $table->longText('fill_2'); 
            $table->longText('ans_2'); 
            $table->longText('fill_3'); 
            $table->longText('ans_3'); 
            $table->longText('fill_4'); 
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
