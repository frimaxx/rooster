@component('mail::message')
# Voltooi uw registratie op Rooster

Bedankt {{$name}} dat u zich heeft aangemeld voor Rooster. Voltooi uw registratie voor {{$company_name}} door op de link hieronder te klikken.

@component('mail::button', ['url' => url('/') . '/confirm/sign-up/' . $token])
Registratie voltooien
@endcomponent

Mocht u nog vragen of opmerkingen hebben dan vernemen wij het graag.

{{--Bedankt,<br>--}}
{{ config('app.name') }}
@endcomponent
