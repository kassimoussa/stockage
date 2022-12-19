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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('nom_intervenant')->nullable();
            $table->string('nom_demandeur')->nullable();
            $table->string('direction')->nullable();
            $table->string('service')->nullable();
            $table->string('type_fiche')->nullable();
            $table->integer('numero_fiche')->nullable();
            $table->timestamp('date_livraison')->nullable();
            $table->tinyInteger('sign_chef')->default('0');
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
        Schema::dropIfExists('livraisons');
    }
};
