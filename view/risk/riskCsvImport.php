<?php 
require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/audit/auditClauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';
require_once __DIR__.'/../../php/audit/auditManager.php';
$companyId=$_SESSION['company'];
?>
<!DOCTYPE html>
<html>

<head lang="en">
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Fresh GRC Admin</title>
  <base href="/freshgrc/">


    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>  
   
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css"/>
            <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

        <script src="assets/multiselectDropdown/bootstrap-multiselect.js" type="text/javascript"></script>  
    <link rel="stylesheet" type="text/css" href="assets/multiselectDropdown/bootstrap-multiselect.css">

    <link href="metronic/theme/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
   <!--  <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
     
    <link href="metronic/theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    
<!--     <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 -->   
    <link href="assets/toggleButton/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="assets/toggleButton/bootstrap-toggle.min.js"></script>
       
        <script src="js/risk/riskManagement.js"></script>

    <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!--       <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 -->       <script src="//fast.appcues.com/31746.js">// NOTE: These values should be specific to the current user.
  Appcues.identify("<?php echo $user->id; ?>", { // Replace with unique identifier for current user
    name: "Gokul Kandasamy",   // Current user's name
    email: "gokulk@fixnix.co"

, // Current user's email
    created_at: <?php echo $user->created_at; ?>,    // Unix timestamp of user signup date

    // Additional user properties.
    // is_trial: "<?php echo $user->is_trial; ?>",
    // plan: "<?php echo $user->plan; ?>"

  });
 </script>
    
    <!-- Bootstrap core CSS -->
    <!-- <link href="assets/DataTables/Bootstrap-3.3.6/css/bootstrap.css" rel="stylesheet"> -->
    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
     <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">

   <!--  <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css"> -->
     <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />

        <!-- script link  multi select-->
     <!-- <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script> -->
    
         <style type="text/css">
           .ui-datepicker-month{
            color:"black";
           }
           .ui-datepicker-year{
            color:"black";
           }

         </style>
         <!-- end -->


</head>
<body  style="background-color: #f0f5f5">

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../common/leftMenu.php';
    ?>

    <body>
      <div class="page-content-wrapper">                
        <div class="page-content">                  
          <div class="row">
            <div class="col-md-12">
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption">Import Risks For the below</div>                              
                </div>  

                <div class="portlet-body ">
                  <form action="#" role="form" >
                   <div id="form1" style="margin-left:8%;margin-bottom: 72px;">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                    <input type="hidden" class="form-control" id="auditId">
                    <input type="hidden" class="form-control" id="action" value="create">
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" value="<?php echo $companyId?>" id="company">
                  </div>
                </div>
               
                <div class="row" style="margin-left: -29px !important;">
                  <div class="col-md-2">
                       <div class="form-group ">
                       <?php include '../risk/riskLocation.php';?> 
                    </div>
                    </div>
                     <div class="col-md-3"  >
                      <div class="form-group ">
                        <span class="select2-selection__arrow" role="presentation"></span>
                         <?php include '../common/categoryDropDown.php';?>
                      </div>
                    </div>
                    <div class="col-md-3" >
                      <div class="form-group">
                            <?php include '../risk/riskSubCategory.php';?>
                    </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group " >
                        <?php include '../common/regulationDropDown.php';?>
                      </div>
                    </div>
                     <div class="col-md-2">
                      <div class="form-group" id="controlDrop">
                        <?php include '../common/controlsDropDown.php';?>
                      </div>
                      </div> 
                      </div> 

 <!--  <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2" style="margin-top: 23px;margin-left: 20px;">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Compliance
    </button>
    <ul class="dropdown-menu">
      <input class="form-control" id="myInput" type="text" placeholder="Search..">
      <li><a href="#">HTML</a></li>
      <li><a href="#">CSS</a></li>
      <li><a href="#">JavaScript</a></li>
      <li><a href="#">jQuery</a></li>
      <li><a href="#">Bootstrap</a></li>
      <li><a href="#">Angular</a></li>
    </ul>
  </div>
  <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script> -->
                
                  
                   <div class="row" style="margin-top: 10px !important;">  
                     

                    <?php include '../common/riskRoleDropDown.php';?>

                     
                    </div>
                  
                  
                  
                  
                    
               </div>
               <div class="modal-footer" style="border-top: 1px solid #eef1f5;">

                <div class="col-md-12">
                  
                </div>
                 <label for="riskCsv" aria-hidden="true">
                                <i class="btn btn-danger btn-block fa fa-file-excel-o">  Import Risks</i>
                      <input type="file" style="display:none" onchange= "importRiskCsv()" id="riskCsv"/>

                </label>
                
              </div> 
              </form>      
                </div>
              
              </div>         
            </div>             
          </div>
        </div>       
      </div> 
      <a class="btn btn-primary btn-sm" href="javascript:Appcues.show('-LDaOP_Ap6RthIiOn5Oh')">Show hints &#x27a4;</a>
    </body>  
    <input type="hidden" class="form-control" id="auditCapaCheck" value="<?php echo $GLOBALS['capa'] ?>">
    <input type="hidden" class="form-control" id="parentAudit" value=0>

  </html>
  <script type="text/javascript">
     $(function() {
        $(".datepickerClass").datepicker();
        $('.ui-datepicker').addClass('notranslate');
    });
  </script>