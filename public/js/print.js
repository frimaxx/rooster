var events = [];
var queue = [];
var current = [];
var done = [];
var notPlannedUsers = [];

function getTimeRange() {
    var curr = new Date(); // get current date
    var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
    var last = first + 7; // last day is the first day + 6

    if (!start) {
        momentStart = moment(new Date()).startOf('week');
    } else {
        momentStart = moment.unix(start);
    }
    start = momentStart.unix();
    readableStart = moment(momentStart).format('DD MMM YYYY');
    if (!end) {
        momentEnd = moment(new Date()).endOf('week');
    } else {
        momentEnd = moment.unix(end).subtract(1, 'seconds');
    }
    end = momentEnd.unix();
    readableEnd = moment(momentEnd).format('DD MMM YYYY');

    $('#startDate').text(readableStart);
    $('#endDate').text(readableEnd);
}

function getSchedule() {
    getTimeRange();
    $.ajax({
        url:
        "/api/v1/events-branch/timestamp/" +
        start +
        "/" +
        end +
        "?api_token=" +
        api_token +
        "&active=true" +
        "&order=name",
        dataType: "json",
        success: function(data) {
            events = data;
            notPlannedUsers = data.unPlannedUsers;
        }
    });
    setTimeout(createQueue, 300);
    setTimeout(createSchedule, 500);
}

function createQueue() {
    var len = events["events"].length;
    for (var i = 0; i < len; i++) {
        queue.push(events["events"][i]);
    }
}

function createSchedule() {
    //Move to current array
    if (queue.length < 1) {
        insertTime();
    } else {
        current.splice(0, 1);
        var current_name = queue[0];
        queue.splice(0, 1);
        current.push(current_name);
        insertIntoTable();
    }
}

function insertIntoTable() {
    var id = current[0]["name"].replace(/\s/g, '');
    if (!document.getElementById(id)) {
        document.getElementById("schedule").innerHTML +=
            "<tr id='" +
            id +
            "'><td>" +
            current[0]["name"] +
            "</td><td id='maandag'></td><td id='dinsdag'></td><td id='woensdag'></td><td id='donderdag'></td><td id='vrijdag'></td><td id='zaterdag'></td><td id='zondag'></td></tr>";
    } else {
    }
    done.push(current);
    current.splice(0, 1);
    createSchedule();
}

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function adddNotplannedUsers() {
    console.log(notPlannedUsers);
    for (var i = 0; i < notPlannedUsers.length; i++) {
        document.getElementById("schedule").innerHTML +=
            "<tr id='" +
            i +
            "'><td>" +
            notPlannedUsers[i].name +
            "</td><td id='maandag'></td><td id='dinsdag'></td><td id='woensdag'></td><td id='donderdag'></td><td id='vrijdag'></td><td id='zaterdag'></td><td id='zondag'></td></tr>";
    }
}

function insertTime() {
    for (var i = 0; i < events["events"].length; i++) {
        var name = events["events"][i]["name"];
        name = name.replace(/\s/g, '');
        if (!document.getElementById(name)) {
            console.log("Row not found.");
        } else {
            var start = new Date(events["events"][i]["start"]);
            var end = new Date(events["events"][i]["end"]);
            switch(start.getDay()) {
                case 0:
                    day = 7;
                    break;
                case 1:
                    day = 1;
                    break;
                case 2:
                    day = 2;
                    break;
                case 3:
                    day = 3;
                    break;
                case 4:
                    day = 4;
                    break;
                case 5:
                    day = 5;
                    break;
                case 6:
                    day = 6;
            }
            document.getElementById(name).getElementsByTagName("td")[day].innerHTML += addZero(start.getHours()) + ":" + addZero(start.getMinutes()) + " - " + addZero(end.getHours()) + ":" + addZero(end.getMinutes()  ) + '<br>';

        }
    }
    adddNotplannedUsers();
    window.print();
}

getSchedule();