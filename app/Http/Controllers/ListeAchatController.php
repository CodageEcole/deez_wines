<?php

namespace App\Http\Controllers;

use App\Models\ListeAchat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\BouteilleAddedToCatalog;
use Illuminate\Support\Facades\Log;

class ListeAchatController extends Controller
{
    /* public function __construct()
    {
        $this->authorizeResource(ListeAchat::class, 'listeAchat');
    } */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('listeAchat.index');
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
    public function show(Request $request, $liste_achat_id)
    {
        $userId = Auth::id();
        $bouteilleId = $request->bouteille_id_2;

        //event(new BouteilleAddedToCatalog($userId, $bouteilleId));
        $listeAchat = ListeAchat::find($liste_achat_id);
        if (!$listeAchat) {
            $listeAchat = ListeAchat::create([
                'user_id' => Auth::id(),
            ]);
        }

        //verify if bouteille is already in the list before adding
        $celliers = Auth::user()->celliers;
        $bouteilles = $listeAchat->bouteilles;
        foreach ($bouteilles as $bouteille) {
            if ($bouteille->id == $bouteilleId) {
                $message = 'Cette bouteille est déjà dans votre liste d\'achat.';
                return view('listeAchat.show', compact('listeAchat', 'bouteilles', 'celliers'))->with('success', $message);
            }
        }
        $listeAchat->bouteilles()->attach($bouteilleId);

        if($listeAchat) {
            $bouteilles = $listeAchat->bouteilles;
        }
        $message = trans('message.add');
        return view('listeAchat.show', compact('listeAchat', 'bouteilles', 'celliers'))->with('success', $message);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListeAchat $listeAchat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ListeAchat $listeAchat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListeAchat $listeAchat)
    {
        //
    }
}
