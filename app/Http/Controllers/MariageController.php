<?php

namespace App\Http\Controllers;

use App\Models\RegistreNaissance;
use Illuminate\Http\Request;
use Str;

class MariageController extends Controller
{
    public function mariage(Request $request)
    {
        request()->validate([
            'num_conjoint' => 'required|string',
            'date_conjoint' => 'required|string',
            'num_conjointe' => 'required|string',
            'date_conjointe' => 'required|string',
        ]);


        $conjoint = RegistreNaissance::where([
            'numero_acte' => $request->num_conjoint,
            'date_numero_acte' =>$request->date_conjoint
        ])->first();

        $conjointe = RegistreNaissance::where([
            'numero_acte' => $request->num_conjointe,
            'date_numero_acte' =>$request->date_conjointe
        ])->first();

        if($conjoint)
        {

            if($conjointe)
            {

                $conjoint->update([
                    'date_mariage' => now(), 
                    'lieu_mariage' => 'Treichville',
                    'nom_conjoint' => $conjointe->nom,
                    'prenom_conjoint' => $conjointe->prenoms]);
                
                $conjoint->save();

            
                $conjointe->update([
                    'date_mariage' => now(), 
                    'lieu_mariage' => 'Treichville',
                    'nom_conjoint' => $conjoint->nom,
                    'prenom_conjoint' => $conjoint->prenoms]);
                
                $conjointe->save();

                $nom = Str::upper($conjoint->nom) ;
                
                $message = "Heureux mariage au couple ".$nom;

                $response = [
                    'success' => true,
                    'message' => $message,
                ];

                return response()->json($response, 200);


            }
            else
            {
                $erreur = "Les informations sur la conjointe sont incorrectes";

                $response = [
                    'success' => false,
                    'errors' => $erreur,
                ];

                return response()->json($response, 200);
            }

        }
        else
        {
            $erreur = "Les informations sur le conjoint sont incorrectes ";

            $response = [
                'success' => false,
                'errors' => $erreur,
            ];

            return response()->json($response, 200);
        }

        
    }
}
