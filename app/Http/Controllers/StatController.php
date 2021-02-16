<?php

namespace App\Http\Controllers;

use App\Models\CodeDecNais;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function statistiques()
    {
        $resultat['nb_hopital_deces'] =  CodeDecNais::where( 'type',"décès")->count();
        $resultat['nb_mairie_deces'] =  CodeDecNais::where('status', 100)->where('type',"décès")->count();


        $resultat['nb_hopital_naissance']  = CodeDecNais::where( 'type',"naissance")->count();
        $resultat['nb_mairie_naissance'] =   CodeDecNais::where('status', 100)->where('type',"naissance")->count();

    
        // dd($resultat);

        $response = [
            'success' => true,
            'message' => $resultat,
        ];

        return response()->json($response, 200);
    }
}
