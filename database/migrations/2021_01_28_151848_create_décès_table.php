<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDécèsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_hopitale')->create('décès', function (Blueprint $table) {
            $table->id();
            $table->string('nom_parent');
            $table->string('prenom_parent');
            $table->string('email_parent');
            $table->string('email_confirmateur');
            $table->string('nom_du_mort');
            $table->string('prenom_du_mort');
            $table->string('sexe_mort');
            $table->string('heure_deces');
            $table->string('cause_deces');
            $table->string('ville_deces');
            $table->string('medecin_responsable');
            $table->string('Code_Generer');
            $table->string('Hopital_décés');
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
        Schema::connection('mysql_hopitale')->dropIfExists('décès');
    }
}
