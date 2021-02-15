<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$registre->prenoms}}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        .entete {
            height: 100px;
        }

        .entete-right {
            width: 65%;
            float: right;
        }

        #entete-right-content {
            float: right;
            margin-right: 20px;
        }

        #entete-right-content-1 {
            float: right;
            margin-right: 80px;
            font-size: 24px;
            font-weight: bold;
        }

        #entete-right-content-2 {
            float: right;
            font-size: 14px;
            text-align: center;
        }

        .entete-left {
            width: 40%;
            float: left;
            padding-left: 15px;
            font-weight: bolder;
            font-size: 14px;
            /* background: yellow; */
        }

        .entete-left #entete_communune {
            padding-left: 25px;
            text-transform: uppercase;
            font-size: 12px
        }

        /*  le centre */

        .centre {
            height: 300px;
            /* background-color: rgb(15, 136, 241);
            background-image: url('images/extrait/armoirie.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: 300px 300px; */
            border-bottom: #131212 solid 4px;
            margin-top: 100px;
        }

        .centre-left {
            float: left;
            width: 43%;
            font-size: 14px;
            text-align: center;

        }

        .centre-right {
            float: right;
            width: 57%;
            background: #ffffff;
            font-size: 20px;
        }

        #logo {
            height: 60px;
            width: 40px;
            border-radius: 50%;
            background: red;
        }
        #logoDistrict{
            margin: auto;
            align-content: center;
            text-align: center;
            display: flex;
            padding-right: 40px ;
        }
        #signature{
            width: 300px;
            height: 100px;
        }
    </style>
</head>

<body>

    <section>
        <div class="entete">
            <div class="entete-left">
                <p>
                    <span style="text-transform: uppercase">DEPARTEMENT DE
                        {{$registre->lieu_naissance,'dddddddddd'}}</span>
                    <br>
                    <br>
                    <span id="entete_communune"> COMMUNE DE {{$registre->lieu_naissance}}</span>
                </p>

                <div id="logoDistrict">
                    <img src="images/abidjan_logo.png" alt="">
                </div>


            </div>
            <div class="entete-right">
                {{-- <img src="images/extrait/armoirie.png"/> --}}
                <p id="entete-right-content">
                    REPUBLIQUE DE COTE D'IVOIRE
                </p>

                <br>
                <p id="entete-right-content-1">
                    EXTRAIT
                </p>
                <br>
                <br>
                <p id="entete-right-content-2">
                    Du registre des actes de naissance de l'Etat Civil
                    <br> Pour l'année {{$registre->annee}}

                </p>
            </div>
        </div>
    </section>
    <section>
        <div class="centre">
            <div class="centre-left">
                <br><br>
                <br> <br>
                <br><br>
                N° {{$registre->numero_acte}} DU {{$registre->date_numero_acte}}DU REGISTRE
                <br>
                <br>
                NAISSANCE DE
                <br><br>
                <strong style="font-size: 18px">{{$registre->nom}} </strong>
                <br><br>
                <strong style="font-size: 18px">{{$registre->prenoms}} ./.</strong>


            </div>
            <div class="centre-right">
                <br>

                {{-- Le ......................... ./.  --}}
                Le {{$registre->date_naissance}} ./.
                <br> <br>
                à {{$registre->heure_de_naissance}} ./.
                <br><br>
                est née {{$registre->prenoms}}./.
                <br><br>
                à la maternité de {{$registre->lieu_naissance}} ./.
                <br><br>
                fils de {{$registre->nom_pere}} {{$registre->prenom_pere}} ./.
                <br><br>
                et de {{$registre->nom_mere}} {{$registre->prenom_mere}} ./.
                <br>
            </div>

        </div>
    </section>
    <section>
        <p style="text-align: center; font-size:24px; font-weight:bold; font-family:'Times New Roman', Times, serif ">
            MENTIONS (éventuellement)
        </p>
        <div style="font-size:16px ; text-align:center">
            
            Marié(e) le 
            @if($registre->date_mariage)
                {{$registre->date_mariage}}
            @else
            ...........................................................................
            @endif
            à
            @if($registre->lieu_mariage)
                {{$registre->lieu_mariage}}
            @else
            ...........................................................................
            @endif
            
            <br><br>
            avec
            @if($registre->nom_conjoint)
                {{$registre->nom_conjoint}}
            @else
            ....................................................................
            @endif
            à
            @if($registre->prenom_conjoint)
                {{$registre->prenom_conjoint}}
            @else
            .................................................................
            @endif
            
            <br><br>
            Mariage dissous par décision de divorce en date du
            ........................................................................................
            <br><br>
            Décédé(e)  le 

            @if($registre->date_deces)
                {{$registre->date_deces}}
            @else
            .............................................
            @endif
             
            à
            @if($registre->lieu_deces)
                {{$registre->lieu_deces}}
            @else
            .......................................................
            @endif
            <br><br>
            Certifie le présent extrait conforme aux indications portées au registre.
        </div>
    </section>
    <section>
        {{-- CODE QR A VOIR  --}}
        {{-- <div style="width:50%; text-align:center;float:left; margin:40px">
            <img src="data:image/png;base64, {!! $registre->qr_code !!}">
        </div> --}}
        <div style="width:50%; text-align:center;float:right; margin:40px; margin-top:10px ">
            <p>
                Délivré à {{$registre->lieu_naissance}} , le {{$registre->date_delivrance}}
                <br>
                <strong> L'Officier de l'Etat civil </strong>
                <pre> (Signature) </pre>
                <img id="signature" src="signatures/mairie.png"/>
            </p>
        </div>
    </section>


</body>

</html>