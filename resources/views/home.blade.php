@extends('layouts.app')

@section('title') Rooster @endsection

@section('stylesheets')
    <style>
        .dayWrapper {
            margin: auto;
            width: 100%;
            max-width: 600px;
            background: #fff;
            border-left: 100px solid darkgrey;
            min-height: 65px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26), 0 -1px 0px rgba(0, 0, 0, 0.02);
            padding-bottom: 1px;
        }
        .dayWrapper .day {
            background: #00a8f3;
            height: 20px;
            font-size: 13px;
            margin-left: -5px;
            padding-left: 5px;
            width: 100px;
        }
        .dayWrapper .date {
            position: absolute;
            margin-left: -95px;
            z-index: 1;
            color: white;
            font-weight: 800;
            font-size: 27px;
        }
        .event {
            margin-left: 7px;
            padding-top: 4px;
            margin-bottom: 10px;
            white-space: pre-line;
        }
        .event-time {
            font-size: 16px;
        }
        [v-cloak] {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="padding">

        <div id="vue" v-cloak>

            <div v-if="!loaded">
                <p class="text-center">Je rooster word ingeladen...</p>
            </div>

            <div v-for="day, index in sorted_events" v-if="day.length > 0 && loaded" :style="{ 'border-color': colors[dateIndex(day[0].start)].primary }" class="dayWrapper">
                <div class="date">
                    <div :style="{ background: colors[dateIndex(day[0].start)].secondary }" class="day">[[ readableDay(day[0].start) ]]</div>
                    [[ moment(day[0].start).date() ]] [[ moment(day[0].start).format('MMM') ]]
                </div>
                <p v-for="event in day" class="event">
                    <strong class="event-time">[[ event.start.split(" ")[1].split(":")[0] ]]:[[ event.start.split(" ")[1].split(":")[1] ]] - [[ event.end.split(" ")[1].split(":")[0] ]]:[[ event.end.split(" ")[1].split(":")[1] ]]</strong>
                    [[ event.branch_name ]]</p>
            </div>


            <p v-if="events.length < 1 && loaded">Het lijkt erop dat je voorlopig nog niet hoeft te werken</p>

        </div>

    </div>


@endsection

@section('scripts')
    <script src="/js/libs/moment.min.js"></script>
    <script>
        var colors = [
            {
                primary: '#FFB300',
                secondary: '#FF6F00'
            },
            {
                primary: '#F06292',
                secondary: '#D81B60'
            },
            {
                primary: '#4CAF50',
                secondary: '#2E7D32'
            },
            {
                primary: '#FF8A65',
                secondary: '#E64A19'
            },
            {
                primary: '#42A5F5',
                secondary: '#1976D2'
            },
            {
                primary: '#7E57C2',
                secondary: '#512DA8'
            },
            {
                primary: '#EF5350',
                secondary: '#D32F2F'
            }
        ];

        let app = new Vue({
            el: '#vue',
            delimiters: ["[[","]]"],
            data: {
                events: [],
                sorted_events: [],
                loaded: false
            },
            mounted() {
                // for (let i = 0; i < 31; i++) {
                //     this.sorted_events.push([]);
                // }
                // retrieve api-data
                dates = getMonthDateRange();
                axios.get('/api/v1/events-user/timestamp/' + dates.start.unix() + '/'+ dates.end.unix() + '?api_token=' + api_token)
                    .then(response => {this.events = response.data.events; this.sortByDay(); })
            },
            methods: {
                sortByDay() {
                    addedDays = [];
                    for (let i = 0; i < this.events.length; i++) {
                        event = this.events[i];
                        day = moment(event.start).date();

                        index = false;

                        for (let i = 0; i < this.sorted_events.length; i++) {
                            cur_event = this.sorted_events[i];
                            if (moment(cur_event[0].start).date() === moment(event.start).date() && moment(cur_event[0].start).year() === moment(event.start).year()) {
                                index = i;
                            }
                        }
                        if (index === false) {
                            this.sorted_events.push([
                                event
                            ]);
                        } else {
                            this.sorted_events[index].push(event);
                        }
                    }
                    this.loaded = true;
                },
                readableDay(day) {
                    day = moment(day).day();
                    switch(day) {
                        case 1:
                            return "Maandag";
                        case 2:
                            return "Dinsdag";
                        case 3:
                            return "Woensdag";
                        case 4:
                            return "Donderdag";
                        case 5:
                            return "Vrijdag";
                        case 6:
                            return "Zaterdag";
                        case 0:
                            return "Zondag";
                    }
                },
                dateIndex(day) {
                    return moment(day).day();
                }
            }
        });

        function getMonthDateRange() {

            // month in moment is 0 based, so 9 is actually october, subtract 1 to compensate
            // array is 'year', 'month', 'day', etc
            let startDate = moment().startOf('day');

            // Clone the value before .endOf()
            let endDate = moment(startDate).add(1, 'M');

            // make sure to call toDate() for plain JavaScript date type
            return { start: startDate, end: endDate };
        }
    </script>
@endsection