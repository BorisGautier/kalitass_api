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
        Schema::create('recommandations', function (Blueprint $table) {
            $table->id();
            $table->integer("idUser");
            $table->string("roleUser");
            $table->string("nom");
            $table->text("contenu");
            $table->date("dateDebut");
            $table->date("dateFin");
            $table->string("roles");
            $table->string("status")->default("valide");
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
        Schema::dropIfExists('recommandations');
    }
};
