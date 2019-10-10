<?php require_once __DIR__.'/../header.php';?>
<?php require_once __DIR__.'/../../php/audit/auditManager.php';
$auditManager=new AuditManager();
// $auditCal=$auditManager->auditDataForCalendar();
// echo json_encode($auditCal);
$id=4;
$auditCal=$auditManager->getinvoiceupdate($id);
print_r($auditCal);
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style>
  * {
      margin: 0;
      padding: 0;
    }
    .calendar_header{
      position: relative;
      font-size: 10px;
    }
    .prev-month, .next-month{
        cursor: pointer;
        position: absolute;
        top: 1px;
        background: #fff;
        width: 50px;
        height: 54px;
        padding: 8px 0 8px 10px;
    }
    .prev-month{ left: 1px; }
    .next-month{ right: 1px; }
    .month-year h3{
      font-size: 40px;
      margin-top: 10px;
      border: 1px solid #ddd;
        margin-bottom: 0;
        padding: 5px 0;
        background: #eee;
    }/*
    .currentMonth{background: rgba(0,0,0,0.04);}*/
    .container {
      margin-top: 10px;
    }

    th {
      background: #faffe0;
      border-bottom: 4px double #ddd !important;
      font-size: 20px;
      height: 30px;
      text-align: center;
      font-weight: 700;
    }

    td {
      font-size: 20px;
      background: white;
      height: 100px;
    }
    td.empty{background: #fff;}

    .today {
      font-weight: bold;
      color: #000;
      /*background-color: gray;*/
    }

    th:nth-of-type(7), td:nth-of-type(7) {
      font-weight: bold;
    }

    th:nth-of-type(1), td:nth-of-type(1) {
      font-weight: bold;
    }
        .snippet-code .snippet-result .snippet-result-code{height:725px;}
        .hover-end{padding:0;margin:0;font-size:75%;text-align:center;position:absolute;bottom:0;width:100%;opacity:.8}

</style>
</head>
<body class="with-side-menu-compact">
    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        // include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
    ?>
    <?php if($_SESSION['user_role'] == 'auditor') {?>
       
    <?php }?>
<body>
   <input type="hidden" value=<?php echo $_SESSION['user_id'] ?> id="loggedInUser">
<div class="container" style="width: 70%;margin-top: 80px;">
    <div class="calendar_header" style="width: 90%;height: 10%">
      <i class="prev-month fa fa-chevron-left fa-2x" style="padding: 20px;"></i>
      <i class="next-month fa fa-chevron-right fa-2x" style="padding: 20px;"></i>
      <div class="month-year text-center"></div>
    </div>
    <table class="table table-bordered" style="width: 90%;height: 40%;margin-top: -20px;">
      <thead>
        <tr>
          <th>S</th>
          <th>M</th>
          <th>T</th>
          <th>W</th>
          <th>T</th>
          <th>F</th>
          <th>S</th>
        </tr>
      </thead>
      <tbody id="calendar_tbody"></tbody>
    </table>
  </div>
</body>
<script>
  function myCalendar(curr_month = "curr") {
  var tbody_html = "";
  var td_class = "";
  var weekday_count = 1;
  var tr_count = 1;
      var td_count = 1;
  var offset_td = 0;
  var counter = 1;
  var month = master_data.months[curr_month];
  var start_of_curr = master_data.day_start[curr_month];
    if(curr_month!=="curr"){
      if(master_data.months[curr_month]===11 && curr_month==="prev"){
        year--;
      }
      if(master_data.months[curr_month]===0 && curr_month==="next"){
        year++;
      }
    }
    
      // Displays the current month in Strings and the actual year 
      $('.month-year').html("<h3>"+months_full[month]+" "+year+"</h3>");

      //To build the calendar body
      while (counter <= daysOfMonth[month]) {
        if(weekday_count === 8){
          tbody_html += "</tr>";
          weekday_count = 1;
        }
        if(weekday_count === 1){
          tbody_html += "<tr>";
          tr_count++;
        }
      // prepend blank tds
        while(offset_td < start_of_curr){
          tbody_html += "<td class='empty'></td>";
          offset_td++;
          weekday_count++;
          td_count++;
        }
        if(month === d.getUTCMonth() && year === d.getUTCFullYear()){
          if(counter === date){
            td_class = "today";
          } else {
            td_class = "currentMonth";
          }
        }
        tbody_html += "<td class='"+td_class+"'>"+counter+"</td>";
        counter++;
        weekday_count++;
        td_count++;
      }
    // append blank tds
      while((td_count-1) < (tr_count-1)*7){
        tbody_html += "<td class='empty'></td>";
        td_count++;
      }
      $('#calendar_tbody').html(tbody_html);
    // setting master_data.months
      master_data.months.curr = month;
      master_data.months.prev = month === 0 ? 11 : month - 1;
      master_data.months.next = month === 11 ? 0 : month + 1;
      debug && console.log("prev "+master_data.months.prev+" -> "+start_of_curr+" - "+daysOfMonth[master_data.months.prev]+"%7 = "+(start_of_curr - daysOfMonth[master_data.months.prev]%7));
    // setting master_data.day_start
      master_data.day_start.curr = start_of_curr;
      var temp_prev_som = start_of_curr - daysOfMonth[master_data.months.prev]%7;
      if(temp_prev_som < 0){
        temp_prev_som = 7 + temp_prev_som;
      }
      master_data.day_start.prev = temp_prev_som;
      master_data.day_start.next = weekday_count === 8 ? 0 : weekday_count-1;
      //return prev_next;
      if(debug){
        console.log("    P   C   N   ");
        console.log(" m ", master_data.months.prev, " ", master_data.months.curr, " ", master_data.months.next);
        console.log(" d ", master_data.day_start.prev, " ", master_data.day_start.curr, " ", master_data.day_start.next);
      }
    }
    var d = new Date();
    var year = d.getUTCFullYear();
    var day = d.getUTCDay();
    var date = d.getUTCDate();
    var month = d.getUTCMonth();
    // our global object
    var master_data = {
      day_start: {
        prev: 0, curr: day - (date%7 - 1) + 7, next: 0
      },
      months: {
        prev: month-1, curr: month, next: month+1
      }
    };
    //Getting February Days Including The Leap Year
    if ((year % 100!=0) && (year% 4==0) || (year%400 == 0 )) {
      var febDays = 29;
    } else {
      var febDays = 28;
    }
    // Getting The Months and Days of the Week
    var daysOfMonth = [31, febDays, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    var months_full = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var debug = false;
    $(document).ready(function(){
      console.clear();
      var d = new Date();
      myCalendar();
      var main_obj = master_data;
      //Navigation Buttons
      $('.prev-month').click(function(){
        myCalendar("prev"); 
      });

      $('.next-month').click(function(){
        myCalendar("next");
      });
    });
  
</script>
<script>
  eventMouseover: function(event, jsEvent, view) {
    $('.fc-event-inner', this).append('<div id=\"'+event.id+'\" class=\"hover-end\">'+$.fullCalendar.formatDate(event.end, 'h:mmt')+'</div>');
}

eventMouseout: function(event, jsEvent, view) {
    $('#'+event.id).remove();
}
</script>
</html>
