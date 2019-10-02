$(document).ready(function(){
    var events = document.getElementsByClassName('event');
    var i,j;
    var d = [];
    var text = [];
    var months = [];
    //Scan data from the span.event elements and store them.
    //stores the dates in dates[] and all the events in the ith date are stored in text[i] which is a set of arrays.
    for(i = 0; i < events.length; i++){
        var dateTimeSplit = events[i].innerHTML.split(" ");
        var dateSplit = dateTimeSplit[0].split("-");
        var timeSplit = dateTimeSplit[1].split(":")
        d.push(new Date(dateSplit[0],dateSplit[1] - 1,dateSplit[2],timeSplit[0],timeSplit[1],timeSplit[2],0));
        text.push([]);
        var subEvents = events[i].querySelectorAll("p");
        for(j = 0; j < subEvents.length; j++){
            text[i].push(subEvents[j].innerHTML);
        }

        if(months.indexOf(dateSplit[0] + " " +  dateSplit[1]) == -1){
            months.push(dateSplit[0] + " " + dateSplit[1]);
        }
    }
    //months contains all the eventful months in the format 'monthName Year'
    months.sort();
    months.reverse();
    
    //arrays for converting indices to text
    var month = new Array();
    month[0] = "January";
    month[1] = "February";
    month[2] = "March";
    month[3] = "April";
    month[4] = "May";
    month[5] = "June";
    month[6] = "July";
    month[7] = "August";
    month[8] = "September";
    month[9] = "October";
    month[10] = "November";
    month[11] = "December";

    var day = new Array();
    day[0] = "Monday";
    day[1] = "Tuesday";
    day[2] = "Wednesday";
    day[3] = "Thursday";
    day[4] = "Friday";
    day[5] = "Saturday";
    day[6] = "Sunday";    

    //insert panel for each month
    for(i = 0; i < months.length; i++)
    {
        var newMonth = document.createElement("div");
        newMonth.className += "panel panel-default";

        var newHeading = document.createElement("div");
        newHeading.className += "panel-heading";
        monthsSplit = months[i].split(" ");
        var headingNode = document.createTextNode(month[parseInt(monthsSplit[1]) - 1] + " " + monthsSplit[0]);
        newHeading.appendChild(headingNode);

        
        newMonth.appendChild(newHeading);
        
        var newBody = document.createElement("div");
        newBody.className += "panel-body";
        var newTable = document.createElement("table");
        newTable.id = months[i];
        newBody.appendChild(newTable);
        newMonth.appendChild(newBody);
        var historyDiv = document.getElementById("history");
        historyDiv.appendChild(newMonth);
    }

    //insert a row for each date and a unordered list for each subevent
    for(i = 0; i < d.length; i++)
    {        
        var newEvent = document.createElement("tr");
        newEvent.id = d[i].getMilliseconds();
        var newDate = document.createElement("td");
        var dateNode = document.createTextNode(day[d[i].getDay()] + ", " + d[i].getDate() + " " + d[i].toLocaleTimeString());
        newDate.appendChild(dateNode);

        var printButton = document.createElement("button");
        printButton.style.marginRight = "1em";
        printButton.style.cssFloat = "left";
        var printIcon = document.createElement("i");
        printIcon.className += "fa fa-print";
        printButton.appendChild(printIcon);
        printButton.setAttribute("data-html2canvas-ignore","true");
        printButton.setAttribute("onclick","printEvent(" + d[i].getMilliseconds() +  ")")
        newDate.appendChild(printButton);

        newEvent.appendChild(newDate);

        var newDescription = document.createElement("td");
        var newList = document.createElement("ul");
        newList.style.paddingLeft = "1em";
        var j;
        for(j = 0; j < text[i].length; j++)
        {
            var newListItem = document.createElement("li");
            var listItemNode = document.createTextNode(text[i][j]);
            newListItem.appendChild(listItemNode);
            newList.appendChild(newListItem);
        }
        newDescription.appendChild(newList);
        newEvent.appendChild(newDescription);

        var corespondingMonth = document.getElementById(d[i].getFullYear() + " " + ("0" + (d[i].getMonth() + 1)).slice(-2));
        corespondingMonth.appendChild(newEvent);
    }
});
    
//function for going back to previous page
function goToPreviousPage(){
    window.history.back();
}

//prints the required event,required id of the row to be set to date.getMilliseconds()
function printEvent(millisec) {
    var element = document.getElementById(millisec);
    html2pdf(element, {
        margin: 1,
        filename:     'AssetHistory.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { dpi: 192, letterRendering: true },
        jsPDF:        { unit: 'in', format: 'a3', orientation: 'portrait' }
    });
}