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
        Schema::create('sortie_materiels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('marque_id')->nullable();
            $table->bigInteger('model_id')->nullable();
            $table->bigInteger('materiel_id')->nullable();
            $table->string('num_patrimoine')->nullable(); 
            $table->string('raison')->nullable();
            $table->timestamp('date_sortie');
            $table->string('direction')->nullable();
            $table->string('service')->nullable();
            $table->string('site')->nullable();
            $table->string('submitedby')->nullable();
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
        Schema::dropIfExists('sortie_materiels');
    }
};
