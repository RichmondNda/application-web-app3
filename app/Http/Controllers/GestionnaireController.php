<?php

namespace App\Http\Controllers;

use App\Models\CodeDecNais;
use App\Models\ExtraitNaissance;
use App\Models\Gestionnaire;
use App\Models\RegistreNaissance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use NumberFormatter;

class GestionnaireController extends BaseController
{
    public function login(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $gestionnaire = Gestionnaire::where(['email' => $request->email])->first();

        $errors = [];
        $message = "l'authentification a échouée";
        $user = [];

        if (!empty($gestionnaire)) {

            if (Hash::check($request->password, $gestionnaire->password)) {
                $message = "authentification reussite";
                $request->session()->regenerate();
                $user = $gestionnaire;
                $user['token'] = $user->createToken('my-app-token')->plainTextToken;


                return $this->sendResponse($user, $message);
            } else {
                $errors = [
                    'email' => [],
                    'password' => [' le mot de pass saisie est incorrect ']
                ];

                return $this->sendError($errors, $message, 401);
            }
        } else {
            $errors = [
                'email' => ['l\'adresse email saisie est incorrect '],
                'password' => []
            ];

            return $this->sendError($errors, $message, 401);
        }
    }

    public function Mairie_SeeInfoChidDec(Request $request)
    {
        request()->validate([
            'code' => 'required|string',
        ]);

        $extrait = ExtraitNaissance::where('Code_Generer', $request->code)->OrderBy("created_at", "desc")->first();

        if ($extrait) {
            $message = "Information accessible ";
            return $this->sendResponse($extrait, $message);
        } else {
            $errors['code'][0] = "le code est incorrecte ";
            $message = "Information inaccessible ";
            return $this->sendError($errors, $message);
        }
    }

    public function Mairie_EnregisteExtrait(Request $request)
    {


        request()->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'nom_pere' => 'required|string',
            'prenom_pere' => 'required|string',
            'num_tel_pere' => 'required|string',
            'num_cni_pere' => 'required|string',
            'nom_mere' => 'required|string',
            'prenom_mere' => 'required|string',
            'num_tel_mere' => 'required|string',
            'num_cni_mere' => 'required|string'
        ]);

        $extrait = ExtraitNaissance::where('code_Generer', $request->code)->first();

        $extrait->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'nom_pere' => $request->nom_pere,
            'prenom_pere' => $request->prenom_pere,
            'nom_mere' => $request->nom_mere,
            'prenom_mere' => $request->prenom_mere,
            'num_tel_pere' => $request->num_tel_pere,
            'num_tel_mere' => $request->num_tel_mere,
            'num_cni_pere' => $request->num_cni_pere,
            'num_cni_mere' => $request->num_cni_mere,
        ]);

        CodeDecNais::where(['codeGenerer' => $request->code])->update(['status' => 100]);
        // return request();


        $num_acte = random_int(1040, 3850);
        $date_acte = date_format(now(), 'd/m/Y');

        $newRegistre = RegistreNaissance::create([
            'numero_acte' => $num_acte,
            'date_numero_acte' => $date_acte,
            'nom' => $request->nom,
            'prenoms' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'heure_de_naissance' => $request->heure_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'nom_pere' => $request->nom_pere,
            'prenom_pere' => $request->prenom_pere,
            'nom_mere' => $request->nom_mere,
            'prenom_mere' => $request->prenom_mere
        ]);

        return $this->sendResponse($newRegistre, "enregistrement effectuer avec succees");
    }

    public function Mairie_RegistresNaissance()
    {
        $registres = RegistreNaissance::OrderBy("created_at", "desc")->get();

        return $this->sendResponse($registres, "liste obtenue  avec succees");
    }


    public function getStringMonth($m)
    {
        switch ($m) {
            case 1:
                return 'janvier';
            case 2:
                return 'fevrier';
            case 3:
                return 'mars';
            case 4:
                return 'avril';
            case 5:
                return 'mai';
            case 6:
                return 'juin';
            case 7:
                return 'juillet';
            case 8:
                return 'aout';
            case 9:
                return 'septembre';
            case 10:
                return 'octobre';
            case 11:
                return 'novmbre';
            case 12:
                return 'decembre';
            default:
                # code...
                break;
        };
    }

    public function laodViewPDF($num_acte)
    {
        $registre = RegistreNaissance::where([
            'numero_acte' => $num_acte
        ])->first();

        // PARTIE DATE DE NAISSANCE 

        $heure = explode(":", $registre->heure_de_naissance);

        $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);

        $heure_finale = $f->format(intval($heure[0])) . ' heures ' . $f->format($heure[1]) . ' minutes';

        $date = explode("-", $registre->date_naissance);


        $date_finale = $f->format(intval($date[2])) . ' ' . $this->getStringMonth(intval($date[1])) . ' ' . $f->format($date[0]);

        //    dd($date_finale, $heure_finale);

        $registre->date_naissance = $date_finale;
        $registre->heure_de_naissance = $heure_finale;

        $lieu_naissance =  explode(" ", $registre->lieu_naissance);
        // dd($lieu_naissance[count($lieu_naissance)-1]);


        // FIN DE LA PARTIE DATE NAISSANCE 


        // PARTIE MARIAGE
        
        if($registre->date_mariage)
        {
            $date = explode("-", $registre->date_mariage);


            $heure_finale_mariage = $f->format(intval($date[2])) . ' ' . $this->getStringMonth(intval($date[1])) . ' ' . $f->format($date[0]);

            //    dd($date_finale, $heure_finale_mariage);

            $registre->date_mariage = $heure_finale_mariage;
        }
        


        // FIN DE LA PARTIE DE MARIAGE 


        // PARTIE DECES

        if($registre->date_deces)
        {
             $date_dec = explode("-", $registre->date_deces);


            $heure_finale_mariage = $f->format(intval($date_dec[2])) . ' ' . $this->getStringMonth(intval($date_dec[1])) . ' ' . $f->format($date_dec[0]);

            //    dd($date_finale, $heure_finale_mariage);

            $registre->date_deces = $heure_finale_mariage;
        }

       

        // FIN DE LA PARTIE DECES 


        $registre->lieu_naissance = $lieu_naissance[count($lieu_naissance) - 1];


        $annee = explode("/", $registre->date_numero_acte);
        $registre->annee = $annee[2];

        $date_delivrance = explode(" ", $registre->updated_at)[0];
        $date_del = explode("-", $date_delivrance);
        $registre->date_delivrance = $date_del[2] . ' ' . $this->getStringMonth(intval($date_del[1])) . ' ' . $date_del[0];


        return $this->sendResponse($registre, "informations obtenues avec succees");
    }
}
