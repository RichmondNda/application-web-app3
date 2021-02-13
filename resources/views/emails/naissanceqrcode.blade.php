@component('mail::message')
# Demande d'extrait
Cette image represente votre extrait de naissance numérique.


{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Merci.
<br>
{{ config('app.name') }}
@endcomponent