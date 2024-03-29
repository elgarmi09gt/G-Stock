<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vente;
use App\Models\Client;
use App\Models\Entree;
use App\Models\Sortie;
use App\Models\Produit;
use App\Models\Reglement;
use Illuminate\Http\Request;
use App\Http\Requests\VenteRequest;
use App\Http\Requests\SortieRequest;
use App\Http\Requests\ReglementRequest;

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

        $ventes = Vente::with('client', 'reglement')->get();
        $clients = Client::all();
        return view('ventes.listVentes', [
            'ventes' => $ventes,
            'clients' => $clients,
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
                'user_id' =>  $request->get('user_id'),
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
        $produits = Produit::where('active', 1)->get();
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
    public function destroy(Request $request)
    {
        $sortie = Sortie::where('vente_id', $request->get('id_vente'))->first();
        if ($sortie) {
            return redirect()->back()->with('warning', 'Cette vente contient des produits : Veuillez les supprimer en premier');
        } else {
            $vente = Vente::find($request->get('id_vente'));
            $vente->delete();

            return redirect()->back()->with('success', 'Vente supprimée avec succées');
        }
    }

    /**add produit in vente */
    public function addProduit(SortieRequest $request)
    {
        $entre = Entree::where('produit_id', $request->validated()['produit_id'])
            ->first();
        $reglement  = Reglement::where('vente_id', $request->validated()['vente_id'])->first();
        if ($entre) {
            if (($entre->quantite - $request->validated()['quantite']) >= 0) {
                //quantite demande disponible
                $sortie = Sortie::where('produit_id', $request->validated()['produit_id'])
                    ->where('vente_id', $request->validated()['vente_id'])->first();
                if ($sortie) {
                    //produit déja ajouter dans cet vente mis a jour qte
                    $sortie->update([
                        'quantite' => $request->validated()['quantite'] + $sortie->quantite,
                    ]);
                    $entre->update([
                        'quantite' => $entre->quantite - $request->validated()['quantite'],
                    ]);
                    //réglement à mettre a jour

                    if ($reglement) {
                        $reglement->update([
                            'restant' => $request->validated()['quantite'] * $request->validated()['prix'] + $reglement->restant,
                        ]);
                    }
                    return redirect()->back()->with('info', 'Produit déja ajouté ! quantité mis a jour !');
                } else {
                    Sortie::create($request->validated());
                    $entre->update([
                        'quantite' => $entre->quantite - $request->validated()['quantite'],
                    ]);
                    //réglement à mettre a jour

                    if ($reglement) {
                        $reglement->update([
                            'restant' => $request->validated()['quantite'] * $request->validated()['prix'] + $reglement->restant,
                        ]);
                    }
                    return redirect()->back()->with('success', 'Produit ajoute avec succee !');
                }
            } else {

                return redirect()->back()->with('warning', 'Quantité restante insuffisante ! ' . $entre->quantite);
            }
        } else {
            return redirect()->back()->with('warning', 'Stock épuisé ! ');
        }
    }

    public function supprimerEntree(Request $request)
    {
        $sms = 'success';
        $message = 'Produit supprimé avec succee !';

        $sortie = Sortie::where('id', $request->get('id_sortie'))->first();

        if ($sortie) {
            $entree = Entree::where('produit_id', $sortie->produit_id)->first();
            $entree->quantite = $entree->quantite + $sortie->quantite;
            $entree->save();
            $reglement = Reglement::where('vente_id', $request->route()->parameter('vente'))->first();
            $vente = Vente::where('id', $request->route()->parameter('vente'))->first();

            if ($reglement) {
                $rs = $reglement->restant - $sortie->quantite * $sortie->prix;
                if ($rs >= 0) {
                    $reglement->restant -= $sortie->quantite * $sortie->prix;
                } else {
                    $reglement->restant = 0;
                    $vente->etat = 1;
                    $v = $reglement->verse + $rs;
                    if ($v >= 0) {
                        $reglement->verse += $rs;
                    } else {
                        $reglement->verse = 0;
                        $vente->etat = 0;
                    }
                    if ($reglement->restant == 0 && $reglement->verse == 0) {
                        $vente->etat = 0;
                    }
                    $sms = 'info';
                    $message = 'Montant reçu supérieur ! Monnaie : ' . $rs * (-1);
                }
                $reglement->save();
                $vente->save();
            }
            $sortie->delete();

            return redirect()->back()->with($sms, $message);
        }
    }

    public function reglement(ReglementRequest $request)
    {
        //dd($request->get('total') - $reglement->verse);
        //dd($request->get('id_vente'));
        $message = '';
        $sms = '';
        $vente = Vente::find($request->get('id_vente'));
        $reglement = Reglement::where('vente_id', $request->get('id_vente'))->first();
        if ($reglement) {
            // update reglement
            $reglement->restant = $request->get('total') - $reglement->verse;
            if ($request->get('mtrc') >= $reglement->restant) {
                $reglement->verse += $reglement->restant;
                $reglement->restant = 0;
                $vente->etat = 1;
                $message = 'Réglement entiérement effectué';
                $sms = 'success';
            } else {

                $reglement->verse += $request->get('mtrc');
                $reglement->restant -= $request->get('mtrc');

                $vente->etat = 2;

                $message = 'Réglement partiellement effectué ! restant(' . $reglement->restant . ')';
                $sms = 'info';
            }
        } else {
            //create new reglement
            $reglement = new Reglement();
            $reglement->vente_id = $request->get('id_vente');
            $reglement->user_id = $request->get('user_id');
            if ($request->get('mtrc') >= $request->get('total')) {

                $reglement->verse = $request->get('total');
                $reglement->restant = 0;

                $vente->etat = 1;

                $message = 'Réglement entiérement effectué ! Monnaie : ' . $request->get('mtrc') >= $request->get('total');
                $sms = 'success';
            } else {
                $reglement->verse = $request->get('mtrc');
                $reglement->restant = $request->get('total') - $request->get('mtrc');

                $vente->etat = 2;

                $message = 'Réglement partiellement effectué ! restant(' . $reglement->restant . ')';
                $sms = 'info';
            }
        }

        $vente->save();
        $reglement->save();

        return redirect()->back()->with($sms, $message . ' !');
        dd($request);
    }
}
