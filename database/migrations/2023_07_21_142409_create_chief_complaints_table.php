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
        Schema::create('chief_complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('tooth_id')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('case_id')->references('id')->on('case_records')->onDelete('set null');
            $table->foreign('type_id')->references('id')->on('complaint_types')->onDelete('set null');
            $table->foreign('tooth_id')->references('id')->on('teeth')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chief_complaints');
    }
};
