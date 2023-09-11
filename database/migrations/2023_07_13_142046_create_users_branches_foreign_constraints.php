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
        // Foreign Key Constraints
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('businessunit_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('businessunit_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop Foreign Key Constraints
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['partner_id', 'businessunit_id', 'branch_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['partner_id', 'businessunit_id', 'city_id', 'country_id']);
        });
    }
};
