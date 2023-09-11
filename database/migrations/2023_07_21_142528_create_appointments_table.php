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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->unsignedBigInteger('businessunit_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('caserecord_id')->nullable();
            $table->unsignedBigInteger('chair_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->uuid('uid');
            $table->enum('status', ['booked', 'rescheduled', 'cancelled', 'confirmed', 'arrived', 'completed'])->default('booked');
            $table->datetime('date_time');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('businessunit_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
            $table->foreign('caserecord_id')->references('id')->on('case_records')->onDelete('set null');
            $table->foreign('chair_id')->references('id')->on('chairs')->onDelete('set null');            
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
