<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hopital declaration décés reussie</title>
</head>

<body>

    <p>
        <h1>Toutes Nos Condoléances !</h1>
    </p>
    <br>
    <p style="font-size: 16px">Pour terminier la declaration de décès de {{$nouveau_deces->nom_du_mort}}
        {{$nouveau_deces->prenom_du_mort}} veillez vous rendre sur notre site web et terminier le proccessus.
        Le code de validation est :
        <span style="font-weight: 900; font-size:20px; color:red">
            {{$nouveau_deces->Code_Generer}}
        </span>
    </p>
    <p>
        La prochaine étapes consiste à valider entrant votre
        les nom et prenoms de votre enfant de meme que d'autre information utile
    </p>

</body>

</html>