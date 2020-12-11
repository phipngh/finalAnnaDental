<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToMedicines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicines', function (Blueprint $table) {
            $table->softDeletes(); 
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->softDeletes(); 
        });
        Schema::table('patients', function (Blueprint $table) {
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
        Schema::table('medicines', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
