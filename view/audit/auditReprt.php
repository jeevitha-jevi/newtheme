<base href="/newtheme/">
  <head>
    <script type="text/javascript" src="assets/sweetalert2/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="assets/sweetalert2/core.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">

<?php 

require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/audit/auditClauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';
require_once __DIR__.'/../../php/audit/auditManager.php';

$auditId = $_GET['auditId'];
if(!$auditId){
  $auditId=$_POST['auditId'];
}
$loggedInUserRole = $_SESSION['user_role'];
$GLOBALS['scoreAuditChecklist']=0;
$GLOBALS['checklistWeight']=0;
$checklists=array();

$auditManager = new AuditManager();
$auditdetails = $auditManager->getAuditDetails($auditId);
$workingDetailsOfAudit = $auditManager->getWorkingDetails($auditId, $loggedInUserRole);
$complianceId = $workingDetailsOfAudit['complianceId'];
$auditStatus = $workingDetailsOfAudit['status'];
$auditTitle = $workingDetailsOfAudit['title'];
$complianceName = $workingDetailsOfAudit['complianceName'];
$version = $workingDetailsOfAudit['version'];
$workingStatus = $workingDetailsOfAudit['workingStatus'];
$isViewOnly = $workingDetailsOfAudit['isViewOnly'];

$clauseManager = new AuditClauseManager();
$allClauses = $clauseManager->getAll($complianceId, $workingDetailsOfAudit);
//error_log("all clauses".print_r($allClauses,true));
$accordionId = $complianceId;
if (isset($_POST['zip'])){
  error_log("auditId inside isset".print_r($_POST['auditId'],true));
  zip($_POST['auditId']);
}
function zip($auditId){

error_log("auditId".print_r($auditId,true));
$manager=new AuditManager();
$results=$manager->getZip($auditId);
$filname=array();
foreach($results as $result){
array_push($filname,$result['file_name']);
}

$archive_file_name='my-archive.zip';
//if true, good; if false, zip creation failed
$result = create_zip($filname,'my-archive.zip');
if($result != false){
header("Content-type: application/zip"); 
header("Content-Disposition: attachment; filename=$archive_file_name");
header("Content-length: " . filesize($archive_file_name));
header("Pragma: no-cache"); 
header("Expires: 0"); 
readfile("$archive_file_name");
unlink('my-archive.zip');
//print json_encode(file_exists(__DIR__.'/../../uploadedFiles/auditeeFiles/logo.png'));

}
else{
  echo "


      <script>
        swal({ 
           title:  'Please Fill all the form fields',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        }); </script>
       
         ";
}
}
function create_zip($files = array(),$destination = '',$overwrite = false) {
    //if the zip file already exists and overwrite is false, return false
    if(file_exists($destination) && !$overwrite) { return false; }
    //vars
    $valid_files = array();
    //if files were passed in...
    if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
            //make sure the file exists
            if(file_exists(__DIR__.'/../../uploadedFiles/auditeeFiles/'.$file)) {
                error_log("valid file");
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if(count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach($valid_files as $file) {
            $zip->addFile(__DIR__.'/../../uploadedFiles/auditeeFiles/'.$file,$file);
        }
        //debug
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
        
        //close the zip -- done!
        $zip->close();
        
        //check to make sure the file exists
        return file_exists($destination);
    }
    else
    {
        return false;
    }
}
function sum($clause){
    if($clause['subClauses']!=null){
        foreach($clause['subClauses'] as $subClause)
        {
        sum($subClause);
    }
}
else{
    foreach($clause['checklists'] as $checklist)
    {
      $GLOBALS['scoreAuditChecklist']=$GLOBALS['scoreAuditChecklist']+$checklist['auditChecklistForThisCklId']['audit_checklist_score_per'];
      $GLOBALS['checklistWeight']=$GLOBALS['checklistWeight']+$checklist['checklistScore'];
}
}
}
function tabledata($clause){ 
     error_log("clause: ".print_r($clause,true));
     ?>     
            <tr>
                <td><?php echo $clause['clauseDesc'] ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

    
    
       <?php  
        if($clause['subClauses']!=null){
            
            ?>
            
            
        
        <?php 
            foreach($clause['subClauses'] as $subClause)
            {
        tabledata($subClause);            
        } }

        else{
            

          
            foreach($clause['checklists'] as $checklist){
              
                 error_log("Score: ".print_r($GLOBALS['checklistWeight'],true));
                                ?>
               
                <tr>
                <td></td>
                <td><?php echo $checklist['checklistDesc'] ?></td>
                <td><?php echo $checklist['auditChecklistForThisCklId']['auditee_comment'] ?></td>
                <td><?php echo $checklist['auditChecklistForThisCklId']['auditee_response'] ?></td>
                <td><?php echo $checklist['auditChecklistForThisCklId']['corrective_action'] ?></td>
                
                <td><?php echo $checklist['auditChecklistForThisCklId']['audit_checklist_score_per']?></td>
                <td><?php echo $checklist['checklistScore']?></td>
            </tr>
        
 <?php   }
    }

    }

 
?>
<!DOCTYPE html>

<html lang="en" >
    <!-- begin::Head -->
    <head><!--begin::Base Path (base relative path for assets of this page) -->
<base href="/newtheme/"><!--end::Base Path -->
        <meta charset="utf-8"/>

        <title>Metronic | Buttons Examples</title>
        <meta name="description" content="Buttons examples">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">        <!--end::Fonts -->

                    <!--begin::Page Vendors Styles(used by this page) -->
                            <link href="./assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
                        <!--end::Page Vendors Styles -->
        
        
        <!--begin:: Global Mandatory Vendors -->
<link href="./assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<link href="./assets/vendors/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />

     
    <script src="js/audit/auditCreateManagement.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <!-- <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>  -->
      
    <!-- <script type="text/javascript" src="assets/DataTables/DataTables-1.10.12/js/jquery.dataTables.min.js"></script> -->
        <script type="text/javascript" src="../../assets/DataTables/Buttons-1.2.1/js/dataTables.buttons.min.js"></script> 
           <script type="text/javascript" src="../../assets/DataTables/Buttons-1.2.1/js/buttons.flash.min.js"></script> 
        <script type="text/javascript" src="../../assets/DataTables/pdfmake.min.js"></script>
        <script type="text/javascript" src="../../assets/DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="../../assets/DataTables/Buttons-1.2.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="../../assets/DataTables/Buttons-1.2.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>  
  
    <script src="js/audit/auditCreateManagement.js"></script>
                    
   <link href="./assets/css/demo3/style.bundle.css" rel="stylesheet" type="text/css" />
           
        <link rel="shortcut icon" href="./assets/media/logos/favicon.ico" />
    </head>
   
    <body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >


   <?php 
 foreach($allClauses as $clause){
    sum($clause);
 }
   ?>
<!-- <div id="content"> -->
<div>
 <button class="btn" style="color:#fff;background-color:rebeccapurple;margin-left: 15px; margin-top:3%" 
 onclick="goBack()">Go Back</button>
 <script>

      function goBack() {
        window.close();
        }
      </script>
</div>
<div>
 <img src="pdfimage.png" data-toggle="tooltip" title="PDF" class="responsive" id="cmd">
  </div>

     <form name="zip" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="zip">
     <input type="hidden" id="auditId" value="<?php echo $auditId ?>" name="auditId">
     </form>
     <div id="element-to-print">
      <div class="container-fluid"  style="margin-left:170px;">
        <div class="row">
              <div class="col-md-4 col-sm-2" style="">
                  <div class="dash-notification">
                      <div class="notification-body" style="background-color: #394595;">
                         <i class="fa fa-tasks" aria-hidden="true"></i>
                          <div class="header-align" style="color: white;font-size: 18px;">
                              <p>Total Score:<?php echo $GLOBALS['scoreAuditChecklist']?></p>
                              <a ui-sref="home.list"><h4 id="reg_users" style="color:white;"><?php echo $GLOBALS['scoreAuditChecklist']?></h4></a>
                          </div>
                      </div>
                    </div>
              </div>
              <div class="col-md-4 col-sm-2">
                  <div class="dash-notification">
                      <div class="notification-body" style="background-color: #35C142;">
                          <i class="fa fa-balance-scale" aria-hidden="true"></i>
                          <div class="header-align" style="color: white;font-size: 18px;">
                              <p>Total Checklist Weight:<?php echo $GLOBALS['checklistWeight']?></p>
                              <a ui-sref="home.list"><h4 id="due" style="color:white;"><?php echo $GLOBALS['checklistWeight']?></h4></a>
                          </div>
                      </div>
                      
                  </div>
              </div>
              <div class="col-md-4 col-sm-2">
                  <div class="dash-notification">
                      <div class="notification-body" style="background-color: #2FB5D3;">
                          <i class="fa fa-tasks" aria-hidden="true"></i>
                          <div class="header-align" style="color: white;font-size: 18px;">
                              <p>Audit Overall Score:<?php echo $GLOBALS['scoreAuditChecklist'] ."/".$GLOBALS['checklistWeight']?></p>
                            <a ui-sref="home.list"><h4 id="delay" style="color: white;"><?php echo $GLOBALS['scoreAuditChecklist'] ."/".$GLOBALS['checklistWeight']?></h4></a>
                          </div>
                      </div>
                     
                  </div>
              </div>
          </div>
      </div>
              
<div class="kt-grid kt-grid--hor kt-grid--root" style="margin-top: -100px;"> 
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


<div class="kt-portlet">
<div class="kt-portlet__head kt-portlet__head--lg">
<div class="kt-portlet__head-label">
<span class="kt-portlet__head-icon">
<i class="kt-font-brand flaticon2-line-chart"></i>
</span>
<h3 class="kt-portlet__head-title">
<?php echo $auditTitle ?>
</h3>
</div>

</div>

<div class="kt-portlet__body">
<!--begin: Datatable -->
<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                                        <thead>
                                            <tr>
                                            <th>Audit title</th>
                                            <th>Audit compliance name</th>
                                            <th>Audit type</th>
                                            <th>Audit status</th>
                                            <th>Auditor name</th>
                                            <th>Audit company name</th>
                                            <th>Department</th>
                                            <th>location</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            for($i=0;$i<count($auditdetails);$i++) { 
                    ?>
                                            <tr>
                                                <td><?php echo $auditdetails[$i]['title'];  ?></td>
                                                <td><?php echo $auditdetails[$i]['complianceName'];  ?></td>
                                                <td><?php echo $auditdetails[$i]['type'];  ?></td>
                                              <td><?php echo $auditdetails[$i]['status'];  ?></td>
                                              <td><?php echo $auditdetails[$i]['auditorName'];  ?></td>
                                              <td><?php echo $auditdetails[$i]['companyName'];  ?></td>
                                              <td><?php echo $auditdetails[$i]['deptname'];  ?></td>
                                              <td><?php echo $auditdetails[$i]['lname'];  ?></td>
                                               
                                            </tr>
                                           
                                           <?php
                 }
            ?>
                                        </tbody>
                                    </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


<div class="kt-grid kt-grid--hor kt-grid--root" style="margin-top: -180px;">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


<div class="kt-portlet">
<div class="kt-portlet__head kt-portlet__head--lg">
<div class="kt-portlet__head-label">
<span class="kt-portlet__head-icon">
<i class="kt-font-brand flaticon2-line-chart"></i>
</span>
<h3 class="kt-portlet__head-title">
<?php echo $auditTitle ?>
</h3>
</div>

</div>

<div class="kt-portlet__body" >
  <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1" style="width:200%;">
  <thead>
                                        <tr>
                                            <th>Control Set</th>
                                            <th>Controls</th>
                                            <th>Auditee Comment</th>
                                            <th>Auditee Response</th>
                                            <th>Action</th>
                                           
                                            <th>Score</th>
                                            <th>Checklist Weightage</th>
                                        </tr>
                                        </thead>
                                      <?php 
                                      foreach ($allClauses as $clause) {
                                       tabledata($clause);
                                      }
                                          
                                      ?>
                                  </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      
                  
<?php
include '../siteHeader.php';
include 'sidemenu.php';
 ?>

        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {"colors":{"state":{"brand":"#2c77f4","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
        </script>
        <!-- end::Global Config -->

    <!--begin:: Global Mandatory Vendors -->
<script src="./assets/vendors/general/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="./assets/vendors/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
<script src="./assets/vendors/general/moment/min/moment.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="./assets/vendors/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/wnumb/wNumb.js" type="text/javascript"></script>
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="./assets/vendors/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/js/vendors/bootstrap-switch.init.js" type="text/javascript"></script>
<script src="./assets/vendors/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
<script src="./assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
<script src="./assets/vendors/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
<script src="./assets/vendors/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
<script src="./assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
<script src="./assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
<script src="./assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
<script src="./assets/vendors/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
<script src="./assets/vendors/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
<script src="./assets/vendors/general/autosize/dist/autosize.js" type="text/javascript"></script>
<script src="./assets/vendors/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/js/vendors/dropzone.init.js" type="text/javascript"></script>
<script src="./assets/vendors/general/quill/dist/quill.js" type="text/javascript"></script>
<script src="./assets/vendors/general/@yaireo/tagify/dist/tagify.polyfills.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/@yaireo/tagify/dist/tagify.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="./assets/vendors/general/markdown/lib/markdown.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/js/vendors/bootstrap-markdown.init.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/js/vendors/bootstrap-notify.init.js" type="text/javascript"></script>
<script src="./assets/vendors/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
<script src="./assets/vendors/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/js/vendors/jquery-validation.init.js" type="text/javascript"></script>
<script src="./assets/vendors/general/toastr/build/toastr.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/dual-listbox/dist/dual-listbox.js" type="text/javascript"></script>
<script src="./assets/vendors/general/raphael/raphael.js" type="text/javascript"></script>
<script src="./assets/vendors/general/morris.js/morris.js" type="text/javascript"></script>
<script src="./assets/vendors/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
<script src="./assets/vendors/general/counterup/jquery.counterup.js" type="text/javascript"></script>
<script src="./assets/vendors/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/js/vendors/sweetalert2.init.js" type="text/javascript"></script>
<script src="./assets/vendors/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
<script src="./assets/vendors/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
<script src="./assets/vendors/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
<script src="./assets/vendors/general/dompurify/dist/purify.js" type="text/javascript"></script>
<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
          
      <script src="./assets/js/demo3/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

                                    <script src="./assets/js/demo3/pages/crud/datatables/extensions/buttons.js" type="text/javascript"></script>
                        <!--end::Page Scripts -->
            </body>
    <!-- end::Body -->
</html>
