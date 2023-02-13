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
        Schema::create('cat_mars', function (Blueprint $table) {  
            $table->id();
            $table->boolean('active')->default(false);
            $table->foreignId('category_id')->constrained();  
            $table->foreignId('marque_id')->constrained();  
            $table->timestamps();
            //$table->primary(['category_id', 'marque_id']); 
            /* $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('marque_id')->references('id')->on('marques')->onDelete('cascade'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_mars');
    }
};
