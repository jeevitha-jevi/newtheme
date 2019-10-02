$(document).ready(function() {
   $.ajax({
  dataType: "json",
  url: "php/audit/auditDataForCalender.php",
  data: "",
  success: auditcalender
})      
    var titleforcalender=new Array();
    var dateforcalender=new Array();
    var event;
    function auditcalender(data){
      console.log("data for calendar"+data);     
        var i;
        event = data;
            for(i=0;i<event.length;i++)
            {
              event[i].start = event[i].start_date;
              if(event[i].status == "published"){
                
               
               event[i].url="./view/audit/auditReprt.php?auditId="+event[i].id;
              }
              else
              {
                event[i].url="./view/audit/auditClauseAdmin.php?auditId="+event[i].id;
              }
             
            } 
           
        $('#calendar').fullCalendar({
    
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
      
            eventLimit: 2,
            events: event
             });
   }
 });
        
  