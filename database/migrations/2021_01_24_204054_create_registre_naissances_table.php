<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistreNaissancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql_mairie')->create('registre_naissances', function (Blueprint $table) {
            $table->id();
            $table->string('numero_acte');
            $table->string('date_numero_acte');
            $table->string('nom');
            $table->string('prenoms');
            $table->string('date_naissance');
            $table->string('heure_de_naissance');
            $table->string('lieu_naissance');
            $table->string('nom_pere');
            $table->string('prenom_pere');
            $table->string('nom_mere');
            $table->string('prenom_mere');
            $table->string('date_mariage')->nullable();
            $table->string('lieu_mariage')->nullable();
            $table->string('nom_conjoint')->nullable();
            $table->string('prenom_conjoint')->nullable();
            $table->string('date_divorce')->nullable();
            $table->string('date_deces')->nullable();
            $table->string('lieu_deces')->nullable();
            $table->string('lieu_delivrance')->nullable();
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
        Schema::connection('mysql_mairie')->dropIfExists('registre_naissances');
    }
}
