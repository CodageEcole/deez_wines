<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use Illuminate\Http\Request;
use App\Models\Cellier;
use Illuminate\Support\Facades\Auth;

class BouteilleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Bouteille::class, 'bouteille');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //resultat de la recherche
        $bouteilles = Bouteille::search(request('search'))
            ->paginate(1000);
        $celliers = Cellier::where('user_id', auth()->id())->get();
        return view('bouteilles.index', compact('bouteilles', 'celliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bouteilles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'pays' => 'string|max:255',
            'region' => 'string|max:255',
            'description' => 'string|max:255',
            'image_bouteille' => 'string|max:255',
            'user_id' => 'exists:users,id',
        ]);

        $bouteille = Bouteille::create([
            'nom' => $request->nom,
            'pays' => $request->pays,
            'region' => $request->region,
            'description' => $request->description,
            'image_bouteille' => $request->image_bouteille,
            'user_id' => Auth::id(),
        ]);

        //TODO Ajouter l'image au stockage

        return redirect()->route('bouteilles.show', $bouteille);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bouteille $bouteille)
    {
        return view('bouteilles.show', compact('bouteille'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bouteille $bouteille)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bouteille $bouteille)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bouteille $bouteille)
    {
        //
    }
}
