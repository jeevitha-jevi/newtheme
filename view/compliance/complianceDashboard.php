<?php require_once __DIR__.'/../header.php';
      require_once __DIR__.'/../../php/common/dashboard.php';
$id=$_GET['id'];
$complianceWiseStatusGraph=false;
$manager=new dashboard();
$cardLibraries=$manager->noOfLibraries();
$cardLibraries=$cardLibraries[0]['count'];
$cardLibrariesPublished=$manager->noOfPublished();
$cardLibrariesPublished=$cardLibrariesPublished[0]['count'];
$cardLibrariesInDraft=$manager->noOfDraft();
$cardLibrariesInDraft=$cardLibrariesInDraft[0]['count'];
$cardLibrariesAnalyzed=$manager->noOfAnalyzed();
$complianceStatuses=$manager->complianceStatuses($_SESSION['company'],$id);
$numbers=array();
$numbering=array();
foreach($complianceStatuses as $status){
  $numbers[]=$manager->getClauseNumber($status['parent_clause_id']);
}
for($i=0;$i<count($numbers);$i++){
  $numbering[$i]=$numbers[$i][0]['numbering'];
}
for($i=0;$i<count($complianceStatuses);$i++){
  $complianceStatuses[$i]['numbering']=$numbers[$i][0]['numbering'];
}
$numbering=array_unique($numbering);
$statusArray=array();
foreach($complianceStatuses as $status){
  $index=array_search($status['numbering'],$numbering);
  $statusArray[$index][$status['status']]=$status['audit_status'];
  $statusArray[$index][$status['numbering']]=$status['numbering'];
}
$cardLibrariesAnalyzed=$cardLibrariesAnalyzed[0]['count'];
$checklistScore=$complianceStatuses['checklist_score'][0]['checklist_score'];
$compliantCount=0;
$nonCompliantCount=0;
$partiallyCompliant=0;
foreach($statusArray as $status){
  if($status['accepted']==0 && $status['rejected']>0){
    $nonCompliantCount+=1;
  }
  else if($status['rejected']==0 && $status['accepted']>0){
    $compliantCount+=1;
  }
  else{
    $partiallyCompliant+=1;
  }
}
$totalCount=$partiallyCompliant+$nonCompliantCount+$compliantCount;
$complianceName=$manager->getComplianceName($id);
?>


<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">
      
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <script src="js/audit/auditManagement.js"></script> 
    <script src="js/audit/auditByCompliance.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script> -->
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
     <script src="//fast.appcues.com/31746.js">// NOTE: These values should be specific to the current user.
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

    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="metronic/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="metronic/theme/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">      

    <style>
    .jqstooltip { 
      position: absolute;
      left: 0px;
      top: 0px;
      visibility: hidden;
      background: rgb(0, 0, 0) transparent;
      background-color: rgba(0,0,0,0.6);
      filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;
    }
    .highcharts-credits{
      display:none;
    }
     .jqsfield { 
        color: white;
        font: 10px arial, san serif;
        text-align: left;
      }
      .desc {
        padding-top: 25px;
      }
      #chartdiv1 {
        background-color: white;
        height: 550px;      
      }
      #chartdiv2 {
        height: 550px;
        background-color: white;
      }
      #chartdiv3{
        background-color: white;
        height: 430px;      
      }
       #chart_4 {
        height: 430px;
        background-color: white;
      }
      #chartdiv1 a, #chartdiv2 a, #chartdiv3 a, #chart_4 a{
      position: absolute;
      text-decoration: none;
      color: rgb(0, 0, 0);
      font-family: Verdana;
      font-size: 11px;
      opacity: 0.7;
      display: none !important;
      left: 5px;
      top: 5px;    
    }
      </style>
  </head>
  <body style="font-family: sans-serif !important;">
    <body>
      <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditDashboard';
        include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
      ?>
      <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">       
        <div class="page-content-wrapper">          
          <div class="page-content">
          <div id="onclickk" ondblclick="myFunction()"> 
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat dashboard-stat-v2 blue" >
                  <div class="visual">
                    <i class="fa fa-folder"></i>
                  </div>
                  <div class="details">
                    <div class="desc">Total Number of Domains </div>
                    <div class="number">
                      <span data-counter="counterup" data-value="<?php echo $totalCount ?>"><?php echo $totalCount ?></span>
                    </div>                  
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat dashboard-stat-v2 red">
                  <div class="visual">
                    <i class="fa fa-paper-plane"></i>
                  </div>
                  <div class="details">
                    <div class="desc">Compliant Domains</div>
                    <div class="number">
                      <span data-counter="counterup" data-value="<?php echo $compliantCount ?>"><?php echo $compliantCount ?></span></div>                  
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat dashboard-stat-v2 green" >
                  <div class="visual">
                    <i class="fa fa-spinner"></i>
                  </div>
                  <div class="details">
                    <div class="desc"> Partially Compliant Domains</div>
                    <div class="number">                    
                      <span data-counter="counterup" data-value="<?php echo $partiallyCompliant ?>"><?php echo $partiallyCompliant ?></span>
                    </div>                  
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat dashboard-stat-v2 purple" >
                  <div class="visual">
                    <i class="fa fa-search"></i>
                  </div>
                  <div class="details">
                    <div class="desc"> Non Compliant Domains</div>
                    <div class="number"> 
                      <span data-counter="counterup" data-value="<?php echo $nonCompliantCount ?>"><?php echo $nonCompliantCount ?></span></div>                  
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>          
            <div class="row">
              <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-bar-chart font-dark hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Compliance</span>   
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv1" class="display-none" style="display: block;">                   
                    </div>
                  </div>
                </div>                  
              </div>
              <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-share font-red-sunglo hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Status</span>         
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv2" class="display-none" style="display: block;">                     
                    </div>                  
                  </div>
                </div>                
              </div>
            </div>       
            <div class="row">   
              <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-bar-chart font-dark hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Audit Status</span>            
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv3" class="display-none" style="display: block;">                   
                    </div>
                  </div>
                </div>                  
              </div>
              <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-share font-red-sunglo hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Compliance Wise Efficacy</span>               
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chart_4" class="display-none" style="display: block;">      

                    </div>
                    <input type="hidden" id="company" value="<?php echo $_SESSION['company'] ?>"> 
                    <input type="hidden" id="compliance" value="<?php echo $id ?>">                                  
                    <input type="hidden" id="complianceName" value="<?php echo $complianceName[0]['name'] ?>">
                  </div>
                </div>                
              </div>             
            </div>
          </div>
          </div> 
        </div>
       <script>
        complianceName=$('#complianceName').val();
 $(document).ready( function() {
  var modalDetails=
  {
    'company':$('#company').val(),
    'compliance':$('#compliance').val()
  };
  $.ajax({
  type: "POST",
  dataType: "json",
  url: "php/compliance/auditStatuses.php",
  data: modalDetails,
  success: auditfrequency
});  
 $.ajax({
  type: "POST",
  dataType: "json",
  url: "php/compliance/manageComplianceDashboard.php",
  data: modalDetails,
  success: statuspie
});  
  $.ajax({
  type: "POST",
  dataType: "json",
  url: "php/compliance/barChartStatusCompliance.php",
  data: modalDetails,
  success: compliancepie
}); 
 $.ajax({
  dataType: "json",
  url: "php/common/complianceEfficacyDashboard.php",
  data: "",
  success: auditstatus3
});  
});
  function auditfrequency(data){
  
    for(i=0;i<data.length;i++){
      if(data[i].status=="approved" || data[i].status=="published"){
        data[i].status="Completed";
        data[i].color="#0ed12f";
      }
      else if(data[i].status=="create"){
        data[i].status="Due";
        data[i].color="#f3b358";
      }
      else{
        data[i].status="Pending"; 
        data[i].color="#ef371f";
      }
          }
    var chartData=[];
    var seriesData=[];
    var seriesDataChart=[];
    for(i=0;i<data.length;i++){
      chartData.push({"name":data[i].status,"y":data[i].count,"drilldown":data[i].status,"color":data[i].color});
    }
    for(i=0;i<data.length;i++){
      for(j=0;j<data[i].audits.length;j++){
        if(data[i].status=="Completed"){
        seriesData.push([data[i].audits[j].title+" has been completed",1]);
        }
        else if(data[i].status=="Due"){
          seriesData.push([data[i].audits[j].title+" with start date "+data[i].audits[j].start_date,1]);
        }
        else if(data[i].status=="Pending"){
         seriesData.push([data[i].audits[j].title+" with end date "+data[i].audits[j].end_date,1]); 
        }
      }
      seriesDataChart.push({"name":data[i].status,"id":data[i].status,"data":seriesData,"color":data[i].color});
      seriesData=[];
    }
    
  //colors:['#0ed12f','#f3b358','#ef371f'],  
 
    Highcharts.chart('chartdiv3', {
    chart: {
        type: 'pie'
    }, 
    title: {
        text: 'Audit Statuses of all audits with '+complianceName
    },
    subtitle: {
        text: 'Click the slices to view all audits under a particular category'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.1f}%'
            }
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },
    "series": [
        {
            "name": "Audit Status",
            "colorByPoint": true,
            "data":chartData
        }
    ],
    "drilldown": {
        "series": seriesDataChart
    }
});
  }
  function compliancepie(data){
    var clauseNumber=[];
    var accepted=[];
    var rejected=[];
    var total=[];
    var acceptedChecklists=[];
    var rejectedChecklists=[];
    for(i=0;i<data.length;i++){
      clauseNumber[i]=data[i].numbering;
      if(data[i].status=="accepted"){
        accepted.push(data[i].audit_status);
        acceptedChecklists.push(data[i].checklists);
 }
      else if(data[i].status=="rejected"){
        rejected.push(data[i].audit_status);
        rejectedChecklists.push(data[i].checklists);
      }
    }
  var uniqueClauses = [];
    $.each(clauseNumber, function(i, el){
        if($.inArray(el, uniqueClauses) === -1) uniqueClauses.push(el);
    });
  for(i=0;i<uniqueClauses.length;i++){
    total.push({"accepted":accepted[i],"rejected":rejected[i],"number":uniqueClauses[i],"acceptedChecklists":acceptedChecklists[i],"rejectedChecklists":rejectedChecklists[i]});
}
console.log(total);
  for(i=0;i<total.length;i++){
    if(total[i].accepted==undefined){
      total[i].accepted=0;
    }
    if(total[i].acceptedChecklists==undefined){
      total[i].acceptedChecklists=[];
    }
    if(total[i].rejectedChecklists==undefined){
      total[i].rejectedChecklists=[];
    }
    if(total[i].rejected==undefined){
      total[i].rejected=0;
    }
  }
  
  acceptedForGraph=[];
  rejectedForGraph=[];
  acceptedChecklistsData=[];
  rejectedChecklistsData=[];
  var dat=[];
  var datRej=[];
  var barSeriesData=[];
  

  for(i=0;i<total.length;i++){
    acceptedForGraph.push({name:total[i].number,y:total[i].accepted,drilldown:total[i].number+"accepted"});
    rejectedForGraph.push({name:total[i].number,y:total[i].rejected,drilldown:total[i].number+"rejected"});
    for(j=0;j<total[i].acceptedChecklists.length;j++)
    {
    dat[j]=[total[i].acceptedChecklists[j].description,1];
    }
    for(k=0;k<total[i].rejectedChecklists.length;k++)
    {
    datRej[k]=[total[i].rejectedChecklists[k].description,1];
    }
    acceptedChecklistsData.push({"id":total[i].number+"accepted","data":dat});
    rejectedChecklistsData.push({"id":total[i].number+"rejected","data":datRej});
    dat=[];
    datRej=[];
  }
  for(i=0;i<acceptedChecklistsData.length;i++){
    barSeriesData.push(acceptedChecklistsData[i]);
  }
  for(i=0;i<rejectedChecklistsData.length;i++){
    barSeriesData.push(rejectedChecklistsData[i]);
//console.log(barSeriesData);
  }
    // Create the chart
    $(function () {
    // Create the chart
    
    Highcharts.Tick.prototype.drillable = function () {};
    $('#chartdiv1').highcharts({
        colors:['#0ed12f','#ef371f'],
        chart: {
            type: 'column'
        },
        title: {
            text: 'Domain Level Compliance Status of '+complianceName
        },
        subtitle: {
            text: 'Click columns to drill down to domain level status'
        },
        xAxis: {
            type: 'category'
        },
        plotOptions: {
            series: {
                stacking: 'normal',
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Compliant',
            data: acceptedForGraph
        }, {
            name: 'Non Compliant',
            data:rejectedForGraph
        }],
        drilldown: {
            series: barSeriesData
        }
      })
    });
  
  
}
function statuspie(data){

  // console.log(data);
  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].priority,"y":parseInt(data[i].count)});
      } 
 Highcharts.chart('chartdiv2', {

    colors: ['#FF4E3F', '#008000', '#FFFF00'
  ],   
 chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'   
    },

title: {
        text: ''
    },
  
 tooltip: {
        pointFormat: '{name}<b>{point.percentage:.1f}%</b>'
    },
plotOptions: {
        pie: {

            allowPointSelect: false,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    "series": [{
        name:'name',
        colorByPoint: true,
        data:chartData,
    }]
});
}
//   function statuspie(data){
 
//   dataHigh=data.high;
//                dataLow=data.low;
//                dataMed=data.medium;
//                datHigh=[];
//                datLow=[];
//                datMed=[];
            
//                datHighAuditClause=[];
            

//              tempArray=[];
//                seriesData=[];
   
//                for(var i =0;i<dataHigh.length;i++){
//                   datHigh.push({"name":dataHigh[i].title,"y":dataHigh[i].count,"drilldown":dataHigh[i].title+"high"});
//                   for(var j=0;j<dataHigh[i].count;j++)
//                     {
                        
//                         tempArray[j]=[dataHigh[i].auditClause[j].name,1];
                        
//                     }
//                     datHighAuditClause.push(tempArray);
//                     seriesData.push({"name":dataHigh[i].title,"id":dataHigh[i].title+"high","data":tempArray});
//                     tempArray=[];
//                }
//                for(var i =0;i<dataMed.length;i++){
//                   datMed.push({"name":dataMed[i].title,"y":dataMed[i].count,"drilldown":dataMed[i].title+"med"});
//                    for(var j=0;j<dataMed[i].count;j++)
//                     {
                      
//                         tempArray[j]=[dataMed[i].auditClause[j].name,1];
                        
//                     }
//                   seriesData.push({"name":dataMed[i].title,"id":dataMed[i].title+"med","data":tempArray});
//                }
//                for(var i =0;i<dataLow.length;i++){
//                   datLow.push({"name":dataLow[i].title,"y":dataLow[i].count,"drilldown":dataLow[i].title+"low"});
//                   for(var j=0;j<dataLow[i].count;j++)
//                     {
                      
//                         tempArray[j]=[dataLow[i].auditClause[j].name,1];
                        
//                     }
//                   seriesData.push({"name":dataLow[i].title,"id":dataLow[i].title+"low","data":tempArray});
//                }
//                seriesDat=[{
//                 "name": "P1(Low Priority)",
//                 "id": "Low",
//                 "data": datLow
//             },
//             {
//                 "name": "P2(Medium Priority)",
//                 "id": "Medium",
//                 "data": datMed
//             },
//             {
//                 "name": "P3(High Priority)",
//                 "id": "High",
//                 "data": datHigh
//             }];
//    /*seriesData[0].data=datLow;
//    seriesData[1].data=datMed;
//    seriesData[2].data=datHigh;*/
  
// // Create the chart
// for(i=0;i<seriesData.length;i++){
//   seriesDat.push(seriesData[i]);
// }
// Highcharts.chart('chartdiv2', {
//     chart: {
//         type: 'pie'
//     },
//     title: {
//         text: 'Audits To be completed'
//     },
//     subtitle: {
//         text: 'Click the slices to view High Low Medium Priority Checklists which has not been completed yet'
//     },
//     plotOptions: {
//         series: {
//             dataLabels: {
//                 enabled: true,
//                 format: '{point.name}: {point.y:.0f}'
//             }
//         }
//     },
//     tooltip: {
//         headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
//         pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> Audits/Audit Clauses<br/>'
//     },
//     "series": [
//         {
//             "name": "Audits",
//             "colorByPoint": true,
//             "data": [
//                 {
//                     "name": "P1(Low Priority)",
//                     "y":dataLow.length,
//                     "drilldown": "Low",
//                     "color":"green"
//                 },
//                 {
//                     "name": "P2(Medium Priority)",
//                     "y":dataMed.length,
//                     "drilldown": "Medium",
//                     "color":"#f3b358"
//                 },
//                 {
//                     "name": "P3(High Priority)",
//                     "y": dataHigh.length,
//                     "drilldown": "High",
//                     "color":"#ea7074"
//                 }
//             ]
//         }
//     ],
//     "drilldown": {
//         "series":seriesDat,
//     }
// });
// }
function auditstatus3(data){
  
var chartData=[];
for(i=0;i<data.length;i++){
  chartData.push({"name":data[i].status,"y":parseInt(data[i].count)});
} 
Highcharts.chart('chart_4', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Compliance Efficacy of all Compliance Libraries'
  },
  tooltip: {
    pointFormat: '{series.name}: <b> {point.y:.0f}</b> %'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>:  {point.y:.0f}%',
        style: {
          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
        }
      }
    }
  },
  series: [{
    name: 'Audit Status',
    colorByPoint: true,
    data:chartData
  }]
});
}
</script>
      </body>
    </body>
    <div>
      
      <a class="btn btn-primary btn-sm" href="javascript:Appcues.show('-LE8ud6-_GIV_rzc581z')">Show hints &#x27a4;</a>


    </div>
  </body>
</html>