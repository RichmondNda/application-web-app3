<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hôpital déclaration décés reussie</title>
</head>

<body>

    <p>
        <h1>Toutes nos condoléances !</h1>
    </p>
    <br>
    <p style="font-size: 16px">Pour terminier la déclaration de décès de {{$nouveau_deces->nom_du_mort}}
        {{$nouveau_deces->prenom_du_mort}} veuillez vous rendre sur notre site web et terminier le processus .
        Le code de validation est :
        <span style="font-weight: 900; font-size:20px; color:red">
            {{$nouveau_deces->Code_Generer}}
        </span>
    </p>
    

</body>

</html>