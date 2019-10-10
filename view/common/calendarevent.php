<?php require_once __DIR__.'/../header.php';?>
<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">

    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <script src="js/audit/auditManagement.js"></script>


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">



    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">


    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="metronic/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->

    <link href="metronic/theme/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="metronic/theme/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" /> 
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> 



     <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="metronic/theme/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
   <!--  <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script> -->
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="metronic/theme/assets/apps/scripts/calendar.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="metronic/theme/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="metronic/theme/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>  

   
</head>
<style type="text/css">
.page-header.navbar .top-menu .navbar-nav>li.dropdown>.dropdown-toggle>i {
    font-size: 16px;
}.page-sidebar {
  margin-top:75px !important;
}
</style>
<body class="with-side-menu-compact">
    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
    ?>
    <?php if($_SESSION['user_role'] == 'auditor') {?>
       
    <?php }?>
</body>
    <input type="hidden" value=<?php echo $_SESSION['user_id'] ?> id="loggedInUser">
    
   
    <div class="row" style="height: 400px; width: 1252px; margin-left: 250px;">
      <div class="col-md-12" style="margin-top: 115px;">
        <div class="portlet light portlet-fit bordered calendar">
          <div class="portlet-title">
            <div class="caption">
              <i class=" icon-layers font-green"></i>
              <span class="caption-subject font-green sbold uppercase">Calendar</span>
            </div>
          </div>
          <div class="portlet-body">
            <div class="row">
              <div class="col-md-3 col-sm-12">
                  <!-- BEGIN DRAGGABLE EVENTS PORTLET-->
                <h3 class="event-form-title margin-bottom-20">Draggable Events</h3>
                  <div id="external-events">
                    <form class="inline-form">                      
                      <input type="text" value="" class="form-control" placeholder="Event Title..." id="event_title" />
                      <input type="hidden" name="action" id="action">
                      <br/>
                      <a href="javascript:;" id="event_add" class="btn green"> Add Event </a>
                    </form>
                    <hr>                                  
                    <div id="event_box" class="draggable" style="display: inline-grid;"></br></div>
                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline" for="drop-remove"> remove after drop
                        <input type="checkbox" class="group-checkable" id="drop-remove" />
                        <span></span>
                      </label>
                    <hr class="visible-xs" />
                  </div>                              
                </div>
                <div class="col-md-9 col-sm-12">
                  <div id="calendar" class="has-toolbar"> </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>   <!-- END THEME LAYOUT SCRIPTS -->       
  </body>
           
</body>



</html>
