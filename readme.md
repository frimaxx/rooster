<p align="center">
<img src="http://i.pi.gy/1O52o.png">
</p>

# Rooster - Gratis bedrijfsrooster maken

Welkom bij Rooster, een project met als doel bedrijven van die oude papieren roosters af te helpen.
Uitgebreidere documentatie zal binnekort komen maar voor nu houd ik het simpel.

## Documentatie

Documentatie over het product komt binnekort. De rest api documentatie is wel al te vinden op: [rooster.frimaxx.com/api-docs](https://rooster.frimaxx.com/api-docs)

## Benodigdheden

- PHP 7.1 of hoger
- SQL database compatible met Laravel
- composer

PHP extensies:
- OpenSSL PHP Extension
-  PDO PHP Extension
-  Mbstring PHP Extension
-  Tokenizer PHP Extension
-  XML PHP Extension
-  Ctype PHP Extension
-  JSON PHP Extension

## Installatie
 
Rooster installeren is eenvoudig voor iedereen die bekend is met Laravel.

Eerst moet de github repo gecloned worden in de web directory.
```console
git clone https://github.com/frimaxx/rooster.git && cd rooster
```
Wanneer het clonen geslaagd is moeten onze composer dependencies worden geinstalleerd
```console
composer install
```
Nu moeten de env variabelen ingesteld worden, creeeër het bestand met het onderstande commando en vul dan de juiste gegevens in het nieuwe .env bestand.
```console
cp .env.example .env
```
Migreer nu de database en maak een applicatie key aan
```console
php artisan migrate && php artisan generate:key
```

**waarschuwing**: zorg ervoor dat nginx/apache2 naar de public directory gewezen staat ivm met veiligheid.

## Licentie

Rooster is gepubliceerd onder de [GPLv2 licentie](LICENSE.txt).