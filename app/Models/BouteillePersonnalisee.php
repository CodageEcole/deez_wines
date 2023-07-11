<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CellierQuantiteBouteille;
use App\Models\User;

class BouteillePersonnalisee extends Model
{
    use HasFactory;

    protected $fillables = [
        'nom',
        'description',
        'prix',
        'image_bouteille',
        'cepage',
        'degree_alcool', 
        'format',
        'pays',
        'region',
        'designation_reglementee',
        'appellation_origine',
        'couleur',
    ];

    public function cellierQuantiteBouteille()
    {
        return $this->hasMany(CellierQuantiteBouteille::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
