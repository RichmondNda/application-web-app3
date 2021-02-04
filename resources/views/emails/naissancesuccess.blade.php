@component('mail::message')
# FELICITATION

<p style="font-size: 16px"> Merci d'etre passer a l'hopitale le code generer est :
    <span style="font-weight: 900; font-size:20px; color:red">
        {{ $code }}
    </span>
</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent