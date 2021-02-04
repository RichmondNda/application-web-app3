<?php

namespace App\Http\Controllers;

use App\Mail\NaissancQrcode;
use App\Mail\SendQrCodeMAil;
use App\Models\CodeDecNais;
use App\Models\RegistreNaissance;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use NumberFormatter;
use PDF;

class UserController extends Controller
{
    public function mesdemandes()
    {
        $mes_demandes = CodeDecNais::where('user_id', auth()->user()->id)->OrderBy("created_at", "desc")->get();

        return response()->json($mes_demandes);
    }

    public function demander_nouvelleExtrait()
    {
        return Inertia::render('User/RenExtrait');
    }

    public function QrCodeMail($mot)
    {
        $mot_chiffre = $this->chiffrement($mot);

        $qr_code = base64_encode(QrCode::format('svg')->size(500)->errorCorrection('H')->generate($mot_chiffre));

        Mail::to(auth()->user()->email)->send(new SendQrCodeMAil($qr_code));
    }


    public function laodPDF($num_acte, $code)
    {
        $true_num_acte = $this->get_chiffre_lettre($num_acte, 7);
        $true_code = $this->get_chiffre_lettre($code, 7);

        $registre = RegistreNaissance::where([
            'numero_acte' => $true_num_acte
        ])->first();

        // Partie ou on utilise le chiffrement et on gener un code Qr 

        $code_a_chiffre = $true_code . '' . $registre->nom;

        $mot_chiffre = $this->chiffrement($code_a_chiffre);

        $QRCODE = QrCode::size(500)->generate($code_a_chiffre);

        Mail::to(auth()->user()->email)->send(new NaissancQrcode($QRCODE));


        $registre->qr_code = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate($mot_chiffre));


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

    public function demanderSonExtrait(Request $request)
    {
        request()->validate([
            'numero_extrait' => 'required|string',
            'vue_date_numero_extrait' => 'required'
        ]);

        $le_registre = RegistreNaissance::where([
            'numero_acte' => $request->numero_extrait,
            'date_numero_acte' => $request->date_numero_extrait
        ])->first();



        if ($le_registre) {

            $num_acte_chiffre = $this->set_chiffre_lettre($le_registre->numero_acte, 7);

            $registre['numero_acte'] = $num_acte_chiffre;
            $registre['code'] = $this->set_chiffre_lettre($request->code, 7);

            //  Partie ou on renvoir sur la bonne page 

            return Inertia::render('User/Payment', ['extrait' => $registre]);
        } else {
            return redirect()->back()->with('error', 'Les informations saisie sont incorrectes !');
        }
    }

    public function SeePayment()
    {
        return Inertia::render('User/Payment');
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
        // dd(($mots));

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


    public function chiffrement($mot)
    {

        $chiffrement_1 = $this->set_chiffre_lettre($mot, 2);
        $chiffrement_2 = $this->set_chiffre_lettre($chiffrement_1, 8);
        $chiffrement_3 = $this->set_chiffre_lettre($chiffrement_2, 21);

        // return $chiffrement_3;

        return $chiffrement_3;
    }

    public function dechiffrement($mot)
    {


        $dechiffrement_1 = $this->get_chiffre_lettre($mot, 21);
        $dechiffrement_2 =  $this->get_chiffre_lettre($dechiffrement_1, 8);
        $dechiffrement_3 = $this->get_chiffre_lettre($dechiffrement_2, 2);


        return $dechiffrement_3;
    }
}
