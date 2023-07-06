<?php

namespace App\Http\Controllers;

use App\Models\BouteillePersonnalisee;
use Illuminate\Http\Request;

class BouteillePersonnaliseeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(BouteillePersonnalisee::class, 'bouteille_personnalisee');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bouteilles_personnalisees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bouteilles_personnalisees.create');
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
    public function show(BouteillePersonnalisee $bouteillePersonnalisee)
    {
        return view('bouteilles_personnalisees.show', compact('bouteillePersonnalisee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BouteillePersonnalisee $bouteillePersonnalisee)
    {
        return view('bouteilles_personnalisees.edit', compact('bouteillePersonnalisee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BouteillePersonnalisee $bouteillePersonnalisee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BouteillePersonnalisee $bouteillePersonnalisee)
    {
        //
    }
}
