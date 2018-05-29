<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Rooster • Gratis en eenvoudig bedrijfsroosters maken en organiseren</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Vervang jouw papieren bedrijfsroosters met Rooster. Een eenvoudige, toegankelijke en gratis tool voor iedereen.">
    <meta name="keywords" content="Rooster, tool, online rooster, online, roosters" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:image" content="/assets/images/logo.png">
    <meta property="twitter:site" content="@rooster">
    <meta name="twitter:description" content="Vervang jouw papieren bedrijfsroosters met Rooster. Een eenvoudige, toegankelijke en gratis tool voor iedereen." />
    <meta property="twitter:title" content="Rooster • Snel en gemakkelijk roosters maken en delen">
    <meta property="og:title" content="Rooster • Snel en gemakkelijk roosters maken en delen" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{url('/')}}" />
    <meta property="og:image" content="{{url('/')}}/assets/images/logo.png" />
    <meta property="og:description" content="Vervang jouw papieren bedrijfsroosters met Rooster. Een eenvoudige, toegankelijke en gratis tool voor iedereen." />
    <meta property="og:locale" content="nl_NL">

    <link rel='icon' href="/assets/images/logo.png" sizes="256x256" type="image/png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.5/ladda-themeless.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/snackbarjs/1.1.0/snackbar.min.css">
    <link rel="stylesheet" href="/css/landing.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-99083652-3"></script>
   @if(env('APP_ENV') == 'production')
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{env('GOOGLE_ANALYTICS')}}');
    </script>
   @endif
</head>
<body>

<!-- START NAV -->
<nav class="navbar navbar-expand-lg bg-light navbar-light bg-faded">
    <div class="container">
        <a class="navbar-brand scroll-link" data-href="home">
            <span class="logo">
                <svg id="Laag_1" data-name="Laag 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 191.5 63.83"><defs></defs><title>Tekengebied 13</title><path class="cls-1" d="M33.79,19.33C31.24,16,21.85,15,20.91,22.68c2.51-4.71,11.2-1.54,7.76,7.67-2.58,6.9-4.74,18.53-5,27.71,4.37-16.44,11-37.73,31.73-47.89C47.32,9.73,38.22,13.62,33.79,19.33Z"></path><path class="cls-2" d="M45.28,10.25a2.16,2.16,0,0,1-2.82-1.84c0-1.41,1-2.49,2.79-2.63C47.62,5.61,49.87,6.91,52,9.2A36.21,36.21,0,0,0,45.28,10.25Z"></path><path class="cls-3" d="M20.32,24.79c-.68-5.48,2.28-8.14,5.89-8.76,2.91-.5,6.36.67,7.63,2.08,1.18-6-5.73-9.51-11.14-5.59C19.43,14.88,17.62,19.53,20.32,24.79Z"></path><path class="cls-1" d="M44.37,37.09q0-8.14,2.27-12.25a7.57,7.57,0,0,1,13.49,0q2.28,4.17,2.28,12.21T60.15,49.35a7.24,7.24,0,0,1-6.71,4.15,7.32,7.32,0,0,1-6.8-4.12Q44.37,45.26,44.37,37.09Zm9-13q-2.61,0-3.81,3.09t-1.21,9.94q0,6.88,1.21,10t3.81,3.12q2.54,0,3.78-3.2t1.24-9.83q0-6.66-1.24-9.89T53.38,24.07Z"></path><path class="cls-1" d="M67.94,37.09q0-8.14,2.27-12.25a7.57,7.57,0,0,1,13.49,0Q86,29.05,86,37.09T83.72,49.35A7.24,7.24,0,0,1,77,53.5a7.32,7.32,0,0,1-6.8-4.12Q67.95,45.26,67.94,37.09Zm9-13q-2.61,0-3.81,3.09t-1.21,9.94q0,6.88,1.21,10T77,50.22q2.54,0,3.78-3.2T82,37.19q0-6.66-1.24-9.89T77,24.07Z"></path><path class="cls-1" d="M91.85,46.71a10.89,10.89,0,0,0,2.93,2.48,6.24,6.24,0,0,0,3.06.84,4.76,4.76,0,0,0,5-5q0-2.67-4.82-6.79a5.88,5.88,0,0,1-.45-.39,24.08,24.08,0,0,1-5-5.16,8.12,8.12,0,0,1-1.13-4.2A7.44,7.44,0,0,1,93.62,23a7.61,7.61,0,0,1,5.6-2.17,10.28,10.28,0,0,1,2.85.4,11,11,0,0,1,2.75,1.24v4a8.92,8.92,0,0,0-2.54-1.77,6.44,6.44,0,0,0-2.67-.61,4.45,4.45,0,0,0-3.18,1.22,4,4,0,0,0-1.29,3.06q0,2.57,4.47,6.31l.26.22a26.19,26.19,0,0,1,5.44,5.55A8.64,8.64,0,0,1,106.52,45a8.53,8.53,0,0,1-2.38,6.21,8.08,8.08,0,0,1-6,2.44A9.4,9.4,0,0,1,94.76,53a9.76,9.76,0,0,1-2.91-1.7Z"></path><path class="cls-1" d="M114.17,24.58h-3.28V21.36h3.28V12.55h3.89v8.81h5.21v3.22h-5.21V52.92h-3.89Z"></path><path class="cls-1" d="M144.66,38.09H130.9v1.06a19.6,19.6,0,0,0,1.35,8.12q1.35,2.88,3.73,2.88a3.66,3.66,0,0,0,3.2-2.07,11.55,11.55,0,0,0,1.33-5.61h3.76a14.1,14.1,0,0,1-2.48,8.07,7.39,7.39,0,0,1-12.5-1.08q-2.2-4-2.2-12.08t2.38-12.26q2.38-4.34,6.63-4.34a6.88,6.88,0,0,1,6.4,4.1Q144.66,29,144.66,37ZM141,34.87a19.91,19.91,0,0,0-1.27-7.78q-1.24-2.77-3.46-2.77t-3.75,2.73a19.17,19.17,0,0,0-1.59,7.82Z"></path><path class="cls-1" d="M151.25,21.36h3.89v4.28a7.59,7.59,0,0,1,2.17-3.38c2-1.48,4.52-1.48,6.41-1.48V25a7.59,7.59,0,0,0-7.44,2.22c-1,1.07-1.14,3.53-1.14,6.85V52.92h-3.89Z"></path><rect class="cls-1" x="153.66" y="48.04" width="3.86" height="5.9" transform="translate(104.59 206.57) rotate(-90)"></rect></svg>
            </span>
        </a>
        <button id="mobile-nav" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <a id="mobile_demo" class="nav-link demo-btn" data-toggle="modal" data-target="#signupModalContent">Gratis aanmelden</a>

            <span id="mobile-nav-toggle" class="navbar-toggler-icon not-grey"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link scroll-link" data-href="features">Functionaliteiten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll-link" data-href="pricing">Tarieven</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll-link" data-href="mission">Missie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link scroll-link" data-href="contact">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/login">Inloggen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link demo-btn" data-toggle="modal" data-target="#signupModalContent">Gratis aanmelden</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="nav-mobile">
    <span class="dismiss-menu">x</span>
    <a style="text-decoration: none" class="scroll-link" data-href="features">
        <div class="row mobile-link">
            <p class="link-text">Functionaliteiten</p>
        </div>
    </a>
    <a style="text-decoration: none" class="scroll-link" data-href="pricing">
        <div class="row mobile-link">
            <p class="link-text">Tarieven</p>
        </div>
    </a>
    <a style="text-decoration: none" class="scroll-link" data-href="mission">
        <div class="row mobile-link">
            <p class="link-text">Missie</p>
        </div>
    </a>
    <a style="text-decoration: none" class="scroll-link" data-href="contact">
        <div class="row mobile-link">
            <p class="link-text">Contact opnemen</p>
        </div>
    </a>
    <a style="text-decoration: none" href="/login">
        <div class="row mobile-link">
            <p class="link-text">Inloggen</p>
        </div>
    </a>
</div>
<!-- END NAV -->

<!-- START HERO -->
<div id="home" class="hero">
   <h1 class="heroText text-center">
       Eenvoudig en gemakkelijk <br>
       <span id="cyclingText">roosters maken</span>
   </h1>
    <div class="text-center hero-footer">
        <button data-toggle="modal" data-target="#signupModalContent" class="demo-btn-hero">Gratis aanmelden</button>
        <p class="pt-4">Of neem <a data-href="contact" class="scroll-link" style="color:#007bff;">contact</a> op over de mogelijkheden</p>
    </div>
</div>
<!-- END HERO -->

<!-- START FEATURES -->
<div id="features" class="features grey-section pb-4">
    <div class="container">
        <div class="row pt-5 pb-3">
            <div class="col-md-5">
                <h2 class="sub-heading mb-3">Gebouwd voor gebruikers</h2>
                <p class="sub-paragraph">Rooster is gebouwd met slechts één ding in gedachte. Het moet toegankelijk zijn voor iedereen.
                    Wij stellen Rooster daarom gratis beschikbaar, en we doen er dan ook alles aan om te zorgen dat jij makkelijk overweg kunt met onze software.</p>
                <hr class="blue-line">

                <div class="mobile-padding">
                    <div class="row mt-5">
                        <img src="/assets/images/icons/startup.svg" class="feature-icon" alt="rocket-icon">
                        <h2 class="ml-3">Snel in gebruik</h2>
                        <p class="sub-paragraph mt-3 col-md-11 feature-text">Of het nou gaat om het bekijken of aanpassen van je Rooster.
                            Wij zorgen ervoor dat Rooster altijd optimaal presteert.</p>
                    </div>
                    <div class="row mt-4">
                        <img src="/assets/images/icons/database.svg" class="feature-icon" alt="database-icon">
                        <h2 class="ml-3">Live updates</h2>
                        <p class="sub-paragraph mt-3 col-md-11 feature-text">Alles wat je doet gebeurt direct. Zo raak je nooit iets kwijt als
                            je per ongeluk je browser af sluit, of onverwachts weg moet.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <img class="full-width" src="/assets/images/promos/promo-1-big.png" alt="gratis bedrijfsroosters maken">
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row devices-row">
        <div style="height: 520px" class="col-sm-12 col-md-pull-7 col-md-7" id="devices_showcase">
            <img class="macbook" src="/assets/images/promos/macbook.png" alt="macbook-screen">
            <img class="iphone" src="/assets/images/promos/iphone.png" alt="iphone-screen">
        </div>
        <div class="col-sm-12 col-md-push-5 col-md-5">
            <h1 class="sub-heading pt-5">Rooster werkt op alle apparaten</h1>
            <p class="sub-paragraph pt-2 pl-0 col-md-11 feature-text">Omdat de wereld om ons heen steeds mobieler aan het
                worden is, vinden wij dat jij altijd je rooster moet kunnen bekijken. <br>
                We zorgen er daarom voor dat onze applicatie werkt op alle schermen en formaten.
        </div>
    </div>
</div>
<!-- END FEATURES -->

<!-- START PRICING -->
<div id="pricing" class="wave"></div>
<div class="light-blue-section text-center heroText white-text">
    <h1 class="pricing-text">
        Onze tarieven
        <br>
        <span style="font-size: 19px">Een rooster voor iedereen</span>
    </h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-lg-2 col-lg-4">
            <div class="pricing-card text-center">
                <div class="pricing">
                    <div class="planDescription">
                        Regulier
                    </div>
                    <span class="subDescription">Gratis gebruik maken van Rooster</span>
                </div>
                <h3 class="price mt-3">€0</h3>
                <span class="subDescription">Zonder kleine lettertjes</span>
                <div class="pricing-features">
                    <table class="ml-4 mt-5" border="0" cellpadding="1" cellspacing="1" width="100%">
                        <tbody>
                            <tr>
                                <td width="25px">
                                    <img class="feature-check" src="/assets/images/promos/blue-check.svg" alt="blue check">
                                </td>
                                <td style="text-align: left;">
                                    <span>Bedrijf naar huisstijl aanpassen</span>
                                </td>
                            </tr>
                            <tr>
                                <td width="25px">
                                    <img class="feature-check" src="/assets/images/promos/blue-check.svg" alt="blue check">
                                </td>
                                <td style="text-align: left;">
                                    <span>Overal toegang tot het rooster</span>
                                </td>
                            </tr>
                            <tr>
                                <td width="25px">
                                    <img class="feature-check" src="/assets/images/promos/blue-check.svg" alt="blue check">
                                </td>
                                <td style="text-align: left;">
                                    <span>Gratis tot 50 gebruikers</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button style="width: 80%; margin-top: 42px" type="submit" class="btn btn-primary submitButton" data-toggle="modal" data-target="#signupModalContent">Gratis aanmelden</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div style="margin-bottom: 0" class="pricing-card text-center">
                <div class="pricing">
                    <div class="planDescription">
                        Premium
                    </div>
                    <span class="subDescription">De volledige rooster experience</span>
                </div>
                <h3 class="price mt-3">€1,50</h3>
                <span class="subDescription">Per medewerker per maand</span>
                <div class="pricing-features">
                    <table class="ml-3 mt-5" border="0" cellpadding="1" cellspacing="1" width="100%">
                        <tbody>
                        <tr>
                            <td width="25px">
                                <img class="feature-check" src="/assets/images/promos/blue-check.svg" alt="blue check">
                            </td>
                            <td style="text-align: left;">
                                <span>Bedrijf naar huisstijl aanpassen</span>
                            </td>
                        </tr>
                        <tr>
                            <td width="25px">
                                <img class="feature-check" src="/assets/images/promos/blue-check.svg" alt="blue check">
                            </td>
                            <td style="text-align: left;">
                                <span>Overal toegang tot het rooster</span>
                            </td>
                        </tr>
                        <tr>
                            <td width="25px">
                                <img class="feature-check" src="/assets/images/promos/blue-check.svg" alt="blue check">
                            </td>
                            <td style="text-align: left;">
                                <span>Uitgebreide support</span>
                            </td>
                        </tr>
                        <tr>
                            <td width="25px">
                                <img class="feature-check" src="/assets/images/promos/blue-check.svg" alt="blue check">
                            </td>
                            <td style="text-align: left;">
                                <span>Oneindig aantal werknemers</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button data-href="contact" style="width: 80%" type="submit" class="btn btn-primary submitButton mt-3 scroll-link">Contact opnemen</button>
                </div>
            </div>
        </div>
    </div>

    <p class="text-center mt-3">
        <a href="https://github.com/frimaxx/rooster" target="_blank">Host Rooster zelf. Gratis en voor niets.</a>
    </p>
</div>
<!-- END PRICING -->

<!-- START MISSION -->
<div id="mission" class="container mt-5">
    <div class="row pt-4">
        <div class="col-md-6">
            <h1 class="header">Onze missie</h1>
            <p class="sub-paragraph">Onze missie is om bedrijven van onhandige papieren roosters af te helpen.
                Dit doen we door een eenvoudige, simpele, en elegante applicatie aan te bieden voor bedrijven.
                Ook is Rooster helemaal gratis en <a target="_blank" href="https://github.com/frimaxx/rooster">open source</a>.
                Zo kan iedereen aan online bedrijfsroosters geholpen worden.</p>
        </div>
        <div class="col-md-6 mission-items">
            <h3 class="mission-tag"><img src="/assets/images/icons/people.svg" alt="people">Één community</h3>
            <p>Bij rooster proberen we zoveel mogelijk te luisteren naar onze community. U bepaalt dus wat onze volgende
            stap word in het doorontwikkelen van Rooster</p>

            <h3 class="mission-tag mt-3"><img src="/assets/images/icons/github.svg" alt="people">Open source</h3>
            <p>Rooster is <a href="https://github.com/frimaxx/rooster" target="_blank">open source</a>. Dat betekend dat iedereen de bouwstenen van Rooster kan bekijken, downloaden,
            en aanpassen voor eigen gebruik.</p>
        </div>
    </div>
</div>
<!-- END MISSION -->

<!-- START CONTACT -->
<div id="contact" class="grey-section mt-5 pt-4 pb-4">
    <h1 class="header text-center">Contact opnemen</h1>
    <p class="sub-paragraph text-center pl-2 pr-2">Een vraag, suggestie of gewoon even gedag zeggen? Het kan hier</p>
    <hr class="blue-line">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form id="contact_form">
                    <div class="form-group">
                        <input id="contact_name" type="text" name="name" class="form-control" placeholder="Naam" required minlength="3" maxlength="100">
                    </div>
                    <div class="form-group">
                        <input id="contact_email" type="email" name="email" class="form-control" placeholder="Email" required minlength="3" maxlength="190">
                    </div>
                    <div class="form-group">
                        <textarea  name="message" class="form-control" placeholder="Bericht" id="contact_message" cols="30" rows="6" required minlength="10" maxlength="2000"></textarea>
                    </div>
                    <div class="form-group">
                        <button id="submitContact" type="submit" class="btn btn-primary submitButton ladda-button" data-style="zoom-in">Verzenden</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-center">Een mailtje sturen kan ook: <a href="mailto:info@frimaxx.com">info@frimaxx.com</a></p>
            </div>
        </div>
    </div>
</div>
<!-- END CONTACT -->

<!-- START FOOTER -->
<footer class="pt-5 pb-5">
    <div class="container">
        <p>Made with &#x2764; by <a style="color: white" href="https://frimaxx.com">Frimaxx</a></p>
    </div>
</footer>
<!-- END FOOTER -->

<!-- START REQUEST DEMO MODAL -->
<div class="modal fade" id="signupModalContent" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="signupModalContent">
            <div class="modal-header">
                <h3 class="modal-title" id="demoModalLabel">Gratis aanmelden</h3>
                <button type="button" class="close closeDemoButton" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="demo_form">
                    <div class="form-group">
                        <input id="demo_name" type="text" class="form-control" placeholder="Volledige naam" name="name" minlength="3" maxlength="100" required>
                        <span style="color: red" id="name_error"></span>
                    </div>
                    <div class="form-group">
                        <input id="demo_email" type="email" class="form-control" placeholder="Email" name="email" required>
                        <span style="color: red" id="email_error"></span>
                    </div>
                    <div class="form-group">
                        <input id="demo_company_name" type="text" class="form-control" placeholder="Bedrijfsnaam" name="bedrijfsnaam" required minlength="3" maxlength="100">
                        <span style="color: red" id="company_error"></span>
                    </div>
                    <div class="row">
                        <div class="col-6" style="padding-right: 4px">
                            <button type="button" class="btn btn-secondary closeDemoButton" data-dismiss="modal" style="width: 100%">Sluiten</button>
                        </div>
                        <div class="col-6" style="padding-left: 4px">
                            <button id="submitDemoButton" type="submit" class="btn btn-primary submitButton ladda-button" data-style="zoom-in"><span class="ladda-label" id="demoLabel">Aanvraag verzenden</span></button>
                        </div>
                    </div>
                </form>
                <div style="display: none;" id="successMessage">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="successMessage">
                                <h2>Uw aanmelding is ontvangen</h2>
                                <p>Volg de instructies die we hebben gestuurd naar uw email adres om de registratie te voltooien.</p>
                            </div>
                            <button id="anotherDemoButton" style="width: 80%" type="submit" class="btn btn-primary submitButton mt-3">Sluiten</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END REQUEST DEMO MODAL -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.5/ladda.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/snackbarjs/1.1.0/snackbar.min.js"></script>
<script src="/js/landing.js"></script>
</body>
</html>