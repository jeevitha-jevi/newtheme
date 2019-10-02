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
error_log("complianceId".print_r($complianceId,true));
$accordionId = $complianceId;  
$GLOBALS['capa']="false";
function tabledata($clause){ 
     error_log("clause: ".print_r($clause,true));
     ?>     


    
    
       <?php  
        if($clause['subClauses']!=null){
            
            ?>
             <tr>
                <td><?php echo $clause['orderNumber'] ?></td>
                <td><?php if($clause['clauseDesc']!=null) {echo $clause['clauseDesc'];}
                          if($clause['clauseName']!=null) {echo $clause['clauseName'];}

                ?></td>
                <td></td>
                <td></td>
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
             if($clause['auditClauseForThisClauseId']['priority']!="" && $clause['auditClauseForThisClauseId']['severity']!="" && strpos($_SESSION['user_id'],''.$clause['auditClauseForThisClauseId']['auditee'])!==false)
            {

            $cklIdsForClause=array();
            array_push($GLOBALS['allClausesArray'],$clause['clauseId']);
         
            ?>
                <tr>
                <td><?php echo $clause['orderNumber'] ?></td>
                <td><?php if($clause['clauseDesc']!=null) {echo $clause['clauseDesc'];}
                          if($clause['clauseName']!=null) {echo $clause['clauseName'];}

                ?>
                    <input type="hidden" id="loggedInUser" value="<?php echo $GLOBALS['loggedInUserId'] ?>">
                    <input type="hidden" id="auditStatus" value="prepared">
                    <input type="hidden" id="auditId" value="<?php echo $GLOBALS['auditId'] ?>">
                    <input type="hidden" id="action" value="saveClause">
                    <input type="hidden" id="auditor_comments<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="auditorStatus<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="isCklsUpdateReqd<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="auditCklIdsForClause<?php echo $clause['clauseId'] ?>" value="">
                    <input type="hidden" id="score<?php echo $clause['clauseId'] ?>" value="0">

                     
                </td>
                <td></td>
                <td>
                   <?php echo $clause['auditClauseForThisClauseId']['priority']?>
                    </td>
                <td> 
                    <?php echo $clause['auditClauseForThisClauseId']['severity']?>
                    </td>
                    <td>  <?php echo $clause['auditClauseForThisClauseId']['target_date']?>  </td>
                    <td></td>
                   
                    
                   
            </tr>
            <?php foreach($clause['checklists'] as $checklist){
                    $cklIdsForClause[]=$checklist['checklistId'];

                ?>
                <input type="hidden" id="score<?php echo $clause['clauseId'] ?>" value="0">


                   <tr>
                <td><input type="hidden" id="userFileName<?php echo $checklist['checklistId'] ?>" value="<?php echo $checklist['auditChecklistForThisCklId']['file_name'] ?>" ></td>
                <td></td>
                <td><?php echo $checklist['checklistDesc']?> </td>
                 <td></td>
                <td></td>
                <td></td>
                <td style="width:180px">
                    <input type="hidden" value="<?php echo $checklist['formFieldType'] ?>" id="formFieldType<?php echo $checklist['checklistId'] ?>">
                    <?php

                    switch($checklist['formFieldType']){  
                        case 1:
                        ?>

                       <input data-onstyle="success" data-offstyle="primary" id="<?php echo 'auditee_response'.$checklist['checklistId']?>" type="checkbox" data-toggle="toggle" <?php if($GLOBALS['workingStatus']!="perform pending") echo 'disabled="disabled"'?> data-on="Yes" data-off="No" <?php if($checklist['auditChecklistForThisCklId']['auditee_response']=='yes'){echo 'checked';} ?>>


                <?php
                break;
                        case 2:

                     foreach($checklist['cklOptions'] as $cklOpt){ ?>
                       <div id="<?php echo 'cklOptsModal'.$checklist['checklistId'] ?>">
                        <input type="hidden" class="form-control" id="<?php echo 'auditee_response'.$checklist['checklistId']?>" value="">
                          
                               <ul id="<?php echo 'cklOpts'.$checklist['checklistId'] ?>">
                                <li>
                                    <div class="panel-default">
                                <input type="<?php echo MetaData::getMlChoiceControl($checklist['formFieldType']) ?>" name="cklOptionResp[]" value="<?php echo $cklOpt['cklOptId'] ?>" <?php if($isViewOnly) echo 'disabled="disabled"'?>
                                <?php if(strpos($checklist['auditChecklistForThisCklId']['auditee_response'], ''.$cklOpt['cklOptId']) !== false) echo 'checked' ?>>
                                <?php echo $cklOpt['cklOptData'] ?>
                                <input type="hidden" class="form-control" id="<?php echo 'cklOptId-'.$cklOpt['cklOptId']?>" value="<?php echo $cklOpt['cklOptId'] ?>">
                                <input type="hidden" class="form-control" id="<?php echo 'cklOptData'.$cklOpt['cklOptId'] ?>" value="<?php echo $cklOpt['cklOptData'] ?>">
                            </div>
                        </li>
                        </ul>
                        

                      </div>
            <?php

           
        }
                     break;
                        case 3:
                           foreach($checklist['cklOptions'] as $cklOpt){ ?>
                       <div id="<?php echo 'cklOptsModal'.$checklist['checklistId'] ?>">
                          <li>
                               <ul id="<?php echo 'cklOpts'.$checklist['checklistId'] ?>">
                                <input type="<?php echo MetaData::getMlChoiceControl($checklist['formFieldType']) ?>" name="cklOptionResp[]" value="<?php echo $cklOpt['cklOptId'] ?>" <?php if($isViewOnly) echo 'disabled="disabled"'?>
                                <?php if(strpos($auditee_response, ''.$cklOpt['cklOptId']) !== false) echo 'checked' ?>>
                                <?php echo $cklOpt['cklOptData'] ?>
                                <input type="hidden" class="form-control" id="<?php echo 'cklOptId-'.$cklOpt['cklOptId']?>" value="<?php echo $cklOpt['cklOptId'] ?>">
                                <input type="hidden" class="form-control" id="<?php echo 'cklOptData'.$cklOpt['cklOptId'] ?>" value="<?php echo $cklOpt['cklOptData'] ?>">
                        </ul>
                        </li>
                      </div>
            <?php

           
        }
                     break;
                          case 4: 
                    ?>
                            <textarea class="form-control" placeholder="Auditee Response" style="border:1px solid rgba(197, 214, 222, .7); border-radius:4px; height:54px; text-transform: capitalize;" maxlength="5000" rows="1" id="<?php echo 'auditee_response'.$checklist['checklistId']?>" <?php if($GLOBALS['workingStatus']!="perform pending") echo 'disabled="disabled"'?> ><?php echo htmlspecialchars($checklist['auditChecklistForThisCklId']['auditee_response']); ?></textarea>
      <?php   
                  break;
            }
                ?>
                    
               <?php $observation=$checklist['auditChecklistForThisCklId']['auditee_comment'] ?>
                <!-- <textarea placeholder="Auditee Comments" style="border:1px solid rgba(197, 214, 222, .7); border-radius:4px; height:34px" maxlength="5000" rows="1" id="<?php echo 'auditee_comments'.$checklist['checklistId']?>" <?php if($GLOBALS['workingStatus']!="perform pending") echo 'disabled="disabled"'?> ><?php echo htmlspecialchars($observation); ?></textarea> -->
                <a><i id="myBtn<?php echo $checklist['checklistId'] ?>" class="fa fa-comment"onclick="scoreChlkComment(<?php echo $checklist['checklistId'] ?>)" style="<?php if($observation==""){ echo "color:#337ab7;"; } else {echo "color:green;";}?> font-size: 25px; margin-top: 20px;" data-toggle="tooltip" title="comment"></i></a>

                    <div id="chlkComment<?php echo $checklist['checklistId'] ?>" class="modal">

                    <div class="modal-content">
                    <span class="close" style="width: 25px;margin-top: -12px;margin-right: -12px;height: 23px;" onclick="hidechlkComment(<?php echo $checklist['checklistId'] ?>)">&times;</span> <textarea rows="3" id="<?php echo 'auditee_comments'.$checklist['checklistId']?>" <?php if($GLOBALS['workingStatus']!="perform pending") echo 'disabled="disabled"'?> ><?php echo htmlspecialchars($observation); ?></textarea>
                    </div>
                    </div>
                <input type="text" class="fileLoader" id="<?php echo 'userFile'.$checklist['checklistId'] ?>" onchange="fileUpload(<?php echo $checklist['checklistId'] ?>)">
                <?php if($checklist['auditChecklistForThisCklId']['file_name']==""){ ?>
                <a><i class="fa fa-paperclip" type="file" onclick="openfileDialog(<?php echo $checklist['checklistId'] ?>);" name="files" title="Load File" aria-hidden="true" style="color: <?php if($checklist['auditChecklistForThisCklId']['file_name']=="") {echo"#337ab7;";} else{ echo"green;";} ?> font-size: 25px; margin-top: 20px;"></i></a>
                <?php } ?>
                <?php if($checklist['auditChecklistForThisCklId']['file_name']!=""){ ?>
                <a href="uploadedFiles/auditeeFiles/<?php echo $checklist['auditChecklistForThisCklId']['file_name'] ?> " download><i class="fa fa-paperclip" type="text"  name="files" title="Load File" aria-hidden="true" style="color: <?php if($checklist['auditChecklistForThisCklId']['file_name']=="") {echo"#337ab7;";} else{ echo"green;";} ?> font-size: 25px; margin-top: 20px;"></i></a>
                <?php } ?>
                <input type="hidden" class="form-control" id="<?php echo 'clauseId'.$checklist['checklistId'] ?>" value="<?php echo $checklist['clauseId'] ?>">
                <input type="hidden" class="form-control" id="<?php echo 'checklistScore'.$checklist['checklistId'] ?>" value="<?php echo $checklist['checklistScore'] ?>">
                <input type="hidden" class="form-control" id="<?php echo 'auditorScoreCkl'.$checklist['checklistId'] ?>" value="0">
            
            </td>
               
            </tr>
           

<?php  
            }
            }
?>
           <input type="hidden" class="form-control" id="<?php echo 'cklIdsForClause'.$clause['clauseId'] ?>" value="<?php echo join(',', $cklIdsForClause) ?>">
          
  <?php             
        
  }
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

 
  
                    
   <link href="./assets/css/demo3/style.bundle.css" rel="stylesheet" type="text/css" />
           
        <link rel="shortcut icon" href="./assets/media/logos/favicon.ico" />
    </head>
<body>
     <body>

   <body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >

       
    <!-- begin:: Page -->


<div class="kt-grid kt-grid--hor kt-grid--root">
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
<?php echo $auditTitle?>
</h3>
</div>

</div>

<div class="kt-portlet__body"> </div>
                            
            <?php if($_SESSION['user_role'] == 'auditor') {?>
               <!--  <div class="col-xs-2" id="create1">
                    <button class="btn btn-warning btn-block" style="background-color: #aa66ce" 
                    onclick="window.location.href='/freshgrc/view/audit/auditPlanCreate.php'"><i class="fa fa-user"></i> Create Audit</button>
                </div>
                <div class="col-xs-2" id="publishAudit">
                    <button class="btn btn-warning btn-block " style="background-color: #aa66ce" 
                    onclick="publishAuditList()"><i class="fa fa-user"></i>Published Audits</button>
                </div> -->
            <?php }?>
            
               
              <?php if($_SESSION['user_role'] == 'auditee') {?>
                <div class="row">
          <div class="col-md-12">
                <div class="col-md-10" style="margin-left: 78%;"><?php if($GLOBALS['workingStatus']!="perform pending") echo "style='display:none'" ?><button class="btn btn-danger" onclick="saveAllChecklists(allClauses,true)">Draft </button> </div>
               
                <!-- <div class="co1-md-2"></div> -->

                <div class="col-md-2" style="margin-left: 85%;margin-top: -33px;"> <?php if($GLOBALS['workingStatus']!="perform pending") echo "style='display:none'" ?> <button  class="btn btn-success" data-spinner-color="#333"  onclick="saveAndChangeAuditCklStatus(allClauses,<?php echo $auditId ?>, '<?php echo $workingStatus ?>', false, <?php echo $GLOBALS['capa'] ?>)" >Respond</button> </div>
              
           </div>
        </div>
            <?php }?>     
                    
    <div class="table-responsive">
    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
        <thead>
          <tr>
            <th>Control Number</th>
            <th>Control Set</th>
            <th>Controls</th>
            <th>Priority</th>
            <th>Severity</th>
            <th>targetDate</th>
            <th>Auditee Response</th>
          </tr>
        </thead>
       <?php 
      foreach($allClauses as $clauses)
      {
        foreach ($clauses as $clause) {
         tabledata($clause);
        }
      }
          
      ?>
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
include '../siteHeader.php';
include 'sidemenu.php';
 ?>
 <script>
            var KTAppOptions = {"colors":{"state":{"brand":"#2c77f4","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
        </script>
        <!-- end::Global Config -->

    <!--begin:: Global Mandatory Vendors -->

     <script src="js/compliance/clauseManagement.js"></script>
    <script src="js/audit/auditClauseManagement.js"></script>
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
<!--end::Global Theme Bundle -->

                    
            </body>
    <!-- end::Body -->
</html>


<script>
        var allClauses=<?php echo json_encode($GLOBALS['allClausesArray'])?>;
        
function openfileDialog(checklistId) {
    $("#userFile"+checklistId).click();
}
    </script> 
<?php

?>