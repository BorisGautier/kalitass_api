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
        Schema::create('geolocalisations', function (Blueprint $table) {
            $table->id();
            $table->integer("idUser");
            $table->string("roleUser");
            $table->string("nom");
            $table->string("pays");
            $table->string("adresse");
            $table->string("longitude");
            $table->string("latitude");
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
        Schema::dropIfExists('geolocalisations');
    }
};
