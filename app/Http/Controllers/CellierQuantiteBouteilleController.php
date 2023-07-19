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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        return redirect()->route('celliers.show', $request->cellier_id);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(CellierQuantiteBouteille $cellierQuantiteBouteille)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CellierQuantiteBouteille $cellierQuantiteBouteille)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CellierQuantiteBouteille $cellierQuantiteBouteille)
    {
        $validation = $request->validate([
            'nouvelleQuantite' => 'required|integer'
        ]);

        $cellierQuantiteBouteille->quantite = $validation['nouvelleQuantite'];
        $cellierQuantiteBouteille->save();


        return redirect()->route('celliers.show', $cellierQuantiteBouteille->cellier_id)->with('success', "Vous avez maintenant $request->nouvelleQuantite bouteilles de ");
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(CellierQuantiteBouteille $cellierQuantiteBouteille)
    public function destroy(CellierQuantiteBouteille $cellierQuantiteBouteille)
    {
        $cellierQuantiteBouteille->delete();

        return redirect()->route('celliers.show', $cellierQuantiteBouteille->cellier_id)->with('success', 'La bouteille a été supprimée avec succès.');
    }
}
