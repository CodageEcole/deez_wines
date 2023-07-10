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
            // section tasting
            $table->string('aromes_fr')->nullable();
            $table->string('aromes_en')->nullable();
            $table->string('acidite_fr')->nullable();
            $table->string('acidite_en')->nullable();
            $table->string('sucrosite_fr')->nullable();
            $table->string('sucrosite_en')->nullable();
            $table->string('corps_fr')->nullable();
            $table->string('corps_en')->nullable();
            $table->string('bouche_fr')->nullable();
            $table->string('bouche_en')->nullable();
            $table->string('bois_fr')->nullable();
            $table->string('bois_en')->nullable();
            $table->string('temperature_fr')->nullable();
            $table->string('temperature_en')->nullable();
            $table->string('millesime')->nullable();
            $table->string('potentiel_de_garde_fr')->nullable();
            $table->string('potentiel_de_garde_en')->nullable();
            // section attributs
            $table->string('pays_fr');
            $table->string('pays_en');
            $table->string('region_fr')->nullable();
            $table->string('region_en')->nullable();
            $table->string('designation_reglementee_fr')->nullable();
            $table->string('designation_reglementee_en')->nullable();
            $table->string('classification_fr')->nullable();
            $table->string('classification_en')->nullable();
            $table->string('cepage')->nullable();
            $table->string('degree_alcool');
            $table->string('taux_de_sucre')->nullable();
            $table->string('couleur_fr');
            $table->string('couleur_en'); 
            $table->string('format');
            $table->string('producteur');
            $table->string('agent_promotionnel')->nullable();
            $table->string('code_SAQ');
            $table->string('code_CUP')->nullable();
            $table->string('produit_quebec_fr')->nullable();
            $table->string('produit_quebec_en')->nullable();

            $table->string('particularite_fr')->nullable();
            $table->string('particularite_en')->nullable();
            $table->string('appellation_origine')->nullable();

            // données séparées
            $table->string('nom');
            $table->string('image_bouteille');
            $table->string('image_bouteille_alt')->nullable();
            $table->string('prix');
            $table->string('image_pastille')->nullable();
            $table->string('image_pastille_alt')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->boolean('est_scrape')->default(false);
            
            $table->timestamps();
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
