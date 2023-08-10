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
    // Gestion de l'autorisation avec la politique
    public function __construct()
    {
        $this->authorizeResource(Bouteille::class, 'bouteille');
    }

    /**
     * Ici on ne rentre pas dans le if quand on arrive sur la page, 
     * c'est seulement axios qui va faire une requête quand on tape dans la barre de recherche
     * En tant qu'usager on entre toujours dans le else
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('query');
        $rouge = $request->rouge;
        $blanc = $request->blanc;
        $rose = $request->rose;
        $orange = $request->orange;
        $pays = $request->pays;

        // On verifie si on a un terme de recherche
        if ($searchTerm || $rouge || $blanc || $rose || $orange || $pays) {
            
            // On verifie si on a une couleur, une catégorie, un pays ou une région
            $bouteilles = Bouteille::search($searchTerm)
                ->orderBy('nom', 'asc')
                ->when($pays, function ($query) use ($pays) {
                    return $query->where('pays_fr', $pays);
                })
                ->when(($rouge || $blanc || $rose || $orange), function ($query) use ($rouge, $blanc, $rose, $orange) {
                    $colors = array_filter([$rouge, $blanc, $rose, $orange]);
                    return $query->whereIn('couleur_fr', $colors);
                })
                ->paginate(30);

            $message = __('messages.add');
            // On ajoute le message afin de l'avoir dans la bonne langue dans la vue
            foreach ($bouteilles as $bouteille) {
                $bouteille->message = $message;
                $bouteille->nombreBouteilles = $bouteilles->total();
            }
            // On retourne les bouteilles en json
            return response()->json($bouteilles);

        } else {
            $celliers = Cellier::where('user_id', auth()->id())->get();
            //filter pays by alphabetical order
            $pays = Bouteille::select('pays_fr')->distinct()->get()->sortBy('pays_fr');
            $regions = Bouteille::select('region_fr')->distinct()->get()->sortBy('region_fr');
            $prix = Bouteille::select('prix')->distinct()->get();
            return view('bouteilles.index', compact('celliers', 'pays', 'regions', 'prix'));
        }
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
        // On valide les champs
        $request->validate([
            'nom' => 'required|string|max:255',
            'pays' => 'string|max:255',
            'region' => 'string|max:255',
            'description' => 'string|max:255',
            'image_bouteille' => 'image|max:2048',
            'user_id' => 'exists:users,id',
        ]);

        // On crée la bouteille
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

        // On ajoute l'image si il y en a une
        if ($request->hasFile('image_bouteille')) {
            $file = $request->file('image_bouteille');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . $bouteille->id . '.' . $extension;
            // On crée le dossier si il n'existe pas
            if (!Storage::disk('local')->exists('imagesPersonnalisees')) {
                Storage::disk('local')->makeDirectory('imagesPersonnalisees');
            }
            // On enregistre l'image
            Storage::disk('local')->putFileAs('imagesPersonnalisees', $file, $fileName);
            $bouteille->image_bouteille = $fileName;
            // On sauvegarde la bouteille
            $bouteille->save();
        } else {
            // On met une image par défaut si il n'y en a pas
            $bouteille->image_bouteille = '06.png';
            // On sauvegarde la bouteille
            $bouteille->save();
        }

        return redirect()
                ->route('bouteilles.show', $bouteille);  
    }

    /**
     * Display the specified resource.
     */
    public function show(Bouteille $bouteille)
    {
        // On récupère le commentaire de l'usager connecté
        $commentaireBouteille = CommentaireBouteille::
            where('bouteille_id', $bouteille->id)
            ->where('user_id', auth()->id())
            ->get()->first();
        // On récupère les celliers de l'usager connecté
        $celliers = Cellier::where('user_id', auth()->id())->get();

        return view('bouteilles.show', compact('bouteille', 'commentaireBouteille', 'celliers'));
    }
}
