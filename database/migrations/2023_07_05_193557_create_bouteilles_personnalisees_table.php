<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bouteilles_personnalisees', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->string('prix')->nullable();
            $table->string('image_bouteille');
            $table->string('cepage')->nullable();
            $table->string('degree_alcool')->nullable();
            $table->string('format')->nullable();
            $table->string('pays')->nullable();
            $table->string('region')->nullable();
            $table->string('designation_reglementee')->nullable();
            $table->string('couleur')->nullable(); 
            $table->string('classification')->nullable();
            $table->string('appellation_origine')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bouteilles_personnalisees');
    }

};