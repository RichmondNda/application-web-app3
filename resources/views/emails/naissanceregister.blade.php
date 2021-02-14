@component('mail::message')
# INFORMATIONS ENREGISTRER
<br>
<br>
<p>
    Nom de l'enfant :
    <span style="font-weight: bold; ">{{$information['nom']}}</span>
</p>
<p>
    Prénoms de l'enfant :
    <span style="font-weight: bold; ">{{$information['prenoms']}}</span>
</p>
<p class="font-thin">
    La prochaine étape consiste à se rendre à la Mairie
    afin de confirmer les informations et valider la déclaration.
    
</p>


Merci.<br>
{{ config('app.name') }}
@endcomponent