<?php 
require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/audit/auditClauseManager.php';
require_once __DIR__.'/../../php/compliance/complianceManager.php';
require_once __DIR__.'/../../php/audit/auditManager.php';
require '../../php/user/userManager.php';
$companyId=$_SESSION['company'];
?>
<!DOCTYPE html>
<html lang="en" >
 <head><!--begin::Base Path (base relative path for assets of this page) -->
<base href="/newtheme/"><!--end::Base Path -->
        <meta charset="utf-8"/>

        <title>Freshgrc</title>
        <meta name="description" content="Base form control examples">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">        <!--end::Fonts -->
        <!--begin:: Global Mandatory Vendors -->
<link href="assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<link href="assets/vendors/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
<link href="assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
<link href="assets/toggleButton/bootstrap-toggle.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css"/>

<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Styles(used by all pages) -->
                    
                    <link href="assets/css/demo3/style.bundle.css" rel="stylesheet" type="text/css" />
                      
       
                <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->
                <!--end::Layout Skins -->

        <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    </head>
    <!-- end::Head -->

    <!-- begin::Body -->
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
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
<div class="col-md-8" style="margin-left: 300px;margin-top: 100px;">
<!--begin::Portlet-->
<div class="kt-portlet">
<div class="kt-portlet__head">
<div class="kt-portlet__head-label">
<h3 class="kt-portlet__head-title">
CREATE PLAN
</h3>
</div>
</div>

<div class="kt-portlet__body">
<div class="form-group">
<form id="form1">
                      <div class="row">
                        <div class="form-group">
                          <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>">
                          <input type="hidden" class="form-control" id="riskId">
                          <input type="hidden" class="form-control" id="action">
                        </div>
                      </div>
</div>


<div class="form-group row">
  <div class="col-md-6">
    <input type="text" class="form-control" id="riskSubject" required>
                            <input type="hidden" value="<?php echo $companyId?>" id="company">
                            <input type="hidden" value="0" id="incident">
  </div>
  <div class="col-md-6">
<?php include '../risk/riskScenarioDropDown.php';?>
</div>

</div>
<div class="panel panel-default">
<div class="panel-body">
<div class="col-md-12">
<div class="col-md-3">
<div class="form-group">
<?php include'../common/categoryDropDown.php'; ?>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<?php include'../risk/riskSubCategory.php'; ?>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label for="exampleSelect1">Affected Asset</label>
<input type="text" class="form-control" id="affectedAssets" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<?php include'../common/riskSourceDropDown.php'; ?>
</div>
</div>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<div class="col-md-12">
  <div class="col-md-6">
<div class="form-group">
<?php include"../common/assetGroup.php"; ?>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<?php include'../common/assetsDropDown.php'; ?>
</div>
</div>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
  <div class="col-md-12">
    <div class="col-md-4">
<div class="form-group">
<label for="exampleSelect1">Location</label>
<?php include'../common/locationDropDown.php'; ?>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<?php include'../common/teamDropDown.php'; ?>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<?php include'../common/technologyDropDown.php'; ?>
</div>
</div>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
  <div class="col-md-12">
    <div class="col-md-6">
<div class="form-group">
<?php include'../common/regulationDropDown.php'; ?>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<?php include'../common/controlsDropDown.php'; ?>
</div>
</div>
</div>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
  <div class="col-md-12">
<div class="form-group">
 <?php include '../common/riskRoleDropDown.php';?>
</div>
<div class="col-md-3">
<div class="form-group">

</div>
</div>
</div>
</div>
</div>
<div class="form-group">
  <textarea class="form-control" placeholder="Risk Assessment" rows="4"></textarea>
</div>

<div class="form-group">
  <textarea class="form-control" placeholder="Additional Notes" rows="2"></textarea>
</div>
<div class="form-group">
   <div class="panel panel-default">
  <div class="panel-body">
            <label>Risk Assesment Method</label>

            <div class="kt-radio-inline">
              <label class="kt-radio">
                   
                                    <div class="input-group select2-bootstrap-prepend" >          
                                      <label for="chkYes" style="margin-left: 20px;">
                                      <input type="radio" id="chkYes" name="chkPassPort" data-toggle="modal" data-target="#Qualitative_model"/>
                                      Qualitative
                                  </label>
                                  <label for="chkNo" style="margin-left: 20px;">
                                      <input type="radio" id="chkNo" name="chkPassPort" data-toggle="modal" data-target="#Quantitative_model"/>
                                      Quantitative
                                  </label>
                                  
                                </div>
              </label>
            </div>
  </div>
</div>
</div>


</div>

            
          

<div class="kt-portlet__foot" style="float: right;">
<div class="kt-form__actions">
  <button type="button" id="manageButton" onclick="manageModal()" data-dismiss="modal" class="btn btn-primary" style="background-color:#4285f4;float:right;">Plan</button>
</div>
<div class="kt-form__actions">
  <button type="reset" class="btn btn-secondary" style="float:right;" >Cancel</button>
</div>
</div>
<input type="hidden" class="form-control" id="auditCapaCheck" value="<?php echo $GLOBALS['capa'] ?>">
    <input type="hidden" class="form-control" id="parentAudit" value=0>
<!--end::Form-->    
</div>
<!--end::Portlet-->
<div id="Quantitative_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <form id="form1">
                <div class="modal-content" style="border: 1px solid #32c5d2; width: 700px;">
                   <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px; color: #fff;" id="myModalLabel">Quantitative Analysis</h4>
               <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 form-group">
                  <div class="panel panel-default">
                    <div class="panel-heading"><b>Before Safeguard</b></div>
                    <div class="panel-body" style="margin-top: 10px;">
                      <div class="col-md-4" >
                         <div class="form-group">
                            <label>Exposure Factor (EF) <b>*</b></label>
                            <input type="number" class="form-control" id="Exposure_Asset_Before_Safeguard" onblur="SingleLossExpectancyBeforeSafeguard()" >
                          </div>       
                      </div>
                      <div class="col-md-3" >
                        <div class="form-group">
                                 <label>Asset Value (AV)</label>
                                 <input type="number"  class="form-control" id="Asset_Value_Before_Safeguard" onblur="SingleLossExpectancyBeforeSafeguard()" >
                              </div>         
                      </div>                    
                      <div class="col-md-5" >
                        <div class="form-group">
                               <label for="sale" style="margin-top: -18px;">Single Loss Expectancy (SLE)</label>
                               <input type="number" class="form-control" id="Single_Loss_Expectancy_Before_Safeguard" value="" readonly>
                              </div>         
                      </div> 
                        <div class="col-md-6" >
                      <div class="form-group">
                               <label for="">Anualized Rate Of Occurence(ARO)</label>
                               <input type="number" class="form-control" id="Anulaized_Rate_Of_Ocurance_Before_Safeguard" onblur="AnulaizedlossExpectionPrior()">
                              </div>        
                      </div>  
                       <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="sale">Anualized Loss Expectancy(ALE)</label><input type="text" class="form-control"  id="Anualized_Loss_Expection_Before_Safeguard" value = ""   readonly  >
                              </div>
                            </div>
                          </div>                     
                    </div>         
                  </div>
                </div>
                <p style="margin-left: 50px;"><b>* Note:<br>1. EF value in Percentage<br>2. ARO show, times of occurrences in a year </b></p>
              </div>
                                <input type="hidden" class="form-control" value=0  id="Exposure_Asset_After_Safeguard"  onblur="SingleLossExpectancy()">
                                  <input type="hidden" class="form-control" value=0 id="Anulaized_Rate_Of_Ocurance_After_Safeguard" onblur="AnualizedLossExpectionpost()">
                                 <input type="hidden" class="form-control" value=0 id="Single_Loss_Expectancy_After_Safeguard" value = ""  onblur="AnualizedLossExpectionpost()" readonly >
                                <input type="hidden" class="form-control" value=0  id="Anualized_Loss_Expection_After_Safeguard" value = ""   readonly >
                               <input type="hidden" class="form-control" value=0 id="Safeguard" onblur ="NetRiskReductionBenifit()" >
                                <input type="hidden" class="form-control" value=0 id="Net_Risk_Reduction_Benifit"  readonly>
                     <div class="modal-footer">
                     <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2; color: #fff">Submit</button>
                  </div>
                    </div>
                   </form>
                </div>
            </div>
           


<div id="Qualitative_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                <div class="modal-dialog">
                <div class="modal-content" style="border: 1px solid #32c5d2;">
                <h4 class="panel-heading text-center" style=" background-color: #32c5d2;margin-top: 0px; color: #fff;" id="myModalLabel">Qualitative Analysis</h4>
                <div class="modal-body">
                    <form id="form1">
                      <div class="form-group">
                                  <label>Frequency of Occurence Without Control</label>
                                  <select class="form-control" id="Frequency_of_Occurence_Without_Control">
                                    <option></option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Months</label>
                                  <select class="form-control" id="Months">
                                    <option></option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                  </select>
                                </div>
                                  <div class="form-group">
                                    <label for="usr">Worst Case Likelihood</label>
                                    <select class="form-control" id="Worst_Case_Likelihood">
                                    <option></option>
                                    <option value="">Extreme</option>
                                    <option value="">High</option>
                                    <option value="">Medium</option>
                                    <option value="">Low</option>
                                  </select>
                                    
                                  </div>

                                  <div class="form-group">
                                    <label for="usr">Worst Case Description</label>
                                    <input type="text" class="form-control" id="Worst_Case_Description" >
                                   
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Worst Case Financial Exposure</label>
                                    
                                    <select class="form-control" id="Worst_Case_Financial_Exposure">
                                    <option></option>
                                    <option value="3">Extreme</option>
                                    <option value="2">High</option>
                                    <option value="1">Medium</option>
                                    <option value="0">Low</option>
                                  </select>
                                  </div>
                                  <div class="form-group">
                                   <?php include '../common/riskCatgories.php';?>
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Other Risk</label>
                                    <input type="text" class="form-control" id="other_risk"> 
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Typical Case Description</label>
                                    <input type="text" class="form-control" id="Typical_Case_Description" >
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Frequency of Occurence Without Control</label>
                                    <input type="text" class="form-control" id="Frequency_of_Occurence_Without_Control_two" >
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Frequency of Occurence With Control</label>
                                    <input type="text" class="form-control" id="Frequency_of_Occurence_With_Control" >
                                  </div>                        
                                  <div class="form-group">
                                    <label for="usr">Typical Case Likelihood</label>
                                    <input type="text" class="form-control" id="Typical_Case_Likelihood" >
                                  </div>
                                  <div class="form-group">
                                    <label for="usr">Typical Case Financial Exposure</label>
                                    <input type="text" class="form-control" id="Typical_Case_Financial_Exposure"> 
                                  </div>
                             <div class="form-group">
                             <?php include '../common/riskScoringDropDown.php'; ?>
                             </div>
                     </form>
                </div>    
                <div class="modal-footer">
                     <button type="button" class="btn" data-dismiss="modal" style="background: #32c5d2; color: #fff">Submit</button>
                  </div>
              </div>
              </div>

          
            
              </div>


</div>

</div>  </div>
<!-- end:: Content -->  </div>  

</div>
</div>
</div>
<?php 
include "sidemenu.php";

 ?>
    <script>
            var KTAppOptions = {"colors":{"state":{"brand":"#2c77f4","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
        </script>
        <!-- end::Global Config -->

    <!--begin:: Global Mandatory Vendors -->
<script src="assets/vendors/general/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="assets/vendors/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
<script src="assets/vendors/general/moment/min/moment.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="assets/vendors/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/wnumb/wNumb.js" type="text/javascript"></script>
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="assets/vendors/custom/jquery-ui/jquery-ui.bundle.min.js" type="text/javascript"></script>
<link href="assets/vendors/custom/jquery-ui/jquery-ui.bundle.min.css">
<script src="assets/vendors/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
<script src="assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
<script src="assets/vendors/custom/js/vendors/bootstrap-switch.init.js" type="text/javascript"></script>
<script src="assets/vendors/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
<script src="assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
<script src="assets/vendors/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
<script src="assets/vendors/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
<script src="assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
<script src="assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
<script src="assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
<script src="assets/vendors/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
<script src="assets/vendors/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
<script src="assets/vendors/general/autosize/dist/autosize.js" type="text/javascript"></script>
<script src="assets/vendors/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/dropzone/dist/dropzone.js" type="text/javascript"></script>
<script src="assets/vendors/custom/js/vendors/dropzone.init.js" type="text/javascript"></script>
<script src="assets/vendors/general/quill/dist/quill.js" type="text/javascript"></script>
<script src="assets/vendors/general/@yaireo/tagify/dist/tagify.polyfills.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/@yaireo/tagify/dist/tagify.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/summernote/dist/summernote.js" type="text/javascript"></script>
<script src="assets/vendors/general/markdown/lib/markdown.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
<script src="assets/vendors/custom/js/vendors/bootstrap-markdown.init.js" type="text/javascript"></script>
<script src="assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
<script src="assets/vendors/custom/js/vendors/bootstrap-notify.init.js" type="text/javascript"></script>
<script src="assets/vendors/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
<script src="assets/vendors/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
<script src="assets/vendors/custom/js/vendors/jquery-validation.init.js" type="text/javascript"></script>
<script src="assets/vendors/general/toastr/build/toastr.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/dual-listbox/dist/dual-listbox.js" type="text/javascript"></script>
<script src="assets/vendors/general/raphael/raphael.js" type="text/javascript"></script>
<script src="assets/vendors/general/morris.js/morris.js" type="text/javascript"></script>
<script src="assets/vendors/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
<script src="assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
<script src="assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
<script src="assets/vendors/general/counterup/jquery.counterup.js" type="text/javascript"></script>
<script src="assets/vendors/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
<script src="assets/vendors/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
<script src="assets/vendors/custom/js/vendors/sweetalert2.init.js" type="text/javascript"></script>
<script src="assets/vendors/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
<script src="assets/vendors/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
<script src="assets/vendors/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
<script src="assets/vendors/general/dompurify/dist/purify.js" type="text/javascript"></script>
<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
          
      <script src="assets/js/demo3/scripts.bundle.js" type="text/javascript"></script>
      <script src="assets/toggleButton/bootstrap-toggle.min.js"></script>
      <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>  
      <script src="js/audit/auditPlanManagement.js"></script>



      <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
            </body>
    <!-- end::Body -->
</html>

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
<script type="text/javascript">
     $(function() {
        $(".datepickerClass").datepicker();
        $('.ui-datepicker').addClass('notranslate');
    });
  </script>