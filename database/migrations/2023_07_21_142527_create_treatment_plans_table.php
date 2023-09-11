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
        Schema::create('treatment_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id')->nullable();
            $table->unsignedBigInteger('treatmentcategory_id')->nullable();
            $table->unsignedBigInteger('treatmentservice_id')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('discount')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('case_id')->references('id')->on('case_records')->onDelete('set null');
            $table->foreign('treatmentcategory_id')->references('id')->on('treatment_categories')->onDelete('set null');
            $table->foreign('treatmentservice_id')->references('id')->on('treatment_services')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment_plans');
    }
};
