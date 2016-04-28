function buildCalendar(eventData) {
    var eventsArray = [];
    for (i = 0; i < eventData.length; i++) {
        if (eventData[i].confirmed == 1) {
            eventsArray.push({
                id: i,
                title: eventData[i].event_name,
                start: eventData[i].event_date,
                backgroundColor: '#d49768'
            });
        }
        else {
            eventsArray.push({
                id: i,
                title: eventData[i].event_name + ' !UNCONFIRMED',
                start: eventData[i].event_date,
                backgroundColor: '#ddd'
            });
        }

    }
    $('#calendar').fullCalendar({
        theme: true,
        eventRender: addDescrip,
        eventClick: eventDetails,
        dayClick: newEventPrompt,
        eventSources: [
            {
                events: eventsArray,
                backgroundColor: '#d49768',
                textColor: '#000',
                borderColor: '#d49768'
            }
        ]
    });

    function addDescrip(event, element) {
        console.log(event);
        $(element).tooltip({
            title: event.title,
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
        $('#event_details_name').html(thisEvent.event_name);
        $('#event_details_date').html("Date: " + thisEvent.event_date);
        $('#event_details_descrip').html(thisEvent.event_descrip);
        $('#event_details_location').html("Location: " + thisEvent.event_location);
        if(thisEvent.guest_of_honor != null && thisEvent.guest_of_honor != ''){
            $('#event_details_goh').html('Guest of Honor: ' + thisEvent.guest_of_honor);
        }
        if(thisEvent.surprise_for == 1) {
            $('#surprise_party').html('This Event is a surprise party!');
        }
        else{
            $('#surprise_party').css('display','none');
        }
        $('#view_link').attr('href', 'event_view.php?event_id=' + thisEvent.event_id);
    }

    function newEventPrompt(date, jsEvent, View) {
        var newEv = confirm("Would you like to create a new event for " + date.format() + "?");
        if (newEv) {
            window.location.href = "event_details.php?new_date=" + date.format();
        }
    }

}