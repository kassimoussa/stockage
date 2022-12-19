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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('materiel')->nullable();
            $table->integer('quantite')->nullable();
            $table->string('direction')->nullable();
            $table->string('service')->nullable();
            $table->string('site')->nullable();
            $table->string('filename')->nullable();
            $table->string('public_path')->nullable();
            $table->string('storage_path')->nullable();
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
        Schema::dropIfExists('stocks');
    }
};
