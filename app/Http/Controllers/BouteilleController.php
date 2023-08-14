<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use Illuminate\Http\Request;
use App\Models\Cellier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\CommentaireBouteille;
use Illuminate\Support\Facades\Log;

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
        $prix = $request->prix;
        $cepage = $request->cepage;
        $pastille = $request->pastille;

        // Eloquent query builder
        $query = Bouteille::query();

        // La recherche en soit
        if ($searchTerm) {
            $query->where('nom', 'like', "%$searchTerm%");
        }


        // Par pays, avec recherche dans un autre champ pour les pays en anglais
        if ($pays) {
            $query->where(function ($subquery) use ($pays) {
                $subquery->whereIn('pays_fr', $pays)
                         ->orWhere('pays_en', $pays);
            });
        }

        // Par couleur, avec recherche dans un autre champ pour les vins orange
        if ($rouge || $blanc || $rose || $orange) {

            $query->where(function ($subquery) use ($rouge, $blanc, $rose, $orange) {

                $colors = array_filter([$rouge, $blanc, $rose]);
                $subquery->whereIn('couleur_fr', $colors);

                if ($orange) {

                    $subquery->orWhere('particularite_fr', 'LIKE', "%$orange%");
                }
            });
        }

        // Filtrer par gamme de prix
        if ($prix) {

            list($minPrice, $maxPrice) = explode('-', $prix);
            $query->whereBetween('prix', [$minPrice, $maxPrice]);
        }
        
        if($cepage){
            $query->where('cepage', 'like', '%' . $cepage . '%');
        }

        if($pastille){
            $query->where('image_pastille_alt', 'like', '%' . $pastille . '%');
        }
    
        // Get paginated results
        $bouteilles = $query->orderBy('nom', 'asc')->paginate(30);
        
        $message = __('messages.add');
        foreach ($bouteilles as $bouteille) {
            $bouteille->message = $message;
            $bouteille->nombreBouteilles = $bouteilles->total();
        }
    
        if ($request->ajax()) {
            return response()->json($bouteilles);
        }
        else {

            $celliers = Cellier::where('user_id', auth()->id())->get();

            $localisation = app()->getLocale(); // Obtenir la localisation actuelle (fr ou en)
            $paysColumn = ($localisation === 'fr') ? 'pays_fr' : 'pays_en';
            $pays = Bouteille::select($paysColumn)->distinct()->get()->sortBy($paysColumn);

            $pastilles = Bouteille::select('image_pastille_alt')->distinct()->get()->sortBy('image_pastille_alt');
            $similarityThreshold = 80;
            $cepageEntries = Bouteille::select('cepage')
                ->distinct()
                ->get()
                ->pluck('cepage')
                ->flatMap(function ($cepage) {
                    $cepageArray = explode(', ', $cepage);
                    return array_map(function ($entry) {
                        return trim(preg_replace('/[0-9%]+/', '', $entry));
                    }, $cepageArray);
                })
                ->filter()
                ->unique()
                ->sort()
                ->values();

            $uniqueCepage = [];

            foreach ($cepageEntries as $cepage) {
                $isSimilar = false;
                
                // Compare the current cepage with existing unique cepages
                foreach ($uniqueCepage as $existingCepage) {
                    similar_text($cepage, $existingCepage, $similarityPercentage);

                    // If similarity is above the threshold, mark as similar
                    if ($similarityPercentage >= $similarityThreshold) {
                        $isSimilar = true;
                        break;
                    }
                }

                if (!$isSimilar) {
                    $uniqueCepage[] = $cepage;
                }
            }

            $cepages = $uniqueCepage;
            return view('bouteilles.index', compact('celliers', 'pays', 'cepages', 'pastilles'));
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
