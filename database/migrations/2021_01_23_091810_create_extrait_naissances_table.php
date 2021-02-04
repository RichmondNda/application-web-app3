<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraitNaissancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('extrait_naissances', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->string("date_naissance");
            $table->string("heure_naissance");
            $table->string("lieu_naissance");
            $table->string("nom_pere");
            $table->string("prenom_pere");
            $table->string("nom_mere");
            $table->string("prenom_mere");
            $table->string("code_Generer");
            $table->string("num_tel_pere");
            $table->string("num_tel_mere");
            $table->string("num_cni_pere");
            $table->string("num_cni_mere");
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
        Schema::connection('mysql')->dropIfExists('extrait_naissances');
    }
}
