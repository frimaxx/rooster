<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">

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

    <link rel="stylesheet" href="/css/general.css">
    <link rel="stylesheet" href="/css/planner.css">

    @if($current_company)
        <style>
            .info {
                @if($current_company->primary_color)
                    background-color: #{{$current_company->primary_color}};
                @endif
                @if($current_company->secondary_color)
                    color: #{{$current_company->secondary_color}};
                @endif
              }
            .comButton {
                @if($current_company->primary_color)
                   background-color: #{{$current_company->primary_color}};
                   border-color: #{{$current_company->primary_color}};
                @endif
                @if($current_company->secondary_color)
                    color: #{{$current_company->secondary_color}};
                @endif
            }
            .dynamic-logo svg, .navbar-brand svg {
                @if($current_company->secondary_color)
                fill: #{{$current_company->secondary_color}};
                @else
                fill: #fff;
                @endif
            }
        </style>
    @endif

    @yield('stylesheets')
</head>
<body>
    <div class="app" id="app">
        @include('layouts.partials.side-nav')

        <div id="content" class="app-content box-shadow-z3" role="main">
            @include('layouts.partials.top-nav')
            <!-- ############ PAGE START-->
                <div class="app-body" id="view">
                    @include('flash::message')

                    @yield('content')
                </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/libs/jquery/jquery/dist/jquery.js"></script>
    <script src="/calendar/js/jquery-ui.min.js"></script>
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
    <script src="/scripts/ui-screenfull.js"></script>
    <script src="/scripts/ui-scroll-to.js"></script>
    <script src="/scripts/ui-toggle-class.js"></script>

    <script src="/scripts/app.js"></script>

    <!-- ajax -->
    <script src="/libs/jquery/jquery-pjax/jquery.pjax.js"></script>
    <script src="/scripts/ajax.js"></script>

    <script>var api_token = '{{ auth()->user()->api_token }}'</script>

    <script src="/js/libs/vue.min.js"></script>
    <script src="/js/libs/axios.min.js"></script>

    <script src="/js/base.js"></script>
    {{--<script src="/js/app.js"></script>--}}

    @yield('scripts')
</body>
</html>
