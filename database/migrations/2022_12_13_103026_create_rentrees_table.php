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
        Schema::create('rentrees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_stock')->nullable();
            $table->string('materiel')->nullable();
            $table->string('model')->nullable();
            $table->string('num_patrimoine')->nullable();
            $table->integer('quantite')->nullable();
            $table->timestamp('date_rentree');
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
        Schema::dropIfExists('rentrees');
    }
};
