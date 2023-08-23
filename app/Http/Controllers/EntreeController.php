<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntreeRequest;
use App\Models\Entree;
use App\Models\Produit;
use Illuminate\Http\Request;


class EntreeController extends Controller
{
    public function index()
    {

        $entrees = Entree::with('produit')->get();

        $produits = Produit::all();

        return view('entrees\listEntrees', [
            'entrees' => $entrees,
            'produits' => $produits
        ]);
    }

    public function store(EntreeRequest $request)
    {

        if ($request->validated()) {
            $entree = Entree::where('produit_id', $request->get('produit_id'))->first();
            if ($entree === null) {
                Entree::create($request->validated());
            } else {
                $entree->update([
                    'quantite' => $entree->quantite + $request->get('quantite'),
                    'prix' => $request->get('prix')
                ]);
            }
        }
        return redirect()->back()->with('success', 'Stock approvisionné avec succee !');
    }

    public function edit(Entree $entree)
    {
        //dd($produit);
        //$produits = Produit::all('id', 'libelle');
        $produit = Produit::where('id', $entree->produit_id)->first();
        return view('entrees\edit', [
            'entree' => $entree,
            //'produits' => $produits
            'produit' => $produit
        ]);
    }

    public function update(EntreeRequest $request, Entree $entree)
    {
        //dd($request);
        $entree->update($request->validated());

        return redirect()->route('entree.index')->with('success', 'Stock modifié avec succee !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $entree = Entree::find($request->get('id_entree'));
        $entree->delete();

        return redirect()->back()->with('success', 'Entrée supprimé avec succee !');
    }
}
