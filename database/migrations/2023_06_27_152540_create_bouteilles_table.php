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
        Schema::create('bouteilles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description_fr');
            $table->text('description_en');
            $table->string('prix');
            $table->string('code_SAQ');
            $table->string('code_CUP');
            $table->string('image_bouteille');
            $table->string('image_bouteille_alt');
            $table->string('image_pastille');
            $table->string('image_pastille_alt');
            $table->string('producteur');
            $table->string('agent_promotionnel');
            $table->string('cepage');
            $table->string('degree_alcool');
            $table->string('taux_de_sucre');
            $table->string('format');
            $table->string('millesime');
            $table->string('aromes_fr');
            $table->string('aromes_en');
            $table->string('acidite_fr');
            $table->string('acidite_en');
            $table->string('sucrosite_fr');
            $table->string('sucrosite_en');
            $table->string('corps_fr');
            $table->string('corps_en');
            $table->string('bouche_fr');
            $table->string('bouche_en');
            $table->string('bois_fr');
            $table->string('bois_en');
            $table->string('temperature_fr');
            $table->string('temperature_en');
            $table->string('potentiel_de_garde_fr');
            $table->string('potentiel_de_garde_en');
            $table->string('pays_fr');
            $table->string('pays_en');
            $table->string('region_en');
            $table->string('region_en');
            $table->string('designation_reglementee_fr');
            $table->string('designation_reglementee_en');
            $table->string('couleur_fr');
            $table->string('couleur_en'); 
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bouteilles');
    }
};
