<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
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

        return redirect()->route('celliers.show' , $cellier);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellier $cellier)
    {
        $bouteilles = $cellier->bouteilles()->get();
        return view('celliers.show', compact('cellier', 'bouteilles'));
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
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $cellier->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('celliers.show', $cellier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellier $cellier)
    {
        
        $cellier->delete();

        return redirect()->route('celliers.index');
    }
}
