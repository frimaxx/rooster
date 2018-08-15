@component('mail::message')
    # Beste {{$newUser['name']}},

{{$manager_name}} heeft zojuist een account voor u aangemaakt bij Rooster.
Uw inloggegevens hiervoor zijn:

    Gebruikersnaam: {{$newUser['username']}}
    Wachtwoord: {{$newUser['password']}}

U kunt inloggen door op <a href="{{route('login')}}">deze</a> link te klikken.

Mocht de aanmelding een vergissing zijn neem dan contact op met <a href="mailto:info@frimaxx.com">info@frimaxx.com</a>


{{ config('app.name') }}
@endcomponent
