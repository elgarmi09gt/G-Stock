<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntreeRequest;
use App\Models\Entree;
use App\Models\Produit;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

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
