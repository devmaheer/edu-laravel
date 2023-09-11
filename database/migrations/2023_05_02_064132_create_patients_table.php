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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->unsignedBigInteger('businessunit_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->uuid('uid');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('blood_group');
            $table->string('contact_no');
            $table->string('email')->unique();
            $table->text('address');
            $table->string('state');
            $table->string('country');
            $table->string('pin_code');
            $table->string('patient_group');
            $table->string('referral');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('businessunit_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
