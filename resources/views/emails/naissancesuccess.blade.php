@component('mail::message')
# FELICITATIONS

<p style="font-size: 16px"> Chers parents, le code de déclaration est :
    <br>
    <span style="font-weight: 900; font-size:20px; color:red">
        {{ $code }}
    </span>
</p>

@component('mail::button', ['url' => ''])
Prochaine étape
@endcomponent

Merci <br>
{{ config('app.name') }}
@endcomponent