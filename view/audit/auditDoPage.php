<?php 
require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/audit/auditClauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';
require_once __DIR__.'/../../php/audit/auditManager.php';
$GLOBALS['auditId'] = $_GET['auditId'];
$GLOBALS['loggedInUserRole'] = $_SESSION['user_role'];
$GLOBALS['loggedInUserId'] = $_SESSION['user_id'];
$GLOBALS['scoreAuditChecklist']=0;
$GLOBALS['checklistWeight']=0;
$GLOBALS['allClausesArray']=array();
$checklists=array();
$score=0;
$auditId = $_GET['auditId'];
$complianceId=array();
$auditManager = new AuditManager();
$workingDetailsOfAudit = $auditManager->getWorkingDetails($auditId, $loggedInUserRole);
error_log("working Details".print_r($workingDetailsOfAudit,true));
$complianceId = explode(",",$workingDetailsOfAudit['complianceId']);
$GLOBALS['auditor']=$workingDetailsOfAudit['auditor'];
$GLOBALS['auditee']=$workingDetailsOfAudit['auditee'];
$auditStatus = $workingDetailsOfAudit['status'];
$auditTitle = $workingDetailsOfAudit['title'];
$complianceName = $workingDetailsOfAudit['complianceName'];
$version = $workingDetailsOfAudit['version'];
$GLOBALS['workingStatus'] = $workingDetailsOfAudit['workingStatus'];
$isViewOnly = $workingDetailsOfAudit['isViewOnly'];
$clauseManager = new AuditClauseManager();
for($i=0;$i<count($complianceId);$i++)
{
$allClauses[$i] = $clauseManager->getAll($complianceId[$i], $workingDetailsOfAudit);
}
error_log("complianceId".print_r(count($complianceId),true));
$complianceCount=count($complianceId);
$accordionId = $complianceId;  
$GLOBALS['capa']="false";
function tabledata($clause){ 
     //error_log("clause: ".print_r($clause,true));
     ?>     


    
    
       <?php  
        if($clause['subClauses']!=null){
            ?>
             <tr>
                <td style="width:1%;"><?php echo $clause['orderNumber'] ?></td>
                <?php if($clause['clauseDesc']!=null && $clause['clauseName']!=null) { ?>
                <td style="width:10%;"><?php echo $clause['clauseDesc']; ?></td> <?php }?>
                <?php if($clause['clauseDesc']==null || $clause['clauseName']==null) { ?>
                <?php   if($clause['clauseDesc']!=null){
                 ?>

                <td style="width:10%;"><?php echo $clause['clauseDesc']; ?></td> <?php }
                     if($clause['clauseName']!=null){
                 ?>

                <td style="width:10%;"><?php echo $clause['clauseName']; ?></td> <?php } }
                 
               ?>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
        <?php 
            foreach($clause['subClauses'] as $subClause)
            {
        tabledata($subClause);            
        } }
        else{
            array_push($GLOBALS['allClausesArray'],$clause['clauseId']);
         
            ?>
                <tr>
                <td style="width:1%;"><?php echo $clause['orderNumber'] ?></td>
                 <?php if($clause['clauseDesc']!=null && $clause['clauseName']!=null) { ?>
                <td style="width:10%;"><?php echo $clause['clauseDesc']; ?></td> <?php }?>
                <?php if($clause['clauseDesc']==null || $clause['clauseName']==null) { ?>
                <?php   if($clause['clauseDesc']!=null){
                 ?>

                <td style="width:10%;"><?php echo $clause['clauseDesc']; ?></td> <?php }
                     if($clause['clauseName']!=null){
                 ?>

                <td style="width:10%;"><?php echo $clause['clauseName']; ?></td> <?php } }
                 
               ?>
                    <input type="hidden" id="loggedInUser" value="<?php echo $GLOBALS['loggedInUserId'] ?>">
                    <input type="hidden" id="auditStatus" value="create">
                    <input type="hidden" id="auditId" value="<?php echo $GLOBALS['auditId'] ?>">
                    <input type="hidden" id="action" value="saveClause">
                    <input type="hidden" id="auditor_comments<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="auditorStatus<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="isCklsUpdateReqd<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="auditCklIdsForClause<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="score<?php echo $clause['clauseId'] ?>" value="0">
                </td>
                <td>
                    <?php if($clause['auditClauseForThisClauseId']['target_date']!=null){ ?>
                    <input type="text" class="form-control datepickerClass notranslate"  id="<?php echo 'target_date'.$clause['clauseId']?>" <?php if($GLOBALS['workingStatus']!="prepare pending") echo 'disabled="disabled"'?> value="<?php echo date('Y-m-d',strtotime($clause['auditClauseForThisClauseId']['target_date'])); ?>" > <?php } ?>
                <?php if($clause['auditClauseForThisClauseId']['target_date']==null){ ?>
                            <input type="text" class="form-control datepickerClass notranslate"  id="<?php echo 'target_date'.$clause['clauseId']?>" <?php if($GLOBALS['workingStatus']!="prepare pending") echo 'disabled="disabled"'?> value="<?php echo date('Y-m-d',strtotime(date("Y/m/d"))); ?>"> <?php } ?>
                        </td>
                    <td>  
            <h5>Priority</h5> 
            <div class="btn-group btn-group-solid">
            <button type="button" class="btn btn-dark" id="priorityLow<?php echo $clause['clauseId'] ?>"onclick="setPriority(<?php echo $clause['clauseId']?>,'low')" <?php if($clause['auditClauseForThisClauseId']['priority']=="low"){echo "style='background-color:green'";  
            }?>>L</button>
              <button type="button" class="btn btn-dark" id="priorityMedium<?php echo $clause['clauseId'] ?>"onclick="setPriority(<?php echo $clause['clauseId']?>,'medium')" <?php if($clause['auditClauseForThisClauseId']['priority']=="medium"){echo "style='background-color:yellow'"; }?>>M</button>
              <button type="button" class="btn btn-dark" id="priorityHigh<?php echo $clause['clauseId'] ?>" onclick="setPriority(<?php echo $clause['clauseId']?>,'high')" <?php if($clause['auditClauseForThisClauseId']['priority']=="high"){echo "style='background-color:red'";}?>>H</button>
          </div>
        <input type="hidden" id="<?php echo 'priority'.$clause['clauseId']?>" value="<?php echo $clause['auditClauseForThisClauseId']['priority']?>">
                <h5 style="margin-left: 150px;margin-top: -60px;">Severity</h5>    

        <div class="btn-group btn-group-solid" style="margin-left: 150px;margin-top: 3px;">
         <button type="button" class="btn btn-dark" id="severityLow<?php echo $clause['clauseId'] ?>" class="btn btn-dark" onclick="setSeverity(<?php echo $clause['clauseId']?>,'low')"<?php if($clause['auditClauseForThisClauseId']['severity']=="low"){echo "style='background-color:green'";  
        }?>>L</button>
              <button type="button" class="btn btn-dark" id="severityMedium<?php echo $clause['clauseId'] ?>" class="btn btn-dark" onclick="setSeverity(<?php echo $clause['clauseId']?>,'medium')" <?php if($clause['auditClauseForThisClauseId']['severity']=="medium"){echo "style='background-color:yellow'"; 
            }?>>M</button>
              <button type="button" class="btn btn-dark" id="severityHigh<?php echo $clause['clauseId'] ?>" class="btn btn-dark" onclick="setSeverity(<?php echo $clause['clauseId']?>,'high')" <?php if($clause['auditClauseForThisClauseId']['severity']=="high"){echo "style='background-color:red'";  
          }?>>H</button>
                                    </div>
                                   
                                <input type="hidden" id="<?php echo 'severity'.$clause['clauseId']?>" value="<?php echo $clause['auditClauseForThisClauseId']['severity']?>">
                    </td>
                    <td width="30%">
                    <div class="row">
                      <?php  include '../common/auditDoPageAuditorDropDown.php';  ?>
                      <?php  include '../common/auditDoPageAuditeeDropDown.php';  ?>
                      </div>
                    </td>
                   
            </tr>
            

          
          
               
        
 <?php   }
    }
    
 
?>
<!DOCTYPE html>
<html>

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
<link href="./assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

   <script src="js/compliance/clauseManagement.js"></script>
    <script src="js/audit/auditClauseManagement.js"></script>
  
  
                    
   <link href="./assets/css/demo3/style.bundle.css" rel="stylesheet" type="text/css" />
           
        <link rel="shortcut icon" href="./assets/media/logos/favicon.ico" />
    </head>
    
   <body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >

       
      
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " >
<div class="kt-header-mobile__logo">
<a href="demo3/index.html">
<img alt="Logo" src="./assets/media/logos/logo-2-sm.png"/>
</a>
</div>
<div class="kt-header-mobile__toolbar">
<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>

<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
</div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>


<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " >
<!-- begin: Header Menu -->

<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab "  >

</div>
</div>
<!-- end: Header Menu -->   <!-- begin:: Header Topbar -->
<div class="kt-header__topbar">

   <div class="kt-header__topbar-item dropdown">
       <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="true">
           <span class="kt-header__topbar-icon"><i class="flaticon2-bell-alarm-symbol"></i></span>
           <span class="kt-hidden kt-badge kt-badge--dot kt-badge--notify kt-badge--sm"></span>
       </div>
       <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">

       </div>
   </div>
<!--end: Notifications -->

<!--begin: Quick Actions -->
   

<div class="kt-header__topbar-item kt-header__topbar-item--langs">
   <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
       <span class="kt-header__topbar-icon">
<img class="" src="./assets/media/flags/012-uk.svg" alt="" />
</span>
   </div>
   <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
       <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
    <li class="kt-nav__item kt-nav__item--active">
        <a href="#" class="kt-nav__link">
            <span class="kt-nav__link-icon"><img src="./assets/media/flags/020-flag.svg" alt="" /></span>
            <span class="kt-nav__link-text">English</span>
        </a>
    </li>
    <li class="kt-nav__item">
        <a href="#" class="kt-nav__link">
            <span class="kt-nav__link-icon"><img src="./assets/media/flags/016-spain.svg" alt="" /></span>
            <span class="kt-nav__link-text">Spanish</span>
        </a>
    </li>
    <li class="kt-nav__item">
        <a href="#" class="kt-nav__link">
            <span class="kt-nav__link-icon"><img src="./assets/media/flags/017-germany.svg" alt="" /></span>
            <span class="kt-nav__link-text">German</span>
        </a>
    </li>
</ul>      </div>
</div>
<div class="kt-header__topbar-item kt-header__topbar-item--langs">
   <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
     <span class="kt-header__topbar-icon" title="logout" onclick="logout();">
 <img src="./assets/media/icons/logout.svg" alt="" />
</span>
   </div>
</div>

</div>
<!-- end:: Header Topbar -->
</div>
</div>
</div>
<div class="kt-grid kt-grid--hor kt-grid--root">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">


<div class="kt-portlet" style="margin-top: -50px;">
<div class="kt-portlet__head kt-portlet__head--lg" style="background-color:#2a5aa8;">
<div class="kt-portlet__head-label">
<span class="kt-portlet__head-icon">
<i class="kt-font-brand flaticon2-line-chart"></i>
</span>
<h3 class="kt-portlet__head-title" style="color: white;">
<?php echo $auditTitle?>
</h3>
</div>
   <?php if($_SESSION['user_role'] == 'auditor') {?>
      
                <div class="row">
            
                <div class="col-md-6" style="margin-top: 10px;"><button class="btn btn-success" data-spinner-color="#333" onclick="saveAllClauses(allClauses)" <?php if($workingStatus!="prepare pending") echo "style='display:none'" ?>>
                <i class="fa fa-pencil-square" aria-hidden="true"></i>Draft </button> </div>
                <!-- <div class="co1-md-2"></div> -->

                <div class="col-md-2" style="margin-top: 10px;"> <button class="btn btn-primary" onclick="saveAndChangeAuditStatus(allClauses,<?php echo $auditId ?>, '<?php echo $workingStatus ?>', false, <?php echo $GLOBALS['capa'] ?>)" <?php if($workingStatus!="prepare pending") echo "style='display:none'" ?>>Schedule</button> </div>

            </div>
       
            <?php }?> 
         
</div>

<div class="kt-portlet__body" >

  <div class="table-responsive">
    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th>Control Number</th>
                        <th style="width: 20% !important;">Control Set</th>
                        <th style="width: 20% !important;">Target Date</th>
                        <th >Auditor Response</th>
                        <th >Assign Checklists</th>
                     

                       
                    </tr>
                </thead>
                <tbody>
                <?php
                //error_log("all clause".print_r($allClauses,true)); 
                if($complianceCount!=1)
                {
                foreach($allClauses as $clauses)
                {
                    
                foreach ($clauses as $clause) {
                 tabledata($clause);
                }
            }
        }
        else{
            //error_log("all clause".print_r(count($allClauses),true));
                 foreach($allClauses as $clauses)
                {
                      foreach ($clauses as $clause) {
                 tabledata($clause);
                }
                     
                }
        }
                    
                ?>
                </tbody>
            </table>
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<div>
  
</div>
<?php

include 'sidemenu.php';
 ?>


 <script>
            var KTAppOptions = {"colors":{"state":{"brand":"#2c77f4","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
        </script>
        <!-- end::Global Config -->

    <!--begin:: Global Mandatory Vendors -->

  <!--    <script src="js/compliance/clauseManagement.js"></script>
    <script src="js/audit/auditClauseManagement.js"></script> -->
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
          <script src="assets/toggleButton/bootstrap-toggle.min.js"></script>
      <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script> 
      <script src="./assets/js/demo3/scripts.bundle.js" type="text/javascript"></script>
   <script src="./assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
                
<script src="./assets/js/demo3/pages/crud/datatables/extensions/buttons.js" type="text/javascript"></script>
         <script src="./assets/js/demo3/pages/crud/forms/widgets/select2.js" type="text/javascript"></script>  
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>         
            </body>
    <!-- end::Body -->
</html>


<script>
        var allClauses=<?php echo json_encode($GLOBALS['allClausesArray'])?>;
        

    </script> 
<script type="text/javascript">
    function logout(){
                debugger
                 $.ajax({
                        dataType: "json",
                        type: "POST",
                        url: "/newtheme/logout.php"
                         });
                 window.location="/newtheme/logout.php";
            }
</script>