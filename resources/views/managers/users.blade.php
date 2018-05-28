@extends('layouts.app')

@section('title') Gebruikers zoeken @endsection

@section('stylesheets')
    <!-- stylesheets here !-->
@endsection

@section('content')

    <div class="padding">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <span>Filialen</span>
                            <select class="form-control" name="branch" id="branchSelector">
                                <option @if($branchQuery == 'all') selected @endif value="all">Alle Filialen</option>
                                @foreach($branches as $branch)
                                    <option @if($branchQuery == $branch->id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div style="flex-direction: column" class="col-md-12">
                            <input style="display: inline; width: calc(100% - 104px);" id="searchForm" placeholder="Zoeken op: naam, gebruikersnaam of email" type="text" name="q" class="form-control" value="{{$query}}">
                            <input style="display: inline; width: 100px" id="submitButton" type="submit" value="zoeken" class="btn btn-primary">
                        </div>

                    </div>
                </form>

                @if($users != null)
                    @if($users->count() < 1)
                        <p>Geen resultaten</p>
                    @else
                        @foreach($users as $user)
                            <a class="collapsed" data-toggle="collapse" href="#userCollapse-{{$user->id}}" aria-expanded="true" aria-controls="collapseTwo">
                                <div class="card">
                                    <div style="margin-bottom: -10px;" class="card-block">
                                        <span>Naam: {{$user->name}}</span> <br>
                                        <span>Gebruikersnaam {{$user->username}}</span>
                                    </div>

                                    <div id="userCollapse-{{$user->id}}" class="collapse" role="tabpanel" aria-labelledby="userCollapse-{{$user->id}}" data-parent="#userCollapse-{{$user->id}}">
                                        <div style="margin-left: -5px" class="card-block">
                                            <div class="card-body collapse-body">
                                                <p style="margin:0; padding:0; margin-top: -12px; margin-bottom: 10px; ">Functie: {{$user->readableRank()}}</p>
                                                <strong><p style="margin-bottom: 0; padding-bottom: 0;">Filialen:</p></strong>
                                                @php $branches = $user->branchesEmployee(); @endphp
                                                @if($branches->count() < 1)
                                                    <p>Deze gebruiker zit nog niet in een filiaal</p>
                                                @else
                                                    @foreach($branches as $branch)
                                                        <p style="padding:0; margin:0;">{{$branch->name}} - {{$branch->address}}, {{$branch->city}}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <a style="padding:2px 4px 2px 4px;" href="{{route('user.info', $user->id)}}?branch={{Request::input('branch')}}&q={{Request::input('q')}}" class="btn btn-default pull-right">Gebruiker bewerken</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif
                @endif
            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <!-- scripts here !-->
@endsection