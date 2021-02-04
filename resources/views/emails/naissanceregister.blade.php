@component('mail::message')
# INFORMATION ENREGISTRER
<br>
<br>
<p>
    Non de l'enfant :
    <span class="font-bold text-xl">{{$information['nom']}}</span>
</p>
<p>
    Prenoms de l'enfant :
    <span class="font-bold text-xl ">{{$information['prenoms']}}</span>
</p>
<p class="font-thin">
    La prochaine etape consite a passer dans la Mairie
    Pour pouvoir finir la validation
    et donc vous procurer un document physique .
</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent