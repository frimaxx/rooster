@extends('layouts.app')

@section('title') Nieuwe manager maken @endsection

@section('stylesheets')
    <!-- stylesheets here !-->
@endsection

@section('content')

    <div class="padding">
        <div class="col-md-6">
            <h1 style="margin-bottom: 40px">Nieuwe manager toevoegen</h1>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6 form-group {{ $errors->has('voornaam') ? ' has-danger' : '' }}">
                        <div class="row">
                            <label for="reference" class="col-md-4 control-label">Voor/achternaam</label>
                            <div class="col-md-8">
                                <input autocomplete="off" placeholder="Voornaam" id="voornaam" type="text" class="form-control" name="voornaam" value="{{ old('voornaam') }}">

                                @if ($errors->has('voornaam'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('voornaam') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 form-group {{ $errors->has('achternaam') ? ' has-danger' : '' }}">
                        <div class="row">
                            <div class="col-md-10">
                                <input autocomplete="off" placeholder="Achternaam" id="name" type="text" class="form-control" name="achternaam" value="{{ old('achternaam') }}">
                                @if ($errors->has('achternaam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('achternaam') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>


                <div class="form-group row {{ $errors->has('gebruikersnaam') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Gebruikersnaam</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Gebruikersnaam" id="gebruikersnaam" type="text" class="form-control" name="gebruikersnaam" value="{{ old('gebruikersnaam') }}">

                        @if ($errors->has('gebruikersnaam'))
                            <span class="help-block">
                                <strong>{{ $errors->first('gebruikersnaam') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Email</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label for="reference" class="col-md-2 control-label">Wachtwoord</label>
                        <div class="col-md-9">
                            <input autocomplete="off" placeholder="Wachtwoord" id="wachtwoord" type="password" class="form-control" name="password" value="{{ old('password') }}">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                        <label for="reference" class="col-md-2 control-label">Wachtwoord herhalen</label>
                        <div class="col-md-9">
                            <input autocomplete="off" placeholder="Wachtwoord herhalen" id="wachtwoord" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group {{ $errors->has('filiaal') ? ' has-danger' : '' }}">
                        <label for="reference" class="col-md-2 control-label">Filiaal</label>
                        <div class="col-md-9">
                            <select name="filiaal" class="form-control">
                                @if(empty(old('filiaal')))
                                    <option disabled="" value="" selected>Selecteer filiaal</option>
                                @endif
                                @foreach($branches as $branch)
                                    <option @if(old('filiaal') == $branch->id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('filiaal'))
                                <span class="help-block">
                                <strong>{{ $errors->first('filiaal') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div style="margin-top: 10px;" class="row">
                    <div class="col-md-11">
                        <input value="Manager maken" type="submit" class="btn btn-primary pull-right">
                    </div>
                </div>

                {{csrf_field()}}
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- scripts here !-->
@endsection