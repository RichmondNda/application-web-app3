<?php

namespace App\Http\Controllers;

use App\Mail\HopitalDecesSuccess;
use App\Models\CodeDecNais;
use App\Models\décè;
use App\Models\ExtraitNaissance;
use App\Models\RegistreNaissance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class DécèController extends BaseController
{
    public function EnNouveauDeces(Request $request)
    {
        request()->validate([
            'nom_parent' => 'required|string',
            'prenom_parent' => 'required|string',
            'email_parent' => 'required|email',
            'email_confirmateur' => 'required|email',
            'nom_du_mort' => 'required|string',
            'prenom_du_mort' => 'required|string',
            'heure_deces' => 'required|string',
            'cause_deces' => 'required|string',
            'ville_deces' => 'required|string',
            'sexe_mort' => 'required',
            'medecin_responsable' => 'required|string'
        ]);

        $code = date('Y') . ':' . date('H') . 'Décès-' . date('s') . date('m') . date('i') . date('d');
        $request['Hopital_décés'] = "hopitale generale de treichville ";

        $user = User::where('email', $request->email_confirmateur)->first();

        if ($user) {
            CodeDecNais::create([
                'type' => "décès",
                'codeGenerer' => $code,
                'status' => 50,
                'user_id' => $user->id
            ]);
        }




        $nouveau_deces = décè::create([
            'nom_parent' => $request->nom_parent,
            'prenom_parent' => $request->prenom_parent,
            'nom_du_mort' => $request->nom_du_mort,
            'prenom_du_mort' => $request->prenom_du_mort,
            'sexe_mort' => $request->sexe_mort,
            'Hopital_décés' => $request->Hopital_décés,
            'Code_Generer' => $code,
            'email_parent' => $request->email_parent,
            'email_confirmateur' => $request->email_confirmateur,
            'medecin_responsable' => $request->medecin_responsable,
            'ville_deces' => $request->ville_deces,
            'heure_deces' => $request->heure_deces,
            'cause_deces' => $request->cause_deces
        ]);

        // Mail::to($nouveau_deces->email_confirmateur)->send(new HopitalDecesSuccess($nouveau_deces));

        return $this->sendResponse($nouveau_deces->Code_Generer, 'L\'enregistrement a étè effecteur avec succes ');
    }


    public function SeeDeclaration()
    {
        return Inertia::render('Décès/DeclarationdeDeces');
    }

    public function SendCodeDecesDec(Request $request)
    {
        request()->validate([
            'decl_num_extrait' => 'required|string',
            'vue_decl_date_extrait' => 'required|string',
            'decl_ville_extrait' => 'required|string',

            'mort_num_extrait' => 'required|string',
            'vue_mort_date_extrait' => 'required|string',
            'mort_ville_extrait' => 'required|string',

            'code_validation' => 'required|string',
            'lien' => 'required'
        ]);




        $personne_decl = RegistreNaissance::where(['numero_acte' => $request->decl_num_extrait, 'date_numero_acte' => $request->decl_date_extrait])->first();
        //  'lieu_delivrance' => $request->decl_ville_extrait

        if ($personne_decl) {

            $personne_défunte = décè::where(['Code_Generer' => $request->code_validation])->first();


            if ($personne_défunte) {


                //    on verifiera si la personne connecter a le droit d'effectuer la declaration 

                if ($personne_défunte->email_confirmateur == auth()->user()->email) {
                    //  celui qui veux faire la demande est habiliter a la faire 

                    $is_done = CodeDecNais::where([
                        'type' => "décès",
                        'codeGenerer' => $request->code_validation,
                        'status' => 100
                    ]);

                    if ($is_done) {
                        //  Le code n'as pas encore été utilisée

                        //  le defunt est le pere du déclarant 

                        $personne_decl_defunt = RegistreNaissance::where(['numero_acte' => $request->mort_num_extrait, 'date_numero_acte' => $request->mort_date_extrait])->first();
                        //  'lieu_delivrance' => $request->mort_ville_extrait

                        if (($personne_défunte->nom_du_mort == $personne_decl_defunt->nom) && ($personne_défunte->prenom_du_mort == $personne_decl_defunt->prenoms)) {
                            // ici les informations sur l'acte de naissance du defunt sont correctes 

                            if ($request->lien == 'pere') {

                                if (($personne_défunte->nom_du_mort == $personne_decl->nom_pere) && ($personne_défunte->prenom_du_mort == $personne_decl->prenom_pere)) {
                                    //  la validation est effective on peut donc enregistrer 
                                    CodeDecNais::where([
                                        'type' => "décès",
                                        'codeGenerer' => $request->code_validation
                                    ])->update(['status' => 100]);
                                    //  enregistrer le defunt dans la base de donne de la mairie et effectuer les autres formalilé

                                    $personne_decl_defunt->update(['date_deces' => $personne_défunte->created_at, 'lieu_deces' => $personne_défunte->ville_deces]);

                                    $personne_decl_defunt->save();
                                } else {
                                    //  ici le defunt n'est pas le pere du déclarant 
                                    return redirect()->back()->with('error', 'Le défunt n\'est pas votre pére');
                                }

                                //  fin de la partie le defunt est votre pere 
                                // 
                            } else if ($request->lien == 'mere') {
                                //  la defunte est la mere du déclarant

                                if (($personne_défunte->nom_du_mort == $personne_decl->nom_mere) && ($personne_défunte->prenom_du_mort == $personne_decl->prenom_mere)) {
                                    //  la validation est effective on peut donc enregistrer 
                                    CodeDecNais::where([
                                        'type' => "décès",
                                        'codeGenerer' => $request->code_validation
                                    ])->update(['status' => 100]);
                                    //  enregistrer le defunt dans la base de donne de la mairie et effectuer les autres formalilé

                                    $personne_decl_defunt->update(['date_deces' => $personne_défunte->created_at, 'lieu_deces' => $personne_défunte->ville_deces]);

                                    $personne_decl_defunt->save();
                                } else {
                                    //  ici le defunt n'est pas le pere du déclarant 
                                    return redirect()->back()->with('error', 'Le défunt n\'est pas votre mére');
                                }

                                //  fin defun mere du declarant
                            } else if ($request->lien == 'conjoint') {
                                //  la defunte est le conjoint du déclarant

                                if (($personne_défunte->nom_du_mort == $personne_decl->nom_conjoint) && ($personne_défunte->prenom_du_mort == $personne_decl->prenom_conjoint)) {
                                    //  la validation est effective on peut donc enregistrer 
                                    CodeDecNais::where([
                                        'type' => "décès",
                                        'codeGenerer' => $request->code_validation
                                    ])->update(['status' => 100]);
                                    //  enregistrer le defunt dans la base de donne de la mairie et effectuer les autres formalilé

                                    $personne_decl_defunt->update(['date_deces' => $personne_défunte->created_at, 'lieu_deces' => $personne_défunte->ville_deces]);

                                    $personne_decl_defunt->save();
                                } else {
                                    //  ici le defunt n'est pas le pere du déclarant 
                                    return redirect()->back()->with('error', 'Le défunt n\'est pas votre mére');
                                }

                                //  fin de la partie ou le declarant est le conjoint du defunt 
                            }
                        } else {
                            return redirect()->back()->with('error', 'Les infromations sur l\'acte de naissance du defunt sont incorrectes ');
                        }
                    } else {
                        //  Le code a déja été utilisée
                        return redirect()->back()->with('error', 'Une déclaration pour ce defunt a déjà été effectuer !!');
                    }
                } else {
                    //  celui qui desire effectuer la demande n'est pas habilité a l'effectuer 

                    return redirect()->back()->with('error', 'Vous n\'etes pas habiliter à effectuer cette declaration');
                }
            } else {
                return redirect()->back()->with('error', 'Le code est erroner');
            }
        } else {
            return redirect()->back()->with('error', 'Les informations sur le déclarant sont incorrectes');
        }
    }
}
