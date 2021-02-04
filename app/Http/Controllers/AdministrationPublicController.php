<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdministrationPublicController extends Controller
{
    public function index()
    {
        return Inertia::render('AdministrationPublic/Index');
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
