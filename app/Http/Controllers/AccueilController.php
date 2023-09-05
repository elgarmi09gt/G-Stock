<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccueilController extends Controller
{
    public function index()
    {

        $mois = Carbon::now()->year . '-' . Carbon::now()->month;

        $ventes = DB::table('ventes as v')
            ->join('sorties as s', 'v.id', '=', 's.vente_id')
            ->select('mois', DB::raw('SUM(prix*quantite) as montant'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
        $recu = DB::table('ventes as v')
            ->join('reglements as r', 'v.id', '=', 'r.vente_id')
            ->select('mois', DB::raw('SUM(verse) as montant'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
        $rest = DB::table('ventes as v')
            ->join('reglements as r', 'v.id', '=', 'r.vente_id')
            ->select('mois', DB::raw('SUM(restant) as montant'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();
        $totalVendu = [];
        foreach ($ventes as $key => $v) {
            $m = Carbon::create()->startOfMonth()->month($v->mois)->startOfMonth()->format('F');
            if (Carbon::parse($m)->year == Carbon::now()->year) {
                if (Carbon::parse($m)->month == 1) {
                    $totalVendu[1] = $v->montant;
                } else if (Carbon::parse($m)->month == 2) {
                    $totalVendu[2] = $v->montant;
                } else if (Carbon::parse($m)->month == 3) {
                    $totalVendu[3] = $v->montant;
                } else if (Carbon::parse($m)->month == 4) {
                    $totalVendu[4] = $v->montant;
                } else if (Carbon::parse($m)->month == 5) {
                    $totalVendu[5] = $v->montant;
                } else if (Carbon::parse($m)->month == 6) {
                    $totalVendu[6] = $v->montant;
                } else if (Carbon::parse($m)->month == 7) {
                    $totalVendu[7] = $v->montant;
                } else if (Carbon::parse($m)->month == 8) {
                    $totalVendu[8] = $v->montant;
                } else if (Carbon::parse($m)->month == 9) {
                    $totalVendu[9] = $v->montant;
                } else if (Carbon::parse($m)->month == 10) {
                    $totalVendu[10] = $v->montant;
                } else if (Carbon::parse($m)->month == 11) {
                    $totalVendu[11] = $v->montant;
                } else {
                    $totalVendu[12] = $v->montant;
                }
            }
        }
        //dd($mois, $ventes, $recu, $rest);
        $clients = Client::all();
        $nbreClient = $clients->count();

        /*$ventes = DB::table('ventes')
            ->select('mois', DB::raw('SUM(montant) as montant'))
            ->groupBy('mois')
            ->get();*/

        return view('accueil\index', [
            'nbreClient' => $nbreClient,
            'totalVendu' => $totalVendu
        ]);
    }
}
