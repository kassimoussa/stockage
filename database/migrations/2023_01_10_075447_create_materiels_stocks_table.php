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
        Schema::create('materiels_stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('objet_id')->nullable();
            $table->string('marmod_id')->nullable();
            $table->string('num_patrimoine')->nullable();
            $table->string('direction')->nullable();
            $table->string('service')->nullable();
            $table->string('site')->nullable();
            $table->string('status')->default("yes");
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
        Schema::dropIfExists('materiels_stocks');
    }
};
