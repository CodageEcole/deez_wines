<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeAchat extends Model
{
    use HasFactory;

    protected $fillable = [
        'bouteille_id',
        'user_id',
    ];

    public function bouteilles()
    {
        return $this->belongsToMany(Bouteille::class);
    }
}
