<?php

namespace App\Http\Controllers;

use App\Mail\NaissanceRegister;
use App\Mail\NAissanceSuccess;
use App\Models\CodeDecNais;
use App\Models\ExtraitNaissance;
use App\Models\NouveauNee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use NumberFormatter;

class NouveauNeeController extends BaseController
{
    public function EnregistrerNouveauNee(Request $request)
    {
        request()->validate([
            'nomParent' => 'required|string',
            'prenomParent' => 'required|string',
            'sexe' => 'required|string',
            'heure' => 'required|string',
            'nomMedecin' => 'required|string',
            'sageFemme' => 'required|string',
            'emailParent' => 'required|email'
        ]);

        $code = date('Y') . ':' . date('H') . $request->sexe[0] . '-' . date('s') . date('m') . date('i') . date('d');

        $request['Code_Generer'] = $code;
        $request['Hopital_naissance'] = "hopitale generale de treichville ";

        $user = User::where('email', $request->emailParent)->first();

        if ($user) {
            CodeDecNais::create([
                'type' => "naissance",
                'codeGenerer' => $code,
                'status' => 25,
                'user_id' => $user->id
            ]);
        }


        Mail::to($request['emailParent'])->send(new NAissanceSuccess($code));

        $nouveau_nee = NouveauNee::create([
            'nom_parent' => $request->nomParent,
            'prenom_parent' => $request->prenomParent,
            'sexe_enfant' => $request->sexe,
            'Hopital_naissance' => $request->Hopital_naissance,
            'Code_Generer' => $request->Code_Generer,
            'email_parent' => $request->emailParent,
            'nom_medecin' => $request->nomMedecin,
            'nom_sage_femme' => $request->sageFemme,
            'heure_naissance' => $request->heure
        ]);

        return $this->sendResponse($nouveau_nee->Code_Generer, 'L\'enregistrement a ete effecteur avec succes ');
    }


    public function SeeDeclaration()
    {
        return Inertia::render('Naissance/DeclarationdeNaissance');
    }

    public function SendCodeChildDec(Request $request)
    {

        request()->validate([
            'code' => 'required'
        ]);


        $new_nee = NouveauNee::where('Code_Generer', $request->code)->OrderBy("created_at", "desc")->first();

        if ($new_nee) {

            return Redirect::route('Show.sendInfochildDec', $new_nee->Code_Generer);
        } else {
            return redirect()->back()->with('error', 'Le code saisie n\'est pas correcte ');
        }
    }

    public function SeeInfoDeclaration($code)
    {
        return Inertia::render('Naissance/DonneDecChild', ['code' => $code]);
    }

    public function EnregistrementInfochildDec(Request $request)
    {
        request()->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'nom_pere' => 'required|string',
            'prenom_pere' => 'required|string',
            'numero_tel_pere' => 'required|string',
            'num_cni_pere' => 'required|string',
            'nom_mere' => 'required|string',
            'prenom_mere' => 'required|string',
            'numero_tel_mere' => 'required|string',
            'num_cni_mere' => 'required|string'
        ]);

        $new_nee = NouveauNee::where('Code_Generer', $request->Code_Generer)->OrderBy("created_at", "desc")->first();


        $extrait = ExtraitNaissance::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $new_nee->created_at,
            'heure_naissance' => $new_nee->heure_naissance,
            'lieu_naissance' => $new_nee->Hopital_naissance,
            'nom_pere' => $request->nom_pere,
            'prenom_pere' => $request->prenom_pere,
            'nom_mere' => $request->nom_mere,
            'prenom_mere' => $request->prenom_mere,
            'code_Generer' => $new_nee->Code_Generer,
            'num_tel_pere' => $request->numero_tel_pere,
            'num_tel_mere' => $request->numero_tel_mere,
            'num_cni_pere' => $request->num_cni_pere,
            'num_cni_mere' => $request->num_cni_mere,
        ]);

        $information['nom'] = $extrait->nom;
        $information['prenoms'] = $extrait->prenoms;

        $email_send = auth()->user()->email;

        Mail::to($email_send)->send(new NaissanceRegister($information));

        CodeDecNais::where(['codeGenerer' => $request->Code_Generer])->update(['status' => 50]);

        return Redirect::route('dashboard')->with('success', 'Felicitation la declaration a été effectue avec success');
    }
}
