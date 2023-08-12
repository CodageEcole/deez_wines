<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Bouteille;
use App\Models\Cellier;
use App\Models\CellierQuantiteBouteille;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Nombre total d'usagers, de celliers et de bouteilles
        $totalUsagers = User::count();
        $totalCelliers = Cellier::count();
        $totalBouteilles = Bouteille::count();


        // Nombre moyen de celliers par usager
        $moyenneCelliersParUsager = $totalCelliers / $totalUsagers;

        // Nombre moyen de bouteilles par cellier et par usager
        $moyenneBouteillesParCellier = number_format(CellierQuantiteBouteille::avg('quantite'), 2);


        $nombreTotalBouteillesDansCelliers = CellierQuantiteBouteille::sum('quantite');
        $moyenneBouteillesParUsager = $nombreTotalBouteillesDansCelliers / $totalUsagers;

        // Nombre de bouteilles bues dans un temps donné
        $dateDebut = now()->subDays(30);// Exemple : les 30 derniers jours
        $totalBouteillesBues = CellierQuantiteBouteille::whereHas('bouteille', function ($query) use ($dateDebut) {
            $query->where('est_utilisee', true)
                ->where('updated_at', '>', $dateDebut);
        })->sum('quantite');

        // Nombre de nouvelles bouteilles ajoutées dans un temps donné
        $totalBouteillesAjoutees = CellierQuantiteBouteille::where('created_at', '>', $dateDebut)
            ->sum('quantite');

        // Nombre de nouveaux usagers
        $nouveauxUsagers = User::where('created_at', '>', $dateDebut)
            ->count();

        $totalMontantBouteilles = number_format(Bouteille::sum('prix'), 2, '.', ',');


        return view('admin.index', compact(
            'totalUsagers',
            'totalCelliers',
            'totalBouteilles',
            'moyenneCelliersParUsager',
            'moyenneBouteillesParCellier',
            'moyenneBouteillesParUsager',
            'totalBouteillesBues',
            'totalBouteillesAjoutees',
            'nouveauxUsagers',
            'totalMontantBouteilles'
        ));
    }

    public function celliers()
    {
        // Montant total des bouteilles détenues dans tous les celliers
        $totalMontantCelliers = number_format(CellierQuantiteBouteille::join('bouteilles', 'cellier_quantite_bouteilles.bouteille_id', '=', 'bouteilles.id')->selectRaw('SUM(cellier_quantite_bouteilles.quantite * bouteilles.prix) as totalMontant')->value('totalMontant'),2,'.',','
        );


        // Montant total des bouteilles détenues par chaque usager dans chaque cellier
        $usersWithCelliers = User::with('celliers.cellierQuantiteBouteille')->get();

        $montantsParUsagerCellier = [];
        
        foreach ($usersWithCelliers as $user) {
            $userTotalBouteilles = 0;
            $userTotalMontant = 0;
        
            foreach ($user->celliers as $cellier) {
                $montantCellier = $cellier->cellierQuantiteBouteille->sum(function ($bouteille) {
                    return $bouteille->quantite * $bouteille->bouteille->prix;
                });
        
                $userTotalBouteilles += $cellier->cellierQuantiteBouteille->sum('quantite');
                $userTotalMontant += $montantCellier;
        
                $montantsParUsagerCellier[$user->id][$cellier->id] = [
                    'montant' => number_format($montantCellier, 2, '.', ','),
                    'nombre_bouteilles' => $cellier->cellierQuantiteBouteille->sum('quantite')
                ];
            }
        
            $user->totalBouteilles = $userTotalBouteilles;
            $user->totalMontant = number_format($userTotalMontant, 2, '.', ',');;
        }


        return view('admin.celliers', compact(
            'totalMontantCelliers',
            'usersWithCelliers',
            'montantsParUsagerCellier'
        ));
    }

    public function users()
    {
        $usagersAvecCelliers = User::withCount('celliers')->get();

        return view('admin.users', compact('usagersAvecCelliers'));
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
