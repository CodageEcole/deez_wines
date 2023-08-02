<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use App\Models\CellierQuantiteBouteille;
use Illuminate\Http\Request;

class CellierController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Cellier::class, 'cellier');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $celliers = Cellier::where('user_id', auth()->id())->get();
        return view('celliers.index', compact('celliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('celliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $cellier = Cellier::create([
            'nom' => $request->nom,
            'user_id' => auth()->id(),
        ]);

        $celliers = Cellier::where('user_id', auth()->id())->get();
        $nomCellier = $cellier->nom;
        return redirect()->route('celliers.index', compact('celliers'))->with('success', trans('messages.create_cellar', compact('nomCellier')));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellier $cellier)
    {

        $cellierQuantiteBouteille = CellierQuantiteBouteille::with('bouteille')->where('cellier_id', $cellier->id)->get();
        return view('celliers.show', compact('cellier', 'cellierQuantiteBouteille'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cellier $cellier)
    {
        return view('celliers.edit', compact('cellier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cellier $cellier)
    {
        $vieuxNomCellier = $cellier->nom;

        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $cellier->update([
            'nom' => $request->nom,
        ]);

        $nouveauNomCellier = $cellier->nom;

        return redirect()->route('celliers.show', $cellier)->with('edit-cellier', trans('messages.edit_cellar', compact('vieuxNomCellier', 'nouveauNomCellier')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellier $cellier)
    {
        
        $cellier->delete();
        $nomCellier = $cellier->nom;
        return redirect()->route('celliers.index')->with('success', trans('messages.delete_cellar', compact('nomCellier')));
    }
}
