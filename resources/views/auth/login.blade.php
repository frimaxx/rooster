@extends('layouts.app-no-auth')

@section('title') Rooster - Inloggen @endsection

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
        <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
            <div class="m-b text-sm">
                Log in met jouw Rooster account
            </div>
            <form method="post" action="" name="form">
                {{csrf_field()}}
                <div class="md-form-group float-label">
                    <input name="username" type="text" class="md-input" ng-model="user.username" required>
                    <label>Gebruikersnaam of email</label>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="md-form-group float-label">
                    <input name="password" type="password" class="md-input" ng-model="user.password" required>
                    <label>Wachtwoord</label>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="m-b-md">
                    <label class="md-check">
                        <input name="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox"><i class="primary"></i> Onthoud mij
                    </label>
                </div>
                <button style="background: #5f9dc4; color: white;" type="submit" class="btn btn-block p-x-md">Inloggen</button>
            </form>
        </div>

        <div class="p-v-lg text-center">
            <div class="m-b"><a ui-sref="access.forgot-password" href="{{route('password.request')}}" class="text-primary _600">Wachtwoord vergeten?</a></div>
            {{--<div>Do not have an account? <a ui-sref="access.signup" href="signup.html" class="text-primary _600">Sign up</a></div>--}}
        </div>
    </div>
@endsection
