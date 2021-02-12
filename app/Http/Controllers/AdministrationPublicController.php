<?php

namespace App\Http\Controllers;

use App\Models\EnregistrementDemande;
use App\Models\Gestionnaire;
use App\Models\RegistreNaissance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use NumberFormatter;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class AdministrationPublicController extends BaseController
{
    public function index()
    {
        return Inertia::render('AdministrationPublic/Index');
    }

    public function decodeQrcode(Request $request)
    {

        // request()->validate([
        //     'code' => 'required',
        // ]);

        $code_dechiffre = $this->dechiffrement($request->code);

        $info_1 = EnregistrementDemande::where('code_qr', $code_dechiffre)->first();
        
        if($info_1)
        {
            $information = [
                'numero' => $info_1->num_acte,
                'date' => $info_1->date_acte,
                'code' => $info_1->code_qr
            ];
            return $this->sendResponse($information, 'ok');
        }
        else {
            // return $this->sendError($errors, $message);
            return $this->sendError( [ 'code' =>'Le code Qr n\'est pas valide!!' ], "ca ne marche pas");
        }
    }


    public function laodUserPdf($code,$numacte,$date)
    {
        
        $the_date = explode('-', $date);
        
        $true_date = $the_date[2].'/'.$the_date[1].'/'.$the_date[0];

        $registre = RegistreNaissance::where([
            'numero_acte' => $numacte,
            'date_numero_acte' => $true_date
        ])->first();

        // Partie ou on utilise le chiffrement et on gener un code Qr 


        $mot_chiffre = $this->chiffrement($code);

        // dd($numacte);


        $registre->qr_code = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate($mot_chiffre));


        // fin de la partie 

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

        $registre->lieu_naissance = $lieu_naissance[count($lieu_naissance) - 1];


        $annee = explode("/", $registre->date_numero_acte);
        $registre->annee = $annee[2];

        $date_delivrance = explode(" ", $registre->updated_at)[0];
        $date_del = explode("-", $date_delivrance);
        $registre->date_delivrance = $date_del[2] . ' ' . $this->getStringMonth(intval($date_del[1])) . ' ' . $date_del[0];


        $pdf = PDF::loadView('testPdf', compact('registre'));

        // return $pdf->download('test3.pdf');
        return $pdf->stream();
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


    //  login





public function login(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $gestionnaire = Gestionnaire::where(['email' => $request->email])->first();

        if (!empty($gestionnaire)) {

            if (Hash::check($request->password, $gestionnaire->password)) {
            
                return redirect()->route('admin.decodeur');

            } else {
                return redirect()->back()->with('error', ' le mot de pass saisie est incorrect');
            }
        } else {
           
            return redirect()->back()->with('error', 'l\'adresse email saisie est incorrect ');
            
        }
    }


    public function decodeindex()
    {
        return Inertia::render('AdministrationPublic/CodeQrValidation');
    }











    // 


     // Partie de chiffrement copier de l'application app_api

    /*
               Patie chiffrement 
    */

    //  CODE PHP POUR CHIFFRER 

    public function set_lettre_id($mes_lettres, $lettre, $key)
    {
        $mes_chiffres = [15, 17, 14, 12, 18, 13, 19, 1, 7, 11];

        $ma_lettre = mb_strtolower($lettre);
        // $mes_lettres = "abcdefghijklmnopqrstuvwxyz";

        $pos = strpos($mes_lettres, $ma_lettre);


        if ($pos) {

            $index = $pos + $key;

            if ($index >= 26) {
                $index = $index - 26;
            }

            return $mes_lettres[$index];
        } else if ($lettre == 'a') {

            $index = $pos + $key;

            if ($index > 26) {
                $index = $index - 26;
            }
            return $mes_lettres[$index];
        } else if ((intval($lettre) != 0)) {

            $chiffre_index = $mes_chiffres[intval($lettre)];

            $index = $chiffre_index + $key;

            if ($index > 26) {
                $index = $index - 26;
            }
            return '0' . $mes_lettres[$index] . '1';
        } else if ($lettre == '0') {

            $chiffre_index = $mes_chiffres[intval($lettre)];

            $index = $chiffre_index + $key;

            if ($index > 26) {
                $index = $index - 26;
            }
            return '0' . $mes_lettres[$index] . '1';
        }
    }

    public function set_chiffre_lettre($mot, $key)
    {


        $cle_chiffrement = $key;
        $mes_lettres = "abcdefghijklmnopqrstuvwxyz";

        $mot_de_cesare = "";

        $mots = explode(' ', $mot);
        // dd(($mots));

        $nb_mots = count($mots) - 1;

        for ($j = 0; $j <= $nb_mots; $j++) {

            $mon_mot = $mots[$j];

            $longeur = (strlen($mon_mot) - 1);

            for ($i = 0; $i <= $longeur; $i++) {
            }

            for ($i = 0; $i <= $longeur; $i++) {
                $lettre = $this->set_lettre_id($mes_lettres, $mon_mot[$i], $cle_chiffrement);
                $mot_de_cesare = $mot_de_cesare . '' . $lettre;
            }
        }


        return $mot_de_cesare;
    }

    public function chiffrement($mot)
    {

        $chiffrement_1 = $this->set_chiffre_lettre($mot, 2);
        $chiffrement_2 = $this->set_chiffre_lettre($chiffrement_1, 8);
        $chiffrement_3 = $this->set_chiffre_lettre($chiffrement_2, 21);

        // return $chiffrement_3;

        return $chiffrement_3;
    }



    // 
    //  PARTIE DE DECHIFFREMENT
    // 

    //  CODE PHP POUR DECHIFFRER 

    public function get_lettre_id($mes_lettres, $lettre, $key)
    {

        $ma_lettre = mb_strtolower($lettre);
        // $mes_lettres = "abcdefghijklmnopqrstuvwxyz";

        $pos = strpos($mes_lettres, $ma_lettre);

        $index = $pos - $key;

        if ($index < 0) {
            $index = $index + 26;
        }
        return $mes_lettres[$index];
    }

    public function get_chiffre_id($mes_lettres, $lettre, $key)
    {

        $mes_chiffres = [15, 17, 14, 12, 18, 13, 19, 1, 7, 11];

        $ma_lettre = mb_strtolower($lettre);
        // $mes_lettres = "abcdefghijklmnopqrstuvwxyz";
        $pos = strpos($mes_lettres, $ma_lettre);


        $index = $pos - $key;



        if ($index < 0) {
            $index = $index + 26;
        }
        // return strpos($mes_chiffres, $index);
        $i = 0;
        while ($mes_chiffres[$i] != $index) {
            $i += 1;
        }
        return $i;
    }


    public function get_chiffre_lettre($mot, $key)
    {

        $cle_chiffrement = $key;
        $mes_lettres = "abcdefghijklmnopqrstuvwxyz";

        $find_chiffre = false;

        $mot_de_cesare = "";

        $mots = explode(' ', $mot);

        $nb_mots = count($mots) - 1;


        for ($j = 0; $j <= $nb_mots; $j++) {

            $mon_mot = $mots[$j];

            $longeur = (strlen($mon_mot) - 1);

            for ($i = 0; $i <= $longeur; $i++) {

                if ($mon_mot[$i] == '0') {
                    $find_chiffre = true;
                } else if ($mon_mot[$i] == '1') {
                    $find_chiffre = false;
                } else {

                    if ($find_chiffre) {
                        $lettre = $this->get_chiffre_id($mes_lettres, $mon_mot[$i], $cle_chiffrement);
                        $mot_de_cesare = $mot_de_cesare . '' . $lettre;
                    } else {
                        $lettre = $this->get_lettre_id($mes_lettres, $mon_mot[$i], $cle_chiffrement);
                        $mot_de_cesare = $mot_de_cesare . '' . $lettre;
                    }
                }
            }
        }

        return $mot_de_cesare;
    }


    public function dechiffrement($mot)
    {


        $dechiffrement_1 = $this->get_chiffre_lettre($mot, 21);
        $dechiffrement_2 =  $this->get_chiffre_lettre($dechiffrement_1, 8);
        $dechiffrement_3 = $this->get_chiffre_lettre($dechiffrement_2, 2);

        return $dechiffrement_3;
    }
}
