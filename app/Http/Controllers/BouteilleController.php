<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use Illuminate\Http\Request;

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
        return view('bouteilles.index', compact('bouteilles'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bouteille $bouteille)
    {
        return route('bouteilles.show', compact('bouteille'));
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
