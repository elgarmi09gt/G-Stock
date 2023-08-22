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
        //dd($mois);
        $clients = Client::all();
        $nbreClient = $clients->count();

        /*$ventes = DB::table('ventes')
            ->select('mois', DB::raw('SUM(montant) as montant'))
            ->groupBy('mois')
            ->get();*/

        return view('accueil\index', ['nbreClient' => $nbreClient]);
    }
}
