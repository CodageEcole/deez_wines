<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use Illuminate\Http\Request;
use App\Models\Cellier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\CommentaireBouteille;

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
            ->where('existe_plus', false)
            ->orderBy('nom', 'asc')
            ->paginate(30);
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
            'image_bouteille' => 'image|max:2048',
            'user_id' => 'exists:users,id',
        ]);

        $bouteille = Bouteille::create([
            'nom' => $request->nom,
            'pays_fr' => $request->pays,
            'pays_en' => $request->pays,
            'region_fr' => $request->region,
            'region_en' => $request->region,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'est_personnalisee' => true,
        ]);

        if ($request->hasFile('image_bouteille')) {
            $file = $request->file('image_bouteille');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . $bouteille->id . '.' . $extension;

            if (!Storage::disk('local')->exists('imagesPersonnalisees')) {
                Storage::disk('local')->makeDirectory('imagesPersonnalisees');
            }

            Storage::disk('local')->putFileAs('imagesPersonnalisees', $file, $fileName);
            $bouteille->image_bouteille = $fileName;
            $bouteille->save();
        }

        return redirect()->route('bouteilles.show', $bouteille);
    }


    /**
     * Display the specified resource.
     */
    public function show(Bouteille $bouteille)
    {
        $commentaireBouteille = CommentaireBouteille
            ::where('bouteille_id', $bouteille->id)
            ->where('user_id', auth()->id())
            ->get()->first();
        $celliers = Cellier::where('user_id', auth()->id())->get();
        return view('bouteilles.show', compact('bouteille', 'commentaireBouteille', 'celliers'));
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
