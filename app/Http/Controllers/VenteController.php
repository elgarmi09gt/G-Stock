<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Entree;
use App\Models\Sortie;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Http\Requests\VenteRequest;
use App\Http\Requests\SortieRequest;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*$v = new Vente();
        $v->reference = 'VEN_00000002';
        $v->etat = 1;
        $v->mois = Carbon::now()->month();
        $v->client_id = 1;
        $v->save();*/

        $ventes = Vente::with('client')->get();
        $clients = Client::all();
        return view('ventes.listVentes', [
            'ventes' => $ventes,
            'clients' => $clients
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
    public function store(VenteRequest $request)
    {
        $vente = new Vente();
        if ($request->get('client_id') == null) {

            $vente = Vente::create($request->validated());
        } else {

            $vente = Vente::create([
                'etat' => $request->validated()['etat'],
                'mois' => $request->validated()['mois'],
                'reference' => $request->validated()['reference'],
                'client_id' =>  $request->get('client_id'),
            ]);
        }
        return redirect()->route('vente.show', $vente);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vente $vente)
    {
        $client = '';
        $sorties = Sortie::where('vente_id', $vente->id)->with('produit')->get();
        $produits = Produit::all();
        if ($vente->client_id == null) {
            $client = null;
        } else {
            $client = Client::where('id', $vente->client_id)->first();
        }

        return view('ventes.sorties', [
            'sorties' => $sorties,
            'produits' => $produits,
            'vente' => $vente,
            'client' => $client
        ]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vente $vente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vente $vente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vente $vente)
    {
        //
    }

    /**add produit in vente */
    public function addProduit(SortieRequest $request)
    {
        $entre = Entree::where('produit_id', $request->validated()['produit_id'])
            ->first();
        if ($entre) {
            if (($entre->quantite - $request->validated()['quantite']) >= 0) {

                $sortie = Sortie::where('produit_id', $request->validated()['produit_id'])
                    ->where('vente_id', $request->validated()['vente_id'])->first();
                if ($sortie) {
                    $sortie->update([
                        'quantite' => $request->validated()['quantite'] + $sortie->quantite,
                    ]);
                    $entre->update([
                        'quantite' => $entre->quantite - $request->validated()['quantite'],
                    ]);
                    return redirect()->back()->with('info', 'Produit déja ajouté ! quantité mis a jour !');
                } else {
                    Sortie::create($request->validated());
                    $entre->update([
                        'quantite' => $entre->quantite - $request->validated()['quantite'],
                    ]);
                    return redirect()->back()->with('success', 'Produit ajoute avec succee !');
                }
            } else {

                return redirect()->back()->with('warning', 'Quantité restante insuffisante ! ' . $entre->quantite);
            }
        } else {
            return redirect()->back()->with('warning', 'Stock épuisé ! ');
        }
        dd(1);



        /*if ($vente) {


            } */

        dd($request->validated());
    }
}
