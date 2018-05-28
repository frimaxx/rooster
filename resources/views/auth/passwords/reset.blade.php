@extends('layouts.app-no-auth')
@section('title') Wachtwoord resetten @endsection

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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="m-b text-sm">
            Wachtwoord resetten
        </div>
        <form method="post" action="{{ route('password.request') }}" name="form">
            {{csrf_field()}}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="md-form-group float-label">
                <input name="email" type="email" class="md-input" ng-model="user.email" required>
                <label>Email</label>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
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
            <div class="md-form-group float-label">
                <input name="password_confirmation" type="password" class="md-input" ng-model="user.password_confirmation" required>
                <label>Wachtwoord herhalen</label>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <button style="background: #5f9dc4; color: white;" type="submit" class="btn btn-block p-x-md">Wachtwoord resetten</button>
        </form>
    </div>

    <div class="p-v-lg text-center">
        <div class="m-b"><a ui-sref="access.forgot-password" href="{{route('login')}}" class="text-primary _600">Inloggen</a></div>
        {{--<div>Do not have an account? <a ui-sref="access.signup" href="signup.html" class="text-primary _600">Sign up</a></div>--}}
    </div>
</div>
@endsection
