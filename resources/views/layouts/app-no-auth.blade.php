
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="/assets/images/logo.png">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="/assets/images/logo.png">

    <!-- style -->
    <link rel="stylesheet" href="/assets/animate.css/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/glyphicons/glyphicons.css" type="text/css" />
    <link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/material-design-icons/material-design-icons.css" type="text/css" />

    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <!-- build:css ../assets/styles/app.min.css -->
    <link rel="stylesheet" href="/assets/styles/app.css" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="/assets/styles/font.css" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://rawgit.com/lykmapipo/themify-icons/master/css/themify-icons.css">
    @yield('stylesheets')
</head>
<body>
<div class="app" id="app">

   @yield('content')

</div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
<script src="/libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
<script src="/libs/jquery/tether/dist/js/tether.min.js"></script>
<script src="/libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
<script src="/libs/jquery/underscore/underscore-min.js"></script>
<script src="/libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="/libs/jquery/PACE/pace.min.js"></script>

<script src="/scripts/config.lazyload.js"></script>

<script src="/scripts/palette.js"></script>
<script src="/scripts/ui-load.js"></script>
<script src="/scripts/ui-jp.js"></script>
<script src="/scripts/ui-include.js"></script>
<script src="/scripts/ui-device.js"></script>
<script src="/scripts/ui-form.js"></script>
<script src="/scripts/ui-nav.js"></script>
{{--<script src="/scripts/ui-screenfull.js"></script>--}}
<script src="/scripts/ui-scroll-to.js"></script>
<script src="/scripts/ui-toggle-class.js"></script>

<script src="/scripts/app.js"></script>

<!-- ajax -->
<script src="/libs/jquery/jquery-pjax/jquery.pjax.js"></script>
<script src="/scripts/ajax.js"></script>
<!-- endbuild -->
@yield('scripts')
</body>
</html>
