@component('mail::message')
# Introduction

Bonjour,

Vous avez reçu un mail de la part de {{ $message['nom']}} ({{$message['email']}}), numéro de téléphone : {{ $message['telephone']}}

Message :

"{{$message['description']}}"

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
