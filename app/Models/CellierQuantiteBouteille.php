<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellierQuantiteBouteille extends Model
{
    use HasFactory;

    private $fillable = [
        'cellier_id',
        'bouteille_id',
        'quantite',
    ];

    public function bouteille()
    {
        return $this->belongsTo(Bouteille::class);
    }

    public function cellier()
    {
        return $this->belongsTo(Cellier::class);
    }
}
