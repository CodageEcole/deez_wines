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
        return view('celliers.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cellier $cellier)
    {
        return view('celliers.show', compact('cellier'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cellier $cellier)
    {
        //
    }
}
