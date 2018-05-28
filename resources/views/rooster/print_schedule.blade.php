<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Roboto');
        @page { size: landscape; }
        body{
            font-family: 'Roboto', sans-serif;
        }
        table, td, th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table {
            border-collapse: collapse;
            width: 20%;
        }
        table td {
            white-space: nowrap;
        }
        tr:nth-child(even){background-color: #f2f2f2}
        img {
            height: 70px;
            border-radius: 10px;
        }
        .inline {
            display: inline;
        }
        .date {
            position: absolute;
            margin-top: 38px;
            font-size: 20px;
        }
        .date-logo {
            position: absolute;
            margin-top: 28px;
            margin-left: 5px;
            font-size: 20px;
        }
        .logo {
            height: 50px;
        }
        .wrapper {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        @if($current_company && $current_company->logo)
            <img class="inline logo" src="/assets/images/logos/{{$current_company->logo}}" alt="">
            <h4 class="inline date-logo"><span id="startDate"></span> - <span id="endDate"></span></h4>
        @else
            <img class="inline" src="/assets/images/logo-white.svg"/>
            <h4 class="inline date"><span id="startDate"></span> - <span id="endDate"></span></h4>
        @endif
    </div>
    <table  style="overflow-x:auto; width: 100%;">
        <thead>
        <td>Naam</td>
        <td>Maandag</td>
        <td>Dinsdag</td>
        <td>Woensdag</td>
        <td>Donderdag</td>
        <td>Vrijdag</td>
        <td>Zaterdag</td>
        <td>Zondag</td>
        </thead>
        <tbody id="schedule">

        </tbody>
    </table>
    <script src="/libs/jquery/jquery/dist/jquery.js"></script>
    <script src="/calendar/js/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/nl.js"></script>
    <script>
        var api_token = '{{Auth::user()->api_token}}';
        @if($start)
            var start = {{$start}};
        @else
            var start = null;
        @endif

        @if($end)
            var end = {{$end}};
        @else
            var end = null;
        @endif
    </script>
    <script src="/js/print.js"></script>
</body>

</html>