$(document).ready(function() {
    var first_load = true;
    $('#external-events').css('height', $('#aside').height() - 100 + 'px');
    $('.trash').css('height', $('#aside').height() - 100 + 'px');
    /* initialize the external events
    -----------------------------------------------------------------*/
    $('#external-events .fc-event').each(function() {

        // store data so the calendar knows to render an event upon drop
        $(this).data('event', {
            title: $.trim($(this).text()), // use the element's text as the event title
            stick: true // maintain when user navigates (see docs on the renderEvent method)
        });
        var eventObject = {
            title: $.trim($(this).text())
        };
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0,  //  original position after the drag
            drag: function( event, ui ) {
                $('.UserTooltip').tooltip('hide')
            }
        });

    });

    $('#calendar').fullCalendar({
        locale: 'nl',
        timezone:'local',
        ignoreTimezone: false,
        minTime: '07:00:00',
        maxTime: '22:00:00',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        slotDuration: '00:15:00',
        allDaySlot: false,
        navLinks: true, // can click day/week names to navigate views
        selectHelper: true,
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar
        dragRevertDuration:0,
        themeSystem: 'standard',
        select: function(start, end) {
            //
        },
        drop: function(date, jsEvent, ui, resourceId ) {
            var calendar = $('#calendar');
            currentView = calendar.fullCalendar( 'getView' ).name;
            if (currentView === 'month') {
                return false;
            }

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            var user_id = $(this).attr('data-user_id');
            // we need to copy it, so that multiple events don't have a reference to the same object
            originalEventObject.start = date;
            originalEventObject.end = moment(date).add(3, 'hours'); // <-- make sure we assigned a date object
            originalEventObject.allDay = false;  //< -- only change

            data = {
                api_token: api_token,
                start: originalEventObject.start.format('YYYY-MM-DD HH:mm:ss'),
                end: originalEventObject.end.format('YYYY-MM-DD HH:mm:ss'),
                user_id: user_id
            };
            $.post('/api/v1/new/event', data, function(res, err) {
                if (err !== 'success' || res.hasErrors === true) {
                    alert("Er kon geen verbinding worden gemaakt met de server");
                    location.reload();
                }
                colors = getColorsByUserid(parseInt(user_id));
                originalEventObject = $.extend({
                    user_id: parseInt(user_id),
                    event_id: res.event.id,
                    borderColor: borderColorInactive,
                    backgroundColor: colors.color,
                    textColor: colors.textColor
                }, originalEventObject);

                calendar.fullCalendar('renderEvent', originalEventObject, true);
            });
            ToggleActivateRoosterButton(true);

            $(this).css('top', '0px'); // set back to original pos
        },
        eventDragStart: function( event ) {
            // activate trash can
            $('#external-events').css('display', 'none');
        },
        eventDragStop: function( event, jsEvent, ui, view ) {
            $('#external-events').css('display', 'block');
            if(isEventOverDiv(jsEvent.clientX, jsEvent.clientY)) {
                return deleteEvent(event);
            }
        },
        eventDrop: function(event) {
            editEvent(event);
        },
        eventResize: function(event) {
            editEvent(event);
        },
        eventReceive: function(event) {
            $('#calendar').fullCalendar('removeEvents', event._id);
        },
        events: function(start, end, timezone, callback) {
            if (first_load) {
                addLeftToolbarButtons();
                first_load = false;
            }
            ToggleActivateRoosterButton(false);
            start = start + ''; // convert to timestamp
            start = start.substring(0, start.length - 3);

            end = end + ''; // convert to timestamp
            end = end.substring(0, end.length - 3);

            CurrentTimeRange[0] = start;
            CurrentTimeRange[1] = end;

            $.get('/api/v1/events-branch/timestamp/'+start+'/'+end+'?api_token='+api_token, function(data) {
                var events = [];
                for (var i = 0; i < data.events.length; i++) {
                    event = data.events[i];
                    event.borderColor = borderColorInactive;
                    if (event.active === 1) {
                        event.borderColor = borderColorActive;
                    } else {
                        ToggleActivateRoosterButton(true);
                    }
                    color = getColorsByUserid(event.user_id);
                    event.backgroundColor = color.color;
                    event.textColor = color.textColor;
                    events.push(event);
                }
                $('#calendar').fullCalendar( 'removeEvents' );
                callback(events);
            });
            // callback(events);
            console.log(start + '-' + end);
        },
        timeFormat: 'H(:mm)'
    });

    var isEventOverDiv = function(x, y) {
        var external_events = $( '.trash' );
        var offset = external_events.offset();
        offset.right = external_events.width() + offset.left;
        offset.bottom = external_events.height() + offset.top;
        // Compare
        return (x >= offset.left && y >= offset.top && x <= offset.right && y <= offset .bottom);
    };
});

function getTimeRange() {
    calendar = $('#calendar');
    currentView = calendar.fullCalendar( 'getView' ).name;
    if (currentView === 'month') {
        return {
            start: calendar.fullCalendar('getDate').startOf('month').unix(),
            end: calendar.fullCalendar('getDate').endOf('month').unix()
        }
    } else if (currentView === 'agendaWeek') {
        return {
            start: calendar.fullCalendar('getDate').startOf('week').unix(),
            end: calendar.fullCalendar('getDate').endOf('week').unix()
        }
    } else if (currentView === 'agendaDay') {
        return {
            start: calendar.fullCalendar('getDate').startOf('day').unix(),
            end: calendar.fullCalendar('getDate').endOf('day').unix()
        }
    }
    return false;
}
function deleteEvent(event) {
    data = {
        api_token: api_token,
        event_id: event.event_id
    };
    $.post('/api/v1/delete/event', data, function(res, err) {
        if (err !== 'success' || res.hasErrors) {
            alert("Er ging iets mis tijdens het verwijderen van het event");
            location.reload();
        }
        console.log(res);
    });
    // delete element front-end
    $('#calendar').fullCalendar('removeEvents', event._id);
    var el = $( "<div class='fc-event'>" ).appendTo( '#external-events-listing' ).text( event.title );
    el.draggable({
        zIndex: 999,
        revert: true,
        revertDuration: 0
    });
    ToggleActivateRoosterButton(true);
    el.data('event', { title: event.title, id :event.id, stick: true });
}
function editEvent(event) {
    event.borderColor = borderColorInactive;
    $('#calendar').fullCalendar('updateEvent', event);
    data = {
        api_token: api_token,
        event_id: event.event_id,
        start: event.start.format('YYYY-MM-DD HH:mm:ss'),
        end: event.end.format('YYYY-MM-DD HH:mm:ss')
    };
    $.post('/api/v1/edit/event', data, function(res, err) {
        if (err !== 'success' || res.hasErrors === true) {
            alert("Er kon geen verbinding worden gemaakt met de server");
            location.reload();
        }
        ToggleActivateRoosterButton(true);
        console.log(res);
    });
}
function addLeftToolbarButtons() {
    fctoolbar_left = $('.fc-toolbar .fc-left ');
    fctoolbar_left.append('<button id="copyLastweekButton" class="fc-button fc-state-default fc-corner-right">Vorige week overnemen</button>');
    fctoolbar_left.append('<button id="activateRoosterButton" class="fc-button fc-state-default fc-corner-right">Publiceren</button>');

    fctoolbar_right = $('.fc-toolbar .fc-right');
    $('<button style="margin-right: 10px;" id="printButton" class="fc-button fc-state-default fc-corner-right"><i class="fa fa-print" aria-hidden="true"></i> Week Printen</button>').insertBefore( ".fc-month-button" );
    $('<button style="margin-right: 10px;" id="emptyWeekButton" class="fc-button fc-state-default fc-corner-right">Week leegmaken</button>').insertBefore( ".fc-month-button" );
}

function ToggleActivateRoosterButton(toggle) {
    if (toggle) {
        $('#activateRoosterButton').removeClass('fc-state-disabled');
    } else {
        $('#activateRoosterButton').addClass('fc-state-disabled');

    }
}

$(document).on("click", "#activateRoosterButton", function() {
    if ($(this).hasClass('fc-state-disabled')) {
        return;
    }
    ToggleActivateRoosterButton(false);
    timeRange = getTimeRange();
    data = {
        api_token: api_token,
        start: timeRange.start,
        end: timeRange.end
    };
    $.post('/api/v1/events/activate', data, function(res, err) {
        if (err !== 'success' || res.hasErrors === true) {
            alert("Er kon geen verbinding worden gemaakt met de server");
            location.reload();
        }
        calendar = $('#calendar');
        calendar.fullCalendar( 'removeEvents' );
        calendar.fullCalendar( 'refetchEvents' );

    });
});
$(document).on('click', '#copyLastweekButton', function() {
    if ($(this).hasClass('fc-state-disabled')) {
        return;
    }
    //fc-state-disabled
    if ($(this).hasClass('fc-state-disabled')) {
        return;
    }
    ExecuteConfirmDialog(
        "Wilt u het rooster van vorige week overnemen?",
        "Deze actie kan niet ongedaan gemaakt worden en verwijderd alle huidige data in deze week",
        copyLastWeek,
        "Ja",
        "Nee");
});
$(document).on('click', '#emptyWeekButton', function() {
    if ($(this).hasClass('fc-state-disabled')) {
        return;
    }
    var calendar = $('#calendar');
    startOfWeek = calendar.fullCalendar('getDate').startOf('week').unix();
    endOfWeek = calendar.fullCalendar('getDate').endOf('week').unix();

    ExecuteConfirmDialog("Weet u zeker dat u deze week leeg wilt maken?", "Deze actie kan niet ongedaan gemaakt worden",
        deleteThisWeek,
        "Verwijderen",
        "Annuleren");
});
$(document).on('click', '#printButton', function() {
    if ($(this).hasClass('fc-state-disabled')) {
        return;
    }
    var calendar = $('#calendar');
    startOfWeek = calendar.fullCalendar('getDate').startOf('week').unix();
    endOfWeek = calendar.fullCalendar('getDate').endOf('week').unix();

    window.open('/print-schedule?start=' + startOfWeek +  '&end=' + endOfWeek,'_blank');
});
$(document).on('click', '.fc-agendaWeek-button', function() {
    $('#copyLastweekButton').removeClass('fc-state-disabled');
    $('#emptyWeekButton').removeClass('fc-state-disabled');
    $('#printButton').removeClass('fc-state-disabled');
});
$(document).on('click', '.fc-month-button', function() {
    $('#copyLastweekButton').removeClass('fc-state-disabled').addClass('fc-state-disabled');
    $('#emptyWeekButton').removeClass('fc-state-disabled').addClass('fc-state-disabled');
    $('#printButton').removeClass('fc-state-disabled').addClass('fc-state-disabled');
});
$(document).on('click', '.fc-agendaDay-button', function() {
    $('#copyLastweekButton').removeClass('fc-state-disabled');
    $('#emptyWeekButton').removeClass('fc-state-disabled');
    $('#printButton').removeClass('fc-state-disabled');
});

function copyLastWeek() {
    var calendar = $('#calendar');
    startOfWeek = calendar.fullCalendar('getDate').startOf('week').unix();
    endOfWeek = calendar.fullCalendar('getDate').endOf('week').unix();

    $.get('/api/v1/events-branch/copy-last-week/' + startOfWeek + '/' + endOfWeek + '?api_token=' + api_token, function(res) {
        if (res.hasErrors === true) {
            alert(res.errors[0]);
        }
        calendar.fullCalendar('removeEvents');
        calendar.fullCalendar('refetchEvents');
    });
}

function deleteThisWeek() {
    var calendar = $('#calendar');

    $.get('/api/v1/events-branch/delete/' + startOfWeek + '/' + endOfWeek + '?api_token=' + api_token, function(res) {
        if (res.hasErrors === true) {
            alert(res.errors[0]);
        }
        calendar.fullCalendar('removeEvents');
        calendar.fullCalendar('refetchEvents');
    });
}

function ExecuteConfirmDialog(title, msg, yesFn, btnYesTitle, btnNoTitle) {
    var $confirm = $("#modalConfirm");
    $confirm.modal('show');
    $("#lblTitleConfirmYesNo").html(title);
    $("#lblMsgConfirmYesNo").html(msg);
    if (btnYesTitle) {
        $('#btnYesConfirmYesNo').text(btnYesTitle)
    }
    if (btnNoTitle) {
        $('#btnNoConfirmYesNo').text(btnNoTitle)
    }
    $("#btnYesConfirmYesNo").off('click').click(function () {
        yesFn();
        $confirm.modal("hide");
    });
    $("#btnNoConfirmYesNo").off('click').click(function () {
        $confirm.modal("hide");
    });
}