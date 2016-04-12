function buildCalendar(eventData) {
    var eventsArray = [];
    for (i = 0; i < eventData.length; i++) {
        if (eventData[i].confirmed == 1) {
            eventsArray.push({
                id: i,
                title: eventData[i].event_descrip,
                start: eventData[i].event_date,
                backgroundColor: '#d49768'
            });
        }
        else {
            eventsArray.push({
                id: i,
                title: eventData[i].event_descrip + ' !UNCONFIRMED',
                start: eventData[i].event_date,
                backgroundColor: '#ddd'
            });
        }

    }
    $('#calendar').fullCalendar({
        theme: true,
        //eventMouseover: eventHover,
        //eventMouseout: eventOff,
        eventRender: addDescrip,
        eventClick: eventDetails,
        dayClick: newEventPrompt,
        eventSources: [
            {
                events: eventsArray,
                backgroundColor: '#d49768',
                textColor: '#fff',
                borderColor: '#d49768'
            }
        ]
    });

    function addDescrip(event, element) {
        $(element).tooltip({
            title: 'Event: ' + event.title,
            placement: 'auto right'
        });
    }

    function eventDetails(event, element) {
        $('#dark_background').show();
        var detDisplay = $('#event_details_display');
        detDisplay.show();
        detDisplay.css({
            'margin-left': -detDisplay.width() / 2,
            'margin-top': -(detDisplay.height() / 2 + 50)
        });
        $('#dark_background').click(function (e) {
            if ($(e.target).is('#dark_background')) {
                $('#dark_background').hide();
                $('#event_details_display').hide();
            }

        });
        showDetails(event);
    }

    function showDetails(eventIn) {
        var thisEvent = eventData[eventIn.id];
        console.log(thisEvent);
        $('#event_details_title').html(thisEvent.event_descrip);
        $('#event_details_date').html(thisEvent.event_date);
        $('#event_details_location').html(thisEvent.event_location);
        $('#event_details_goh').html('Guest of Honor: ' + thisEvent.guest_of_honor);
        if(thisEvent.surprise_for == 1) {
            $('#surprise_party').html('This Event is a surprise party!');
        }
        else{
            $('#surprise_party').html('');
        }
        //*** CURRENTLY HERE - BEST WAY TO GET THE DATA TO POPULATE THIS BOX ***
    }

    function newEventPrompt(date, jsEvent, View) {
        console.log(date.format());
        var newEv = confirm("Would you like to create a new event for " + date.format() + "?");
        if (newEv) {
            window.location.href = "event_details.php?new_date=" + date.format();
        }
    }

    //Currently Unused Code
    function eventHover() {
        this.style.backgroundColor = '#fff';
        this.style.color = '#d49768';
        this.style.borderColor = '#fff';
    }

    function eventOff() {
        this.style.backgroundColor = '#d49768';
        this.style.color = '#fff';
        this.style.borderColor = '#d49768';
    }
}