
<!DOCTYPE html>
<html>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>  
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script type="text/javascript" src="assets/Chart.js/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="assets/Chart.js/samples/utils.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.3/fullcalendar.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.3/fullcalendar.css">
     <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/cupertino/jquery-ui.css">

    <style>
        #viewdata {

            margin-left: 150px;
            margin-top: 100px;
            margin-right: -20px;
            margin-bottom: 55px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        td {
            height: 50px;
            vertical-align: middle;
        }

        i.fa-vibe {
            content: "";
            background-image: url('complaints.png');

            width: 50px;
            height: 50px;
            display: inline-block;
            background-position: center;
            background-size: cover;
        }
        .fc-time-grid table{
            width: 707.5px;
        }
        .fc-widget-content td{
            height:20px;
        }
        .fc-widget-header table thead td{
               height: 16px;

        }

  </style>
  </head>
  <body>
 <div class="col-md-4" style="    width:720px;height: 650px;background: #fff;padding: 5px;border: 1px solid #f2f2f2;border-radius: 4px;margin-bottom: 20px;margin-right: 20px;margin-left: 2px;" >
 <h3 style="color: #26a69a; margin: 2px;" >CALENDAR</h3>
 <div id='calendar' style="margin-bottom: 20px; "></div> 
 </div> 
    
</body>
<script  src="js/audit/auditCalender.js"></script>
</html>