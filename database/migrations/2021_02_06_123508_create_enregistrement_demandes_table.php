<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnregistrementDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('enregistrement_demandes', function (Blueprint $table) {
            $table->id();
            $table->string('code_qr');
            $table->string('num_acte');
            $table->string('date_acte');
            $table->string('id_user');
            $table->string('email_user');
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
        Schema::connection('mysql')->dropIfExists('enregistrement_demandes');
    }
}
