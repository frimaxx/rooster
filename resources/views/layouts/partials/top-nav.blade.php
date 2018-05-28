<div class="app-header info box-shadow-z4 navbar-md">
    <div class="navbar">
        <!-- Open side - Naviation on mobile -->
        <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up">
            <i class="material-icons">&#xe5d2;</i>
        </a>
        <!-- / -->

        <!-- Page title - Bind to $state's title -->
        <div class="navbar-item pull-left h5" ng-bind="$state.current.data.title" id="pageTitle"></div>

        <!-- navbar right -->
        <ul class="nav navbar-nav pull-right">

            <li class="nav-item dropdown">
                <a class="nav-link clear" href data-toggle="dropdown">
                <span class="avatar w-32">
                  <img style="display: inline-block;" src="{{auth()->user()->avatar()}}" alt="...">
                  {{--<i class="on b-white bottom"></i>--}}
                </span>
                    <p style="display: inline-block; padding:0; margin:0; margin-left: 5px;">{{Auth::user()->name}}</p>
                </a>
                {{--<div ui-include="'../views/blocks/dropdown.user.html'"></div>--}}
                <div class="dropdown-menu pull-right dropdown-menu-scale">
                    {{--<a class="dropdown-item" ui-sref="app.inbox.list">--}}
                        {{--<span>Inbox</span>--}}
                        {{--<span class="label warn m-l-xs">3</span>--}}
                    {{--</a>--}}
                    {{--<a class="dropdown-item" ui-sref="app.page.profile">--}}
                        {{--<span>Profile</span>--}}
                    {{--</a>--}}
                    <a class="dropdown-item" href="{{route('auth.account')}}">
                        <span>Account</span>
                        {{--<span class="label primary m-l-xs">3/9</span>--}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" ui-sref="app.docs">
                        Need help?
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Uitloggen
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>

            </li>
            <li class="nav-item hidden-md-up">
                <a class="nav-link" data-toggle="collapse" data-target="#collapse">
                    <i class="material-icons">&#xe5d4;</i>
                </a>
            </li>
        </ul>
        <!-- / navbar right -->

        <!-- navbar collapse -->
        <div class="collapse navbar-toggleable-sm" id="collapse">
            <!-- link and dropdown -->
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                    @php $level = Auth::user()->user_level; @endphp
                    @if($level > 1)
                        <a class="nav-link" href data-toggle="dropdown">
                            <i class="fa fa-fw fa-plus text-muted"></i>
                            <span>Nieuw</span>
                        </a>


                        <div class="dropdown-menu dropdown-menu-scale">
                            @if($level > 4)
                                <a class="dropdown-item" href="javascript:window.location = '{{route('new.company')}}'">
                                    <span>Bedrijf</span>
                                </a>
                            @endif
                            @if($level > 3)
                                <a class="dropdown-item" href="{{route('new.branch')}}">
                                    <span>Filiaal</span>
                                </a>
                            @endif
                            @if($level > 2)
                                <a class="dropdown-item" href="{{route('new.manager')}}">
                                    <span>Manager</span>
                                </a>
                            @endif
                            @if($level > 1)
                                <a class="dropdown-item" href="{{route('new.employee')}}">
                                    <span>Medewerker</span>
                                </a>
                            @endif
                            {{--<div class="dropdown-divider"></div>--}}
                        </div>
                    @endif

                </li>

                <li class="nav-item dropdown">
                    @php
                        $branches = Auth::user()->branches();
                    @endphp
                    @if($level > 1)
                        <a class="nav-link" href data-toggle="dropdown">
                            <i style="font-size: 20px;" class="fa fa-fw fa-building-o text-muted"></i>
                            <span>Filiaal</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-scale">
                            <a class="dropdown-item">
                                <span>@if(isset($current_branch)){{$current_branch['name']}}@else geen @endif</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            @foreach($branches as $branch)
                                <a href="{{route('change.branch', $branch->id)}}" class="dropdown-item">
                                    <span>{{$branch->name}}</span>
                                </a>
                            @endforeach
                        </div>

                    @endif
                </li>
                <li class="nav-item dropdown">
                    @php
                        $companies = \App\Models\Company::orderBy('name', 'asc')->get();
                    @endphp
                    @if($level > 4)
                        <a class="nav-link" href data-toggle="dropdown">
                            <i style="font-size: 20px;" class="fa fa-fw fa-building-o text-muted"></i>
                            <span>Bedrijf</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-scale">
                            <a class="dropdown-item">
                                <span>@if($current_company){{$current_company->name}}@else geen @endif</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            @foreach($companies as $company)
                                <a href="{{route('change.company', $company->id)}}" class="dropdown-item">
                                    <span>{{$company->name}}</span>
                                </a>
                            @endforeach
                        </div>

                    @endif

                </li>
            </ul>
            <!-- / -->
        </div>
        <!-- / navbar collapse -->
    </div>
</div>