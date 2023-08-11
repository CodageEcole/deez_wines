<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Bouteille;
use App\Models\Cellier;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalBouteilles = Bouteille::count();
        $totalUsagers = User::count();
        $usagersAvecCelliers = User::withCount('celliers')->get();

        return view('admin.index', compact('totalBouteilles', 'totalUsagers', 'usagersAvecCelliers'));
        // return view('admin.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // $usager = User::where();
        
        $user->forceDelete();
        $nomUsager = $user->name;

        return redirect()->route('admin.stats.index')->with('success', trans('messages.delete_user', compact('nomUsager')));
    }
}
