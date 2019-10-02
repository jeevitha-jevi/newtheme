var eventCalendar = new Array();

var AppCalendar = function() {

    return {
        //main function to initiate the module
        init: function() {
            this.initCalendar();
        },

        initCalendar: function() {

            if (!jQuery().fullCalendar) {
                return;
            }

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var h = {};

            if (App.isRTL()) {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        right: 'title, prev, next',
                        center: '',
                        left: 'agendaDay, agendaWeek, month, today'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        right: 'title',
                        center: '',
                        left: 'agendaDay, agendaWeek, month, today, prev,next'
                    };
                }
            } else {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                    h = {
                        left: 'title, prev, next',
                        center: '',
                        right: 'today,month,agendaWeek,agendaDay'
                    };
                } else {
                    $('#calendar').removeClass("mobile");
                    h = {
                        left: 'title',
                        center: '',
                        right: 'prev,next,today,month,agendaWeek,agendaDay'
                    };
                }
            }

             var initDrag = function(el) {                                            
                var eventObject = {
                    title: $.trim(el.text()),
                    id: $.trim(el.attr("id"))
                };                
                el.data('eventObject', eventObject);                
                el.draggable({

                    zIndex: 999,
                    revert: true, 
                    revertDuration: 0
                });
            };
            
            var addEvent = function(title) {                           
                var title = {
                    'event': $('#event_title').val(),    
                    'action': $('#action').val()       
                }
                $.ajax({
                    type: "POST",
                    url: "/freshgrc/php/common/calendarEvent.php",
                    data: title
                }).done(function (data) {         
                   location.reload();
                });
                
            };  
        
                    
           
            
            function getevents(data){                    
                for (var i = 0; i < data.length; i++) {
                    
                    var id = data[i].id;
                   var html = $('<div class="external-event label label-default" id="' + id + '">' + data[i].event  + '</div>');
                jQuery('#event_box').append(html); 
                          
                initDrag(html);
                }
            }

            $('#external-events div.external-event').each(function() {
                initDrag($(this));
            });

            $('#event_add').unbind('click').click(function() {
            
                var title = $('#event_title').val();
                addEvent(title);
            });            

            $('#calendar').fullCalendar('destroy');   
                var loggedInUser=$('#loggedInUser').val();
            var dat1={'userId':loggedInUser};  
                                    
               $.ajax({
                  dataType: "json",
                  type:"POST",
                  url: "/freshgrc/php/common/calendarEvent.php",
                  data: dat1,
                  success: getevent
                  });
        
            function getevent(data){                 
                for(var i=0;i<data.length;i++)
                    {
                        eventCalendar[i]={'title':data[i].event,'start':new Date(data[i].event_date),'backgroundColor':"#34bca1"};
                    }
                    console.log(event);
                     $('#calendar').fullCalendar({
                header: h,
                defaultView: 'month',  
                slotMinutes: 15,
                //editable: true,
               // droppable: true, 
                drop: function(date, allDay) {
                    var originalEventObject = $(this).data('eventObject');                   
                    var copiedEventObject = $.extend({}, originalEventObject);                    
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    copiedEventObject.className = $(this).attr("data-class");
                    
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                    var eventdetails = Object.values(originalEventObject);
                    var event = eventdetails[0];
                    var id = eventdetails[1];
                    var event_date = copiedEventObject.start._d;                    
                    var date = new Date(event_date).toLocaleString().split(',')[0].split("/").map(function(val, index, arr) {
                      if (index < arr.length - 1) {
                        return ("0" + val).slice(-2);
                      }
                      return val;
                    }).reverse().join("-");   

                    var action = 'update';

                    var eventDetails = {
                        'id': id,
                        'event': event,
                        'event_date': date,
                        'action': action               
                    }
                    $.ajax({
                       dataType: "json",
                        type: "POST",
                        url: "/freshgrc/php/common/calendarEvent.php",
                        data: eventDetails
                    }).done(function (data) {         
                      location.reload();
                    });
                    
                    if ($('#drop-remove').is(':checked')) {
                       
                        $(this).remove();
                    }
                },
                events:eventCalendar,
                /*eventClick:redirect*/
                
            });
            }
           /* function redirect(){
                window.location="/freshgrc/view/audit/auditorAdmin.php";
            }*/

        }

    };

}();

jQuery(document).ready(function() {     
    $('#action').val('create');   
   AppCalendar.init(); 
});