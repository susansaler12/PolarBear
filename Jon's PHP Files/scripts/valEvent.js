window.onload = function(){
    var eventForm = document.getElementById("event_details_form");
    eventForm.onsubmit = function(){
        var dateField = document.getElementById("event_date");
        var regEx = /^[2]\d{3}][0-1][0-9]\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/;
        if(regEx.test(dateField.value) != true && dateField.value != null && dateField.value != "" && dateField.value != "YYYYMMDD"){
            var span = document.getElementById("date_format");
            span.innerHTML = "  Please enter a valid date in format YYYYMMDD, or leave the field blank";
            span.style.color = "red";
            return false;
        }
    }
}
