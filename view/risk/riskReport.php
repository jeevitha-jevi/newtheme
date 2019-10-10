<?php 
require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/risk/riskManager.php';
require_once __DIR__.'/../../php/risk/riskMitigationManager.php';
require_once __DIR__.'/../../php/risk/riskReviewManager.php';
$GLOBALS['RiskId'] = $_GET['RiskId'];
$RiskId = $_GET['RiskId'];
$manager = new RiskManager();
$riskPlanReport = $manager->getRiskPlanReport($RiskId);
$manager = new RiskMitigationManager();
$riskMitigationReport = $manager->getRiskMitigationReport($RiskId);
$manager = new RiskReviewManager();
$riskReviewReport = $manager->getRiskReviewReport($RiskId);

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
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <script src="js/risk/riskManagement.js"></script>


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <!-- metronic link for multiselect -->
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <!-- end -->
<!-- script link  multi select-->
     <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
         <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
         <!-- end -->
          <script type="text/javascript" src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.min.js"></script>
<script type="text/javascript" 
    src="https://raw.github.com/Stuk/jszip/master/jszip.js"></script>

    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
     <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.16/clipboard.min.js"></script>
</head>
<style type="text/css">
  .page-sidebar.navbar-collapse {
    max-height: none!important;
    position: fixed;
}
.page-sidebar{
         margin-top: -1%;
      }
      .page-container {
    margin: 0;
    padding: 20px 20px 0;
    position: relative;
}
</style>
<body  style="background-color: #f0f5f5">

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
    ?>
  <body>
  <!--  <button class="btn" id="cmd" style="margin-left: 92.5%;margin-top: 8%;color: #fff;margin-bottom: 1%;background-color: rebeccapurple;">PDF</button> -->
  <div style="margin-top: 90px;margin-right: 50px;">
  <div style="float: right; ">
  <button type="button" class="btn" data-toggle="tooltip" title="Print" type="button" onclick="printpage('element-to-print')"><span class="glyphicon glyphicon-print"></span></button>
  <button type="button" class="btn" data-clipboard-target="#element-to-print" data-toggle="tooltip" title="Copy" id="copy"><span style="color: #3BC5D2" class="glyphicon glyphicon-copy"></span></button>
  <button type="button" class="btn" data-toggle="tooltip" title="PDF" id="pdf" ><span style="color: #E7505A" class="far fa-file-pdf"></span></button>
</div>
</div>
</br>
    <div id="element-to-print">
      <div>
      <h3 style="text-align: center;">Mitigator Report:</h3>
    </div><br>
        <div class="container" style="margin-left:55px;">
          <div style="margin-left: 75%;">
        <img src="fixnix.png" class="img-responsive" alt="fixnix" style="width: 120px;">
      </div>
<div style="margin-left: -20px;margin-top: -80px;">    <div>
      <div>
        <label for="fname">Company Name:<b>FixNix-GRC Solutions</b></label>
      </div>
    </div>
    <div>
      <div>
        <label for="lname">Report Creator: <b>Risk Mitigator</b></label>
      </div>
    </div>
    <div>
      <div>
        <?php
          $dt = new DateTime();
        ?>
        <label for="date">Report Created Date:<b><?php echo $dt->format('Y-m-d') ?></b></label>
      </div>
    </div>
    <div>
      <div>
        <?php
          $dt = new DateTime();
        ?>
        <label for="time">Report Created Time:<b><?php echo $dt->format('H:i:s') ?></b></label>
      </div>
    </div>
    </div> 
  </div>
       <div class="panel" style="border: 1px solid #32c5d2;margin-left: 50px; width: 92%">
        <div class="panel-heading" style="background-color: #32c5d2; color:#fff;"><b>Report</b></div>
        <div class="panel-body" width="100%">
          <div class="table-responsive">
            <table class="table table-striped list-table table-bordered dt">
            <tr style="background-color: #f5f5f5;font-weight:100;font-size:12px;color:#333">
                <th style="font-size: 15px;" colspan="6">Plan</th>
            </tr>
            <tr>
              <td><label  class="col-sm-4">Plan Created Date:</label>
                <span><?php echo $riskPlanReport[0]['CreatedDate'];?></span>
              </td>
              <td><label class="col-sm-4">Subject:</label>
                <input type="hidden" name="RiskId" id="RiskId" value="<?php echo $RiskId;?>">
                <span><?php echo $riskPlanReport[0]['Subject'];?></span>
              </td>
                <td><label  class="col-sm-4">Risk Priority:</label>
                <span><?php 
                if ($riskPlanReport[0]['Risk_Status']==null){
                     $riskPlanReport[0]['Risk_Status']="None";
                    echo $riskPlanReport[0]['Risk_Status'];
                  }
                  elseif ($riskPlanReport[0]['Risk_Status']==1) {
                    $riskPlanReport[0]['Risk_Status']="Medium";
                    echo "<p class='btn'  style='width:114px; height:50% ; background-color:#7bea4e; color:#fff; text-align:center;'>".$riskPlanReport[0]['Risk_Status']."</p>";

                  }
                  elseif ($riskPlanReport[0]['Risk_Status']==2) {
                    $riskPlanReport[0]['Risk_Status']="High";
                    echo "<p class='btn'  style='width:114px; height:50% ; background-color:#ee5151; color:#fff; text-align:center;'>".$riskPlanReport[0]['Risk_Status']."</p>";
                  }
                  elseif ($riskPlanReport[0]['Risk_Status']==3) {
                    # code...
                    $riskPlanReport[0]['Risk_Status']="Extreme";
                    echo "<p class='btn'  style='width:114px; height:50% ; background-color:red; color:#fff; text-align:center;'>".$riskPlanReport[0]['Risk_Status']."</p>";
                  }
                  elseif($riskPlanReport[0]['Risk_Status']==0){
                    $riskPlanReport[0]['Risk_Status']="Low";
                    echo "<p class='btn'  style='width:114px; height:50% ; background-color:#5cb85c; color:#fff; text-align:center;'>".$riskPlanReport[0]['Risk_Status']."</p>";
                  }?></span>
              </td>
              
            </tr>
            <tr> 
              <td><label  class="col-sm-4">Category :</label>
                <span><?php echo $riskPlanReport[0]['Category'];?></span>
              </td>
            <td><label  class="col-sm-4">Location:</label>
                <span><?php echo $riskPlanReport[0]['Location'];?></span>
              </td>                        
              <td><label  class="col-sm-4">Control Number:</label>
                <span><?php echo $riskPlanReport[0]['ControlNumber'];?></span>
              </td>
              
              
            </tr>
            <tr>
            <td><label  class="col-sm-4">Affected Assets:</label>
                <span><?php echo $riskPlanReport[0]['AffectedAsset'];?></span>
              </td> 
            <td><label class="col-sm-4">Technology:</label>
                <span><?php echo $riskPlanReport[0]['Technology'];?></span>
              </td>                         
              <td><label  class="col-sm-4">Team:</label>
                <span><?php echo $riskPlanReport[0]['Team'];?></span>
              </td>
               
                                       
            </tr>
            <tr>
            <td><label class="col-sm-4">Risk Source:</label>
                <span><?php echo $riskPlanReport[0]['Source'];?></span>
              </td>    
            <td><label  class="col-sm-4">Risk Scoring Method:</label>
                <span><?php echo $riskPlanReport[0]['ScoringMethod'];?></span>
              </td>                      
              <td><label  class="col-sm-4">Owner:</label>
                <span><?php echo $riskPlanReport[0]['Owner'];?></span>
              </td>
              
              
            </tr> 
                  <tr>
                    <td><label  class="col-sm-4">Risk Assesment:</label>
                <span><?php echo $riskPlanReport[0]['RiskAssessment'];?></span>
              </td>
                  <td><label class="col-sm-4">Additional Notes:</label>
                <span><?php echo $riskPlanReport[0]['AdditionalNotes'];?></span>
              </td>                         
            </tr>    
            
          </table>
          <br>
          <table class="table table-striped list-table table-bordered dt">
            <tr style="background-color: #f5f5f5;font-weight:100;font-size:12px;color:#333">
                <th style="font-size: 15px;" colspan="6">Mitigate</th>
            </tr>
            <tr>
              <td><label class="col-sm-4">Planned Mitigation Date:</label>
                <span><?php echo $riskMitigationReport[0]['PlannedMitigationDate'];?></span>
              </td>
              <td><label  class="col-sm-4">Planning strategy:</label>
                <span><?php echo $riskMitigationReport[0]['PlanningStratergy'];?></span>
              </td>
              <td><label  class="col-sm-4">Mitigation Effort:</label>
                <span><?php echo $riskMitigationReport[0]['MitigationEffort'];?></span>
              </td>
            </tr>
            <tr>
              <td><label class="col-sm-4">Mitigation Team:</label>
                <span><?php echo $riskMitigationReport[0]['MitigationTeam'];?></span>
              </td>
              <td><label  class="col-sm-4">Mitigation Cost:</label>
                <span><?php echo $riskMitigationReport[0]['MitigationCost'];?></span>
              </td>
              <td><label  class="col-sm-4">Mitigation Owner:</label>
                <span><?php echo $riskMitigationReport[0]['MitigationOwner'];?></span>
              </td>
            </tr>
            <tr>
              <td><label class="col-sm-4">Mitigation Percent:</label>
                <span><?php echo $riskMitigationReport[0]['MitigationPercent'];?></span>
              </td>
              <td><label  class="col-sm-4">Security Recommendations:</label>
                <span><?php echo $riskMitigationReport[0]['SecurityRecomendation'];?></span>
              </td>
              <td><label class="col-sm-4">Current Solution:</label>
                <span><?php echo $riskMitigationReport[0]['CurrentSolution'];?></span>
              </td>                          
            </tr>
            <tr>                          
              <td><label  class="col-sm-4">Security Requirements:</label>
                <span><?php echo $riskMitigationReport[0]['SecurityRequirements'];?></span>
              </td>
              <td><label  class="col-sm-4"></label>
                <span></span>
              </td>
              <td></td>
            </tr>
          </table>
          <br>
          <table class="table table-striped list-table table-bordered dt">
            <tr style="background-color: #f5f5f5;font-weight:100;font-size:12px;color:#333">
                <th style="font-size: 15px;" colspan="6">Review</th>
            </tr>
            <tr>
              <td><label class="col-sm-4">Review Date:</label>
                <span id="ReviewDate"></span>
              </td>
              <td><label  class="col-sm-4">Reviewer:</label>
                <span><?php echo $riskReviewReport[0]['reviewer'];?></span>
              </td>
              <td><label  class="col-sm-4">Review:</label>
                <span><?php echo $riskReviewReport[0]['Review'];?></span>
              </td>
            </tr>
            <tr>
              <td><label class="col-sm-4">Next Step:</label>
                <span><?php echo $riskReviewReport[0]['NextStep'];?></span>
              </td>
              <td><label  class="col-sm-4">Comments:</label>
                <span><?php echo $riskReviewReport[0]['Comments'];?></span>
              </td>
              <td><label  class="col-sm-4">Next Review Date:</label>
                <span><?php echo $riskReviewReport[0]['NextReviewDate'];?></span>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
        <!-- <button class="btn btn-circle green" style="background-color: #337ab7;color: #fff;border: none;" onclick="create_zip()"><i class="fa fa-file-zip-o" aria-hidden="true" style="padding-right: 10px;"></i>Download Zip</button>  -->
    </body>
  </body>
</html>
<script type="text/javascript">
$(function() {
$(".datepickerClass").datepicker();
$('.ui-datepicker').addClass('notranslate');
});
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd = '0'+dd
} 

if(mm<10) {
    mm = '0'+mm
} 

today = mm + '/' + dd + '/' + yyyy;
document.getElementById("ReviewDate").innerHTML = today;
</script>

<script type="text/javascript">
$('#pdf').click(function() {
var element = document.getElementById('element-to-print');
html2pdf(element, {
  margin:       0,
  filename:     'RiskReport.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { dpi: 192, letterRendering: true },
  jsPDF:        { unit: 'in', format: 'a3', orientation: 'portrait' }
});
});
</script>
<script>
    function printpage(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }
  </script>

<script type="text/javascript">
  var clipboard = new Clipboard('.btn');
 clipboard.on('success', function(e) {
   console.log(e);
 });
 clipboard.on('error', function(e) {
   console.log(e);
 });

</script>
