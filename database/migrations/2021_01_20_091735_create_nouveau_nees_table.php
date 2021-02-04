<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNouveauNeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_hopitale')->create('nouveau_nees', function (Blueprint $table) {
            $table->id();
            $table->string('nom_parent');
            $table->string('prenom_parent');
            $table->string('sexe_enfant');
            $table->string('Hopital_naissance')->nullable();
            $table->string('Code_Generer');
            $table->string('email_parent');
            $table->string('nom_medecin');
            $table->string('nom_sage_femme');
            $table->string('heure_naissance');
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
        Schema::connection('mysql_hopitale')->dropIfExists('nouveau_nees');
    }
}
