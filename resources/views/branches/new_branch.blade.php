@extends('layouts.app')

@section('title') Nieuw filiaal maken @endsection

@section('stylesheets')
    <!-- stylesheets here !-->
@endsection

@section('content')

    <div class="padding">
        <div class="col-md-6">
            <h1 style="margin-bottom: 40px">Nieuw filiaal toevoegen</h1>
            <form action="" method="post">
                <div class="form-group row {{ $errors->has('naam') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Naam</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Naam filiaal" id="reference" type="text" class="form-control" name="naam" value="{{ old('naam') }}">

                        @if ($errors->has('naam'))
                            <span class="help-block">
                                <strong>{{ $errors->first('naam') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('referentie') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Referentie</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Filiaalnummer/referentie" id="reference" type="text" class="form-control" name="referentie" value="{{ old('referentie') }}">

                        @if ($errors->has('referentie'))
                            <span class="help-block">
                                <strong>{{ $errors->first('referentie') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('plaatsnaam') ? ' has-danger' : '' }}">
                    <label for="reference" class="col-md-2 control-label">Plaatsnaam</label>
                    <div class="col-md-9">
                        <input autocomplete="off" placeholder="Plaatsnaam" id="reference" type="text" class="form-control" name="plaatsnaam" value="{{ old('plaatsnaam') }}">

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
                        <input autocomplete="off" placeholder="Adres" id="adres" type="text" class="form-control" name="adres" value="{{ old('adres') }}">

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
                        <input autocomplete="off" placeholder="Postcode" id="adres" type="text" class="form-control" name="postcode" value="{{ old('postcode') }}">

                        @if ($errors->has('postcode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('postcode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-11">
                        <input value="Nieuw filiaal maken" type="submit" class="btn btn-primary pull-right">
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