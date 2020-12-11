<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToPrescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->softDeletes(); 
        });
        Schema::table('prescription_details', function (Blueprint $table) {
            $table->softDeletes(); 
        });
        Schema::table('processes', function (Blueprint $table) {
            $table->softDeletes(); 
        });
        Schema::table('installment_plans', function (Blueprint $table) {
            $table->softDeletes(); 
        });
        Schema::table('case_record_details', function (Blueprint $table) {
            $table->softDeletes(); 
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('prescription_details', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('processes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('installment_plans', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('case_record_details', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
