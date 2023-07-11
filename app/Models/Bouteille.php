<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CellierQuantiteBouteille;
use Laravel\Scout\Searchable;

class Bouteille extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [ 
        'nom',
        'description_fr',
        'description_en',
        'prix',
        'code_SAQ',
        'code_CUP',
        'image_bouteille',
        'image_bouteille_alt',
        'image_pastille',
        'image_pastille_alt',
        'producteur',
        'agent_promotionnel',
        'cepage',
        'degree_alcool',
        'taux_de_sucre', 
        'format',
        'millesime',
        'aromes_fr',
        'aromes_en', 
        'acidite_fr',
        'acidite_en',
        'sucrosite_fr',
        'sucrosite_en',
        'corps_fr',
        'corps_en',
        'bouche_fr',
        'bouche_en',
        'bois_fr',
        'bois_en',
        'temperature_fr',
        'temperature_en',
        'potentiel_de_garde_fr',
        'potentiel_de_garde_en',
        'pays_fr',
        'pays_en',
        'region_en',
        'designation_reglementee_fr',
        'designation_reglementee_en',
        'couleur_fr',
        'couleur_en',
        'produit_quebec',
        'particularite_fr',
        'particularite_en',
        'appellation_origine',
        'est_scrape',
        'est_utilise'
    ];

    public function cellierQuantiteBouteille()
    {
        return $this->hasMany(CellierQuantiteBouteille::class);
    }

    /**
     * Fonction qui défini les données qui seront indexées par Scout
     */
    public function toSearchableArray()
    {
        return [
            'nom' => $this->nom,
            'description_fr' => $this->description_fr,
            'description_en' => $this->description_en,
            'code_SAQ' => $this->code_SAQ,
            'millesime' => $this->millesime,
            'producteur' => $this->producteur,
            'pays_fr' => $this->pays_fr,
            'pays_en' => $this->pays_en,
            'region_fr' => $this->region_fr,
            'region_en' => $this->region_en,
            'couleur_fr' => $this->couleur_fr,
            'couleur_en' => $this->couleur_en,
            'cepage' => $this->cepage,
            'prix' => $this->prix,
            'format' => $this->format,
            'designation_reglementee_fr' => $this->designation_reglementee_fr,
            'designation_reglementee_en' => $this->designation_reglementee_en,
            'produit_quebec_fr' => $this->produit_quebec_fr,
            'produit_quebec_en' => $this->produit_quebec_en,
            'particularite_fr' => $this->particularite_fr,
            'particularite_en' => $this->particularite_en,
            'appellation_origine' => $this->appellation_origine,
        ];
    }
}
