@extends('layouts.app-no-auth')

@section('title') Rooster - Registreren @endsection

@section('stylesheets')
    <style>
        .text-primary, .text-primary-hover a:hover {
            color: #5f9dc4 !important;
        }
    </style>
@endsection

@section('content')
    <!-- ############ LAYOUT START-->
    <div class="center-block w-xxl w-auto-xs p-y-md">
        <div style="min-height: 5.5rem" class="navbar">
            <a style="width: 100%;" class="navbar-brand">
                {{--<div ui-include="'/assets/images/logo.svg'"></div>--}}
                <img style="max-height: 100px; display: flex; margin: auto;" src="/assets/images/rooster-logo.png" alt="">
                {{--<span class="hidden-folded inline">Rooster</span>--}}
            </a>
        </div>
    </div>
    <div class="card col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <signup :data="{{json_encode($signup)}}"></signup>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
@endsection
