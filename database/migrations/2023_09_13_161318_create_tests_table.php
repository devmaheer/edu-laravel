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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->text('name'); 
       
            $table->integer('type'); 
            $table->integer('category'); 
            $table->integer('status'); 
            $table->string('audio')->nullable(); 
            $table->longText('paragraph1')->nullable(); 
            $table->longText('paragraph2')->nullable(); 
            $table->longText('paragraph3')->nullable(); 
            $table->longText('paragraph4')->nullable(); 
            $table->longText('paragraph5')->nullable(); 
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
        Schema::dropIfExists('tests');
    }
};
