@extends('layouts.app')

@section('title') Nieuw bedrijf toevoegen @endsection

@section('stylesheets')
    <!-- stylesheets here !-->
@endsection

@section('content')

    <div class="padding">
        <div class="col-md-6">
            <h1 style="margin-bottom: 40px">Nieuw bedrijf toevoegen</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <h4 style="margin-bottom: 20px;">Bedrijfs informatie</h4>
                <div class="form-group row {{ $errors->has('naam') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Naam</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Naam bedrijf"  type="text" class="form-control" name="naam" value="{{ old('naam') }}">

                        @if ($errors->has('naam'))
                            <span class="help-block">
                                <strong>{{ $errors->first('naam') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('plaatsnaam') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Plaatsnaam</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Plaatsnaam"  type="text" class="form-control" name="plaatsnaam" value="{{ old('plaatsnaam') }}">

                        @if ($errors->has('plaatsnaam'))
                            <span class="help-block">
                                <strong>{{ $errors->first('plaatsnaam') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('adres') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Adres</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Adres" type="text" class="form-control" name="adres" value="{{ old('adres') }}">

                        @if ($errors->has('adres'))
                            <span class="help-block">
                                <strong>{{ $errors->first('adres') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('postcode') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Postcode</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Postcode"  type="text" class="form-control" name="postcode" value="{{ old('postcode') }}">

                        @if ($errors->has('postcode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('postcode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('kleur') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Kleur Thema</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Kleur Thema" id="kleurInput" type="text" class="form-control jscolor {onFineChange:'updateColor(this)'}" name="kleur" value="@if(!empty(old('kleur'))){{ old('kleur') }}@else #6887ff @endif">

                        @if ($errors->has('kleur'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kleur') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('tekst_kleur') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Tekst Kleur Thema</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Tekst kleur Thema" type="text" class="form-control jscolor {onFineChange:'updateTextColor(this)'}" name="tekst_kleur" value="{{ old('tekst_kleur') }}">

                        @if ($errors->has('tekst_kleur'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tekst_kleur') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('logo') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Logo</label>
                    <div class="col-md-9">
                        <input type="file" name="logo" class="form-control" value="{{old('logo')}}">

                        @if ($errors->has('logo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                        @endif
                        <span>Optimale upload resolutie: 190x40</span>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('klein_logo') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Klein Logo</label>
                    <div class="col-md-9">
                        <input type="file" name="klein_logo" class="form-control" value="{{old('klein_logo')}}">

                        @if ($errors->has('klein_logo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('klein_logo') }}</strong>
                            </span>
                        @endif
                        <span>Optimale upload resolutie: 50x50</span>
                    </div>
                </div>

                <h4 style="margin-bottom: 20px;">Eigenaar account</h4>

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
                            <input autocomplete="off" placeholder="Wachtwoord" type="password" class="form-control" name="password" value="{{ old('password') }}">

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
                            <input autocomplete="off" placeholder="Wachtwoord herhalen"  type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-11">
                        <input value="Nieuw bedrijf toevoegen" type="submit" class="btn btn-primary pull-right">
                    </div>
                </div>

                {{csrf_field()}}
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="/js/jscolor.min.js"></script>
@endsection