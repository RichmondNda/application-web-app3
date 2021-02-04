@component('mail::message')
# Introduction

<img src="data:image/png;base64, {!! $registre->qr_code !!}">

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent