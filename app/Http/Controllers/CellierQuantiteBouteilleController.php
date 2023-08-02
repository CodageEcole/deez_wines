<?php

namespace App\Http\Controllers;

use App\Models\CellierQuantiteBouteille;
use Illuminate\Http\Request;

class CellierQuantiteBouteilleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CellierQuantiteBouteille::class, 'cellier_quantite_bouteille');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cellierQuantiteBouteille = CellierQuantiteBouteille::where('cellier_id', $request->cellier_id)
            ->where('bouteille_id', $request->bouteille_id)
            ->first();

        // Check if the bottle quantity already exists in the cellar
        if ($cellierQuantiteBouteille) {
            // Update the existing quantity based on the source page
            if ($request->source_page == 'bouteilles.index') {
                $cellierQuantiteBouteille->quantite += $request->quantite;
            } else {
                $cellierQuantiteBouteille->quantite = $request->quantite;
            }
            $cellierQuantiteBouteille->save();
        } else {
            // Create a new quantity entry in the cellar
            $request->validate([
                'cellier_id' => 'required|integer',
                'bouteille_id' => 'required|integer',
                'quantite' => 'required|integer',
            ]);

            $cellierQuantiteBouteille = CellierQuantiteBouteille::create([
                'cellier_id' => $request->cellier_id,
                'bouteille_id' => $request->bouteille_id,
                'quantite' => $request->quantite,
            ]);
        }

        $quantite = $cellierQuantiteBouteille->quantite;
        $nomBouteille = $cellierQuantiteBouteille->bouteille->nom;
        $nomCellier = $cellierQuantiteBouteille->cellier->nom;

        return redirect()->route('celliers.show', $request->cellier_id)->with('success', trans('messages.add_bottle', compact('quantite', 'nomBouteille', 'nomCellier')));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CellierQuantiteBouteille $cellierQuantiteBouteille)
    {
        $validation = $request->validate([
            'nouvelleQuantite' => 'required|integer'
        ]);

        $ancienneQuantite = $cellierQuantiteBouteille->quantite;
        $nouvelleQuantite = $validation['nouvelleQuantite'];
        $difference = abs($nouvelleQuantite - $ancienneQuantite);

        $cellierQuantiteBouteille->quantite = $nouvelleQuantite;
        $cellierQuantiteBouteille->save();

        $cellierQuantiteBouteille->load('bouteille');

        $nomBouteille = $cellierQuantiteBouteille->bouteille->nom;
        $nomCellier = $cellierQuantiteBouteille->cellier->nom;

        $messageKey = ($nouvelleQuantite > $ancienneQuantite) ? 'edit_bottle_more' : 'edit_bottle_less';
        $message = trans("messages.$messageKey", compact('difference', 'nomBouteille', 'nomCellier'));

        return redirect()->route('celliers.show', $cellierQuantiteBouteille->cellier_id)->with('success', $message);

    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(CellierQuantiteBouteille $cellierQuantiteBouteille)
    public function destroy(CellierQuantiteBouteille $cellierQuantiteBouteille)
    {
        
        $cellierQuantiteBouteille->load('bouteille');
        $nomBouteille = $cellierQuantiteBouteille->bouteille->nom;
        
        $cellierQuantiteBouteille->delete();
        $nomCellier = $cellierQuantiteBouteille->cellier->nom;
        return redirect()->route('celliers.show', $cellierQuantiteBouteille->cellier_id)->with('success', trans('messages.delete_bottle', compact('nomBouteille', 'nomCellier')));
    }
}
