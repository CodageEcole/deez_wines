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
        Schema::create('bouteille_liste_achat', function (Blueprint $table) {
            $table->unsignedBigInteger('bouteille_id');
            $table->unsignedBigInteger('liste_achat_id');
            $table->timestamps();

            $table->primary(['bouteille_id', 'liste_achat_id']);
            
            $table->foreign('bouteille_id')->references('id')->on('bouteilles')->onDelete('cascade');
            $table->foreign('liste_achat_id')->references('id')->on('liste_achats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bouteille_liste_achat');
    }
};
