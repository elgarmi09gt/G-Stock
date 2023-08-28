<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\Sortie;
use App\Models\Produit;
use Illuminate\Http\Request;

use App\Http\Requests\ProduitRequest;
use App\Models\Vente;

use function PHPUnit\Framework\isEmpty;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $produits = Produit::where('active', 1)->get();

        return view('produits\listProduits', [
            'produits' => $produits
        ]);
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
    public function store(ProduitRequest $request)
    {
        Produit::create($request->validated());

        return redirect()->back()->with('success', 'Produit ajoute avec succee !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {

        return view('produits\edit', ['produit' => $produit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProduitRequest $request, Produit $produit)
    {

        $produit->update($request->validated());

        return redirect()->route('produit.index')->with('success', 'Produit modifié avec succee !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //verifier si le produit est en stock
        $stock = Entree::where('produit_id', '=', $request->get('id_produit'))
            ->where('quantite', '>', 1)->get();
        if ($stock->isNotEmpty()) {
            return redirect()->back()->with('warning', 'Produit en stock impossible de supprimer !');
        } else {
            $sortie = Sortie::where('produit_id', '=', $request->get('id_produit'))->get();
            if ($sortie->isNotEmpty()) {
                //desactiver le produit
                $produit = Produit::find($request->get('id_produit'));
                $produit->active = 0;
                $produit->save();

                return redirect()->back()->with('info', 'Produit mis à jour (déja vendu  impossible de supprimer) !');
            } else {
                //supprimer le produit
                $produit = Produit::find($request->get('id_produit'));
                $produit->delete();

                return redirect()->back()->with('success', 'Produit supprimé avec succee !');
            }
        }
    }
}
