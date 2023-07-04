<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CellierQuantiteBouteille;

class Bouteille extends Model
{
    use HasFactory;

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
        'couleur_en'
    ];

    public function cellierQuantiteBouteille()
    {
        return $this->hasMany(CellierQuantiteBouteille::class);
    }
}
