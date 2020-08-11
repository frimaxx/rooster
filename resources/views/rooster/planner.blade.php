@extends('layouts.app')

@section('title') Rooster beheren - {{$current_branch['name']}} @endsection

@section('stylesheets')
    <link href='/calendar/css/fullcalendar.min.css' rel='stylesheet' />
    <link href="/calendar/css/fullcalendar.print.min.css' rel='stylesheet" media="print" />
    <link rel="stylesheet" href="/css/planner.css?v=1.0">
@endsection

@section('content')

    <script>
        var users = [];
    </script>

    <div class="padding">

        <div id='wrap'>

            <div class="external-events-wrapper">
                <div id='external-events'>
                    <h4>Medewerkers</h4>
                    @foreach($employees as $employee)
                        <script>
                            users.push({
                                user_id: {{$employee->user_id}}
                            });
                        </script>
                        <div class="UserTooltip" data-toggle="tooltip" title="Min uren: {{$employee->uren_min}}, Uren max: {{$employee->uren_max}}">
                            <div id="user_{{$employee->user_id}}" data-user_id="{{$employee->user_id}}" class='fc-event userSlot'>
                                @if(!empty($employee->avatar))
                                    <img style="border-radius: 50%;height: 35px; margin-right: 2px" src="/assets/images/avatars/{{$employee->avatar}}" alt="">
                                @else
                                    <img style="height: 35px; margin-right: 2px" src="/assets/images/user.svg" alt="">
                                @endif
                                {{$employee->name}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="trash">
                <div class="inner-trash">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                    Sleep hier om te verwijderen
                </div>
            </div>

            <div id='calendar'></div>

            @include('layouts.partials.confirm-dialog')
        </div>

        <div id="desktop-message">
            <p>Sorry, je kunt alleen roosters beheren op een desktop scherm</p>
        </div>

    </div>


@endsection

@section('scripts')
    <script src="/calendar/js/moment.min.js"></script>
    <script src="/calendar/js/fullcalendar.min.js"></script>
    <script src="/calendar/js/locale-nl.js"></script>
    <script src="/js/colors.js"></script>
    <script>
        var api_token = '{{Auth::user()->api_token}}'
        borderColorInactive = '#e60000';
        borderColorActive = '#009933';
        var CurrentTimeRange = [];
    </script>
    @if(env('APP_ENV') == 'production')
        <script src="/js/planner.min.js"></script>
    @else
        <script src="/js/planner.js"></script>
    @endif

@endsection