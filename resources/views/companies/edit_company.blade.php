@extends('layouts.app')

@section('title') {{$current_company->name}} bewerken @endsection

@section('stylesheets')
    <!-- stylesheets here !-->
@endsection

@section('content')

    <div class="padding">
        <div class="col-md-6">
            <h1 style="margin-bottom: 40px">{{$current_company->name}} bewerken</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group row {{ $errors->has('naam') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Naam</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Naam bedrijf" id="reference" type="text" class="form-control" name="naam" value="@if(!empty(old('naam'))){{ old('naam') }}@else{{$current_company->name}}@endif">

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
                        <input autocomplete="off" placeholder="Plaatsnaam" id="reference" type="text" class="form-control" name="plaatsnaam" value="@if(!empty(old('plaatsnaam'))){{ old('plaatsnaam') }}@else{{$current_company->city}}@endif">

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
                        <input autocomplete="off" placeholder="Adres" id="adres" type="text" class="form-control" name="adres" value="@if(!empty(old('adres'))){{ old('adres') }}@else{{$current_company->address}}@endif">

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
                        <input autocomplete="off" placeholder="Postcode" id="adres" type="text" class="form-control" name="postcode" value="@if(!empty(old('postcode'))){{ old('postcode') }}@else{{$current_company->postal_code}}@endif">

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
                        <input autocomplete="off" placeholder="Kleur Thema" id="kleurInput" type="text" class="form-control jscolor {onFineChange:'updateColor(this)'}" name="kleur" value="@if(!empty(old('kleur'))){{ old('kleur') }}@else{{$current_company->primary_color}}@endif">

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
                        <input autocomplete="off" placeholder="Tekst kleur Thema" type="text" class="form-control jscolor {onFineChange:'updateTextColor(this)'}" name="tekst_kleur" value="@if(!empty(old('tekst_kleur'))){{ old('tekst_kleur') }}@else{{$current_company->secondary_color}}@endif">

                        @if ($errors->has('tekst_kleur'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tekst_kleur') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if($current_company->logo)
                <div class="form-group row">
                    <label for="reference" class="col-md-2 control-label">Huidig logo</label>
                    <div class="col-md-10">
                        <img src="/assets/images/logos/{{$current_company->logo}}" alt="">
                        <div style="display: inline-block; margin-left: 5px;" class="checkbox">
                            <label><input type="checkbox" name="logo_verwijderen"> Logo verwijderen</label>
                        </div>
                    </div>
                </div>
                @endif

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

                @if($current_company->logo_small)
                    <div class="form-group row">
                        <label for="reference" class="col-md-2 control-label">Huidig klein logo</label>
                        <div class="col-md-10">
                            <img src="/assets/images/logos/{{$current_company->logo_small}}" alt="">
                            <div style="display: inline-block; margin-left: 5px;" class="checkbox">
                                <label><input type="checkbox" name="klein_logo_verwijderen"> Logo verwijderen</label>
                            </div>
                        </div>
                    </div>
                @endif
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

                <div class="row">
                    <div class="col-md-11">
                        <input value="Wijzigingen opslaan" type="submit" class="btn btn-primary pull-right">
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
