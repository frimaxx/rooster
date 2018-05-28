@extends('layouts.app')

@section('title') Filialen zoeken @endsection

@section('stylesheets')
    <!-- stylesheets here !-->
@endsection

@section('content')

    <div class="padding">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <form action="" method="get">
                    <div class="row">

                        <div style="flex-direction: column" class="col-md-12">
                            <input style="display: inline; width: calc(100% - 104px);" id="searchForm" placeholder="Zoeken op: naam, gebruikersnaam of email" type="text" name="q" class="form-control" value="{{$query}}">
                            <input style="display: inline; width: 100px" id="submitButton" type="submit" value="zoeken" class="btn btn-primary">
                        </div>

                        <div class="col-md-12">
                            <p style="margin-top: 10px; margin-bottom: 0;">Klik op een filiaal om deze te bewerken</p>
                        </div>

                    </div>
                </form>

                @if($branches->count() < 1)
                    <p>Er zijn geen branches met deze criteria</p>
                @else
                    @foreach($branches as $branch)
                        <div class="card">
                            <a class="collapsed" data-toggle="collapse" href="#branchCollapse-{{$branch->id}}" aria-expanded="true" aria-controls="collapseTwo">
                                <div class="card-block">
                                    <p class="noPadding"><strong>{{$branch->name}}</strong></p>
                                    <p class="noPadding">FiliaalNummer: {{$branch->reference}}</p>
                                    <p class="noPadding">Adres: {{$branch->address}}, {{$branch->postal_code}} {{$branch->city}}</p>
                                    <p class="noPadding">{{ $employeeCount = App\Models\Employee::where('branch_id', $branch->id)->count() }} {{ str_plural('medewerker',$employeeCount) }} - {{ $managerCount = \App\Models\Manager::where('branch_id', $branch->id)->count() }} {{ str_plural('manager',$managerCount) }}</p>
                                </div>
                            </a>
                            <div id="branchCollapse-{{$branch->id}}" class="collapse @if($branch->id == old('branch')) in @endif" role="tabpanel" aria-labelledby="branchCollapse-{{$branch->id}}" data-parent="#branchCollapse-{{$branch->id}}">
                                <div class="card-block">
                                    <div style="margin:0; padding:0;" class="card-body collapse-body">
                                        @if(!in_array($branch->id, $authorizedBranchesIdsArray))
                                            <p class="noPadding">U bent niet gemachtigd om dit filiaal te bewerken</p>
                                        @else
                                            @if(count($errors) < 1 && $branch->id == old('branch') )
                                                <p class="noPadding" style="color: forestgreen; margin-bottom: 10px"><strong>Filiaal bijgewerkt</strong></p>
                                            @endif
                                            <form action="{{route('update.branch')}}" method="post">
                                                <input type="hidden" name="branch" value="{{$branch->id}}">
                                                <div class="form-group @if(old('branch') == $branch->id && $errors->has('naam')) has-danger @endif">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label style="margin-top: 8px;" class="control-label" for="name">Naam</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input required minlength="6" type="text" class="form-control" name="naam" value="{{!empty(old('naam')) ? old('naam') : $branch->name}}">
                                                            @if ($errors->has('naam'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('naam') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group @if(old('branch') == $branch->id && $errors->has('referentie')) has-danger @endif">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label style="margin-top: 8px;" class="control-label" for="name">Referentie</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input required minlength="3" type="text" class="form-control" name="referentie" value="{{!empty(old('referentie')) ? old('referentie') : $branch->reference}}">
                                                            @if ($errors->has('referentie'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('referentie') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group @if(old('branch') == $branch->id && $errors->has('plaatsnaam')) has-danger @endif">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label style="margin-top: 8px;" class="control-label" for="name">Stad</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input required minlength="3" type="text" class="form-control" name="plaatsnaam" value="{{!empty(old('plaatsnaam')) ? old('plaatsnaam') : $branch->city}}">
                                                            @if ($errors->has('plaatsnaam'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('plaatsnaam') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group @if(old('branch') == $branch->id && $errors->has('adres')) has-danger @endif">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label style="margin-top: 8px;" class="control-label" for="name">Adres</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input required minlength="3" type="text" class="form-control" name="adres" value="{{!empty(old('adres')) ? old('adres') : $branch->address}}">
                                                            @if ($errors->has('adres'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('adres') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group @if(old('branch') == $branch->id && $errors->has('postcode')) has-danger @endif">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label style="margin-top: 8px;" class="control-label" for="name">Postcode</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input required minlength="5" type="text" class="form-control" name="postcode" value="{{!empty(old('postcode')) ? old('postcode') : $branch->postal_code}}">
                                                            @if ($errors->has('postcode'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('postcode') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-11">
                                                            <input type="submit" value="Opslaan" class="btn btn-primary pull-right">
                                                            @if(Auth::user()->level() > 3)
                                                                <button style="margin-right: 10px" type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#deleteBranchModal-{{$branch->id}}">
                                                                    Filiaal verwijderen
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                {{csrf_field()}}
                                            </form>
                                            @if(Auth::user()->level() > 3)
                                                    <div class="modal fade" id="deleteBranchModal-{{$branch->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteBranchModal" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Filiaa {{$branch->name}} verwijderen</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{route('delete.branch')}}" method="post">
                                                                        <input type="hidden" name="branch" value="{{$branch->id}}">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                                                                        <button type="submit" class="btn btn-danger">Verwijderen</button>
                                                                        {{csrf_field()}}
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>

    </div>

@endsection