@extends('layouts.app')

@section('title') Account instellingen @endsection

@section('stylesheets')
    <!-- stylesheets here !-->
    <style>
        .avatar-wrapper {
            position: relative;
            display: inline-block;
            margin: 10px;
        }
        .avatar-wrapper:hover .overlay {
            border-radius: 50%;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,.5);
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            text-align: center;
            color: white;
            padding: 12px;
            font-size: 20px;
            cursor: pointer;
        }
        .user-avatar {
            height: 100px;
            margin:0;
        }
        .overlay {
            display: none;
        }
        .overlay p {
            position: absolute;
            top: 33px;
            left: 19px;
        }

    </style>
@endsection

@section('content')

    <div class="padding">
        @php $user =  Auth::user(); @endphp

        <form id="avatar_form" style="display: none;" action="{{route('auth.account.avatar')}}" enctype="multipart/form-data" method="POST">
            <input id="avatar" name="avatar" style="margin-top: 5px;" size="35" type="file" /><br />
            {{csrf_field()}}
        </form>

        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-block">
                    <div class="user-avatar-row">
                        <div class="avatar-wrapper">
                            <img class="user-avatar" src="{{$user->avatar()}}" alt="">
                            <div class="overlay">
                                <p>Upload</p>
                            </div>
                        </div>
                        <h4 style="display: inline; margin-left: 5px;">{{$user->name}}</h4>
                    </div>
                    <span>Gebruikersnaam: {{$user->username}}</span> <br>
                    <span>Functie: {{$user->readableRank()}}</span>
                </div>
            </div>
            <div class="accordion" id="myAccordion">
                <div style="padding: 15px" class="card panel">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="">Email: {{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="updatemailbtn" class="btn btn-primary" data-toggle="collapse" data-target="#collapsible-1" data-parent="#myAccordion">Update Email</div>
                        </div>
                    </div>
                    <div id="collapsible-1" class="collapse @if(old('type') == 'email') in @endif">
                        <form action="{{route('auth.account.email')}}" method="post">
                            <input type="hidden" name="type" value="email">
                            <div class="row">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label style="margin-top: 6px;" for="email" class="col-md-2 control-label">E-Mail Adres</label>

                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Nieuw email adres" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group{{ $errors->has('wachtwoord') ? ' has-error' : '' }}">
                                    <label style="margin-top: 6px;" for="email" class="col-md-2 control-label">Wachtwoord</label>

                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="wachtwoord" placeholder="Wachtwoord" required>

                                        @if ($errors->has('wachtwoord'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('wachtwoord') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <input style="margin-right: 12px;" type="submit" class="btn btn-success pull-right" value="Email bijwerken">
                                </div>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
                <div style="padding: 15px" class="card panel">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="">Wachtwoord opnieuw instellen</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn btn-primary" data-toggle="collapse" data-target="#passWordReset" data-parent="#myAccordion">Wachtwoord bewerken</div>
                        </div>
                    </div>
                    <div id="passWordReset" class="collapse @if(old('type') == 'password') in @endif">
                        <form action="{{route('auth.account.password')}}" method="post">
                            <input type="hidden" name="type" value="password">
                            <div class="row">
                                <div class="form-group{{ $errors->has('huidig_wachtwoord') ? ' has-error' : '' }}">
                                    <label style="margin-top: 0;" for="huidig_wachtwoord" class="col-md-2 control-label">Huidig wachtwoord</label>

                                    <div class="col-md-10">
                                        <input  type="password" class="form-control" name="huidig_wachtwoord" value="" placeholder="Huidig wachtwoord" required>

                                        @if ($errors->has('huidig_wachtwoord'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('huidig_wachtwoord') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label style="margin-top: 0;" for="nieuw_wachtwoord" class="col-md-2 control-label">Nieuw wachtwoord</label>

                                    <div class="col-md-10">
                                        <input type="password" class="form-control" name="password" value="" placeholder="Nieuw wachtwoord" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label style="margin-top: 0;" for="nieuw_wachtwoord" class="col-md-2 control-label">Nieuw wachtwoord</label>

                                    <div class="col-md-10">
                                        <input   type="password" class="form-control" name="password_confirmation" value="" placeholder="Nieuw wachtwoord" required>

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <input style="margin-right: 12px;" type="submit" class="btn btn-success pull-right" value="Wachtwoord instellen">
                                </div>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('.avatar-wrapper').click(function() {
            $('#avatar').click();
        });
        document.getElementById("avatar").onchange = function() {
            $('#avatar_form').submit();
        };
    </script>
@endsection