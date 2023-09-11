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
        Schema::create('case_records', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid');
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->unsignedBigInteger('businessunit_id')->nullable();
            $table->unsignedBigInteger('duty_doctor_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->enum('status', ['open', 'inprogress', 'completed', 'rejected'])->default('open');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('businessunit_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('duty_doctor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_records');
    }
};
