<!-- aside -->
<div id="aside" class="app-aside box-shadow-z3 modal fade lg nav-expand">
    <div class="left navside white dk" layout="column">
        <div class="navbar navbar-md info no-radius box-shadow-z4">
            <!-- brand -->
            <a href="/" class="navbar-brand hidden-folded">
                @if($current_company && $current_company->logo)
                    <img src="/assets/images/logos/{{$current_company->logo}}" alt="">
                @else
                    <div ui-include="'/assets/images/logo-white.svg'"></div>
                @endif
            </a>
            <div class="dynamic-logo">
                @if($current_company && $current_company->logo_small)
                    <img src="/assets/images/logos/{{$current_company->logo_small}}" alt="">
                @else    
                    <div ui-include="'/assets/images/rooster-r-white.svg'"></div>
                @endif    
            </div>
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Main</small>
                    </li>

                    <li>
                        <a class="homeLink" >
                          <span class="nav-icon">
                            <i class="material-icons">&#xe878;
                            </i>
                          </span>
                            <span class="nav-text">Mijn Rooster</span>
                        </a>
                    </li>

                    @php $level = Auth::user()->user_level; @endphp
                    @if($level > 1)
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Beheer</small>
                    </li>

                    <li>
                        <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                            <span class="nav-label">
                  </span>
                            <span class="nav-icon">
                    <i class="material-icons">&#xe150;
                    </i>
                  </span>
                            <span class="nav-text">Creëren</span>
                        </a>
                        <ul class="nav-sub nav-mega nav-mega-3">
                            @if($level > 4)
                                <li>
                                    <a href="javascript:window.location = '{{route('new.company')}}'" >
                                        <span class="nav-text">Bedrijf</span>
                                    </a>
                                </li>
                            @endif
                            @if($level > 3)
                                <li>
                                    <a href="{{route('new.branch')}}" >
                                        <span class="nav-text">Filiaal</span>
                                    </a>
                                </li>
                            @endif
                            @if($level > 2)
                                <li>
                                    <a href="{{route('new.manager')}}" >
                                        <span class="nav-text">Manager</span>
                                    </a>
                                </li>
                            @endif
                            @if($level > 1)
                                <li>
                                    <a href="{{route('new.employee')}}" >
                                        <span class="nav-text">Medewerker</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>


                    <li>
                        <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                            <span class="nav-icon">
                    <i class="material-icons">&#xe896;
                    </i>
                  </span>
                        <span class="nav-text">Beheren</span>
                        </a>
                        <ul class="nav-sub">
                            @if($level > 3)
                            <li>
                                <a href="javascript:window.location = '{{route('edit.company')}}'">
                                    <span class="nav-text">Bedrijf</span>
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{route('manage.users')}}" >
                                    <span class="nav-text">Gebruikers</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('manage.branches')}}" >
                                    <span class="nav-text">Filialen</span>
                                </a>
                            </li>
                            <li>
                                <a class="roosterLink" >
                                    <span class="nav-text">Rooster</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @endif

                    <li class="hidden-folded" >
                        <a href="docs.html" >
                            <span class="nav-text">Help</span>
                        </a>
                    </li>

                    @if($level > 1)
                    <li class="hidden-folded" >
                        <a href="docs.html" >
                            <span class="nav-text">Documentatie</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        <div flex-no-shrink>
            <nav ui-nav>
                <ul class="nav">
                    <li class="no-bg">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                            <span class="nav-icon">
                             <i class="material-icons">&#xe8ac;</i>
                            </span>
                            <span class="nav-text">Logout</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="no-bg">
                        <span style="margin-left: 10px;" class="nav-text hidden-folded">Powered by Rooster</span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- / aside -->