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
        //
        Schema::create('monitoring_form', function (Blueprint $table){
           $table->id();
           $table->bigInteger('user_id');
           $table->double('active_energy')->default(0);
           $table->double('basal_energy')->default(0);
           $table->double('blood_glucose')->default(0);
           $table->double('blood_oxygen')->default(0);
           $table->double('blood_diastolic')->default(0);
           $table->double('blood_systolic')->default(0);
           $table->double('body_max_index')->default(0);
           $table->double('body_temperature')->default(0);
           $table->double('heart_rate')->default(0);
           $table->double('height')->default(0);
           $table->double('steps')->default(0);
           $table->double('weight')->default(0);
           $table->double('distance_walking')->default(0);
           $table->double('mindfulness')->default(0);
           $table->double('sleep_in_bed')->default(0);
           $table->double('sleep_as_bed')->default(0);
           $table->double('sleep_awake')->default(0);
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
        //
        Schema::drop('monitoring_form');
    }
};
