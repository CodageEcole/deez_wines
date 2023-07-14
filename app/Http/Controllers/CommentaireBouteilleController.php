<?php

namespace App\Http\Controllers;

use App\Models\CommentaireBouteille;
use Illuminate\Http\Request;

class CommentaireBouteilleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CommentaireBouteille::class, 'commentaire_bouteille');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bouteille_id' => 'required',
            'note' => 'required|integer',
            'commentaire' => 'required|string',
        ]);

        $commentaireBouteille = CommentaireBouteille::create([
            'bouteille_id' => $request->bouteille_id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'user_id' => auth()->id(),
        ]);
        
        $commentaireBouteille->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommentaireBouteille $commentaireBouteille)
    {
        if($request->note) {
            $request->validate([
                'note' => '|integer',
            ]);

            if($request->note != $commentaireBouteille->note){
                $commentaireBouteille->update([
                    'note' => $request->note,
                ]);
            }
        }
        if($request->commentaire) {
            $request->validate([
                'commentaire' => 'string',
            ]);

            if($request->commentaire != $commentaireBouteille->commentaire){
                $commentaireBouteille->update([
                    'commentaire' => $request->commentaire,
                ]);
            }
        }
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentaireBouteille $commentaireBouteille)
    {
        //
    }
}
