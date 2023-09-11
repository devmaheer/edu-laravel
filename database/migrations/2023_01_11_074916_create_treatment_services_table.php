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
        Schema::create('treatment_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('clinical_specialization_id')->nullable();
            $table->uuid('uid');
            $table->string('name');
            $table->unsignedInteger('cost');
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('category_id')->references('id')->on('treatment_categories')->onDelete('set null');
            $table->foreign('clinical_specialization_id')->references('id')->on('clinical_specializations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment_services');
    }
};
