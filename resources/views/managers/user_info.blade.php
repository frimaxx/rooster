@extends('layouts.app')

@section('title') {{$user->name}} @endsection

@section('stylesheets')
    <!-- stylesheets here !-->
    <style>
        .alert {
            position: fixed;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div id="user">
        <div class="padding">
            <div class="row">
                <div style="margin-bottom: 10px;">
                    <a href="{{ route('manage.users') }}?branch={{Request::input('branch')}}&q={{Request::input('q')}}" class="link">&#8592; Terug naar zoeken</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-block">

                            <div class="user-avatar-row">
                                <img class="user-avatar" src="{{$user->avatar()}}" alt="">
                                <h4 style="display: inline; margin-left: 5px;">{{$user->name}}</h4>
                            </div>

                            <p class="infoText">Gebruikersnaam: {{$user->username}}</p>
                            <p class="infoText">Email: {{$user->email}}</p>
                            <p class="infoText">Functie: {{$user->readableRank()}}</p>
                            <p style="margin-top: 10px" class="infoText">Functie wijzigen</p>
                            <form id="accountLevelForm" action="{{ route('user.change-role', $user->id) }}" method="post">
                                <select onchange="submitChangeRole()" name="account_level" id="accountLevel">
                                    <option @if($user->level() == 1) selected id="defaultLevel" @endif value="medewerker">Medewerker</option>
                                    <option @if($user->level() == 2) selected id="defaultLevel" @endif value="manager">Manager</option>
                                    @if(Auth::user()->level() > 2)
                                        <option @if($user->level() == 3) selected id="defaultLevel" @endif value="rayonManager">Rayon manager</option>
                                    @endif
                                    @if(Auth::user()->level() > 3)
                                        <option @if($user->level() == 4) selected id="defaultLevel" @endif value="eigenaar">Eigenaar</option>
                                    @endif
                                    @if(Auth::user()->level() > 4)
                                        <option @if($user->level() == 5) selected id="defaultLevel" @endif value="admin">Admin</option>
                                    @endif
                                </select>
                                {{csrf_field()}}
                            </form>

                            <div style="margin-top: 5px; margin-bottom: 5px;" class="row">
                                <div class="col-md-12">
                                    <span>min uren</span> <span style="margin-left: 20px;">max uren</span> <br>
                                    <select style="margin-top: 5px;" v-model="uren_min" @change="submitNewHours">
                                        @for($i = 0; $i <= 50; $i++)
                                            <option value="{{$i}}">{{$i}} uur</option>
                                        @endfor
                                    </select>
                                    <select style="margin-left: 10px;" v-model="uren_max" @change="submitNewHours">
                                        @for($i = 0; $i <= 50; $i++)
                                            <option value="{{$i}}">{{$i}} uur</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            @if(Auth::user()->level() > 2)
                                <form id="deleteUserForm" action="{{route('user.deleteUser', $user->id)}}" method="post">
                                    <input @click.prevent="confirmDelete" id="deleteUserBtn" style="margin-top: 10px; padding: 5px 10px 5px 10px;" type="button" value="Gebruiker verwijderen" class="btn btn-danger">
                                    {{csrf_field()}}
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="accordion" role="tablist">

                        <div class="card">
                            <div class="card-header" role="tab" id="branchesEmployee">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#branchesEmployeeCollapse" aria-expanded="true" aria-controls="collapseTwo">
                                        Filialen
                                    </a>
                                </h5>
                            </div>
                            <div id="branchesEmployeeCollapse" class="collapse in" role="tabpanel" aria-labelledby="branchesEmployeeCollapse" data-parent="#branchesEmployee">
                                <div class="card-body collapse-body">
                                    @if($branches->count() < 1)
                                        <p class="noPadding">Deze gebruiker zit nog niet in een filiaal</p>
                                    @else
                                        @foreach($branches as $branch)
                                            <p class="noPadding">{{$branch->name}} - {{$branch->address}}, {{$branch->city}}
                                                @if(in_array($branch->id, $user_branches->pluck('id')->toArray()))
                                                    - <a style="margin:0; padding:0;" href="{{route('user.deleteUserFromBranch', [$user->id, $branch->id])}}" class="link">verwijderen</a>
                                                @endif
                                            </p>
                                        @endforeach
                                    @endif
                                </div>
                                <a style="color: #3097D1;" data-toggle="modal" data-target="#branchesModal" class="noPadding link">Gebruiker toevoegen aan filiaal</a>
                            </div>
                        </div>

                        <div style="margin-top: 10px" class="card">
                            <div class="card-header" role="tab" id="managerEmployee">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#managerEmployeeCollapse" aria-expanded="false" aria-controls="collapseThree">
                                        Management filialen
                                    </a>
                                </h5>
                            </div>
                            <div id="managerEmployeeCollapse" class="collapse in    " role="tabpanel" aria-labelledby="managerEmployee" data-parent="#managerEmployee">
                                <div class="card-body collapse-body">
                                    @if($management_branches->count() < 1)
                                        <p class="noPadding">Deze gebruiker beheert nog geen filialen</p>
                                    @else
                                        @foreach($management_branches as $branch)
                                            <p class="noPadding">{{$branch->name}} - {{$branch->address}}, {{$branch->city}}
                                                @if(in_array($branch->id, $user_branches->pluck('id')->toArray()))
                                                    - <a style="margin:0; padding:0;" href="{{route('user.deleteManagerFromBranch', [$user->id, $branch->id])}}" class="link">verwijderen</a>
                                                @endif
                                            </p>
                                        @endforeach
                                    @endif
                                </div>
                                @if($user->level() < 3)
                                    <a style="color: #3097D1;" data-toggle="modal" data-target="#branchesManagerModal" class="noPadding link">Gebruiker toevoegen aan filiaal als manager</a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <!-- BranchesModal -->
                <div class="modal fade" id="branchesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Medewerker toevoegen aan filiaal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('user.addBranch', $user->id)}}" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <select class="form-control" name="branch" id="branchSelect">
                                        <option value="select" disabled selected>Selecteer filiaal</option>
                                        @foreach($user_branches as $branch)
                                            <option @if(in_array($branch->id, $employee_branches_ids_array)) disabled @endif value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                                    <button type="submit" class="btn btn-primary">Opslaan</button>
                                </div>
                                {{csrf_field()}}
                            </form>
                        </div>
                    </div>
                </div>

                <!-- BranchesManagerModal -->
                <div class="modal fade" id="branchesManagerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Gebruiker toevoegen aan filiaal als Manager</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('user.addManagerBranch', $user->id)}}" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <select class="form-control" name="branch" id="branchSelect">
                                        <option value="select" disabled selected>Selecteer filiaal</option>
                                        @foreach($user_branches as $branch)
                                            <option @if(in_array($branch->id, $manager_branches_ids_array)) disabled @endif value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
                                    <button type="submit" class="btn btn-primary">Opslaan</button>
                                </div>
                                {{csrf_field()}}
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- scripts here !-->
    <script>
        function submitChangeRole() {
            accLevel = $('#accountLevel');
            newLevel = accLevel.val();
            check = confirm('Weet je zeker dat je de rol van deze gebruiker wilt veranderen naar ' + newLevel);
            if (check) {
                $('#accountLevelForm').submit();
            }
            accLevel.val($('#defaultLevel').val());
        }
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });

        let base = new Vue({
            el: '#user',
            delimiters: ["[[","]]"],
            data: {
                uren_min: {{$user->uren_min}},
                uren_max: {{$user->uren_max}},
                user_id: {{$user->id}}
            },
            mounted() {
                //
            },
            methods: {
                submitNewHours() {
                    axios.post('/api/v1/user/update/' + this.user_id + '?api_token='+api_token, { uren_min: this.uren_min, uren_max: this.uren_max })
                        .then(function(response, err){
                            if (err) {
                                alert("Er is iets misgegaan tijdens het bijwerken van de gebruiker");
                            }
                            if (response.hasErrors) {
                                alert(response.errors[0]);
                            }
                            // user updated
                    });
                },
                confirmDelete() {
                    if (confirm("Weet u zeker dat u deze gebruiker wilt verwijderen?")) {
                        $('#deleteUserForm').submit();
                    }
                }
            }
        });
    </script>
@endsection