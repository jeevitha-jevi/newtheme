<?php require_once __DIR__.'/../header.php';
$complianceWiseStatusGraph=false;
require_once '../../php/common/dashboard.php';
$manager=new dashboard();
 $totalRisks=$manager->getTotalNoOfRisks();
 $totalCreatedRisks=$manager->getNoOfCreatedRisk();
 $totalMitigatedRisks=$manager->getNoOfMitigatedRisk();
 $totalReviewedRisks=$manager->getNoOfReviewedRisk();

?>
<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Risk_owner and mitigation</title>
    <base href="/freshgrc/">
      
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
      <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/heatmap.js"></script>
<script src="https://code.highcharts.com/modules/treemap.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <!-- <script src="js/audit/auditManagement.js"></script>  -->
    <!-- <script src="js/audit/auditByCompliance.js"></script> -->
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

    <script src="https://cdn.anychart.com/releases/8.1.0/js/anychart-base.min.js"></script>
      <script src="https://cdn.anychart.com/releases/8.1.0/js/anychart-ui.min.js"></script>
      <script src="https://cdn.anychart.com/releases/8.1.0/js/anychart-exports.min.js"></script>
      <script src="https://cdn.anychart.com/releases/8.1.0/js/anychart-heatmap.min.js"></script>
      <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

    <script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
 <script src="//fast.appcues.com/50250.js">
    window.Appcues.identify("<?php echo $user->id; ?>", { // Replace with unique identifier for current user
  name: "aravind",   // Current user's name
  email: "aravind@fixnix.co", // Current user's email
  created_at: "<?php echo $user->created_at; ?>",    // Unix timestamp of user signup date
  
});

</script>
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
        height: 345px;      
      }
      #chartdiv2 {
        height: 344px;
        background-color: white;
      }
      #chartdiv3{
        background-color: white;
        height: 485px;      
      }
       #chartdiv4 {
        height: 485px;
        background-color: white;
      }
       #chartdiv5{
        background-color: white;
        height: 345px;      
      }
      #chartdiv6{
        height: 345px;
      }
      #chartdiv1 a, #chartdiv2 a, #chartdiv3 a, #chartdiv4 a, #chartdiv5 a{
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
  #notify{
      width: 50px;
      height: 50px;
      float: left;
      margin-right: 130px;"
    }
  
      </style>
     
  </head>
  <body style="font-family: sans-serif !important;">
    <body>
      <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditDashboard';
        include '../../php/policy/left.php';
        // include '../common/leftMenu.php';

        $userRole = $_SESSION['user_role'];
      ?>
      <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">       
        <div class="page-content-wrapper">          
          <div class="page-content">
                
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" onclick="getRiskList('all')">
                  <div class="visual">
                    <i class="fa fa-exclamation-circle"></i>
                  </div>
                  <div class="details">
                    <div class="desc">NO OF RISKS</div>
                    <div class="number">
                      <span data-counter="counterup" data-value="1"><?php echo $totalRisks[0]['total_records'];?></span>
                    </div>                  
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" onclick="getRiskList('create')">
                  <div class="visual">
                    <i class="fa fa-pencil-square-o"></i>
                  </div>
                  <div class="details">
                    <div class="desc">PENDING</div>
                    <div class="number">
                      <span data-counter="counterup" data-value="3"><?php echo $totalCreatedRisks[0]['count'];?></span></div>                  
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" onclick="getRiskList('mitigate')">
                  <div class="visual">
                    <i class="fa fa-shield"></i>
                  </div>
                  <div class="details">
                    <div class="desc">MITIGATED</div>
                    <div class="number">                    
                      <span data-counter="counterup" data-value="3"><?php echo $totalMitigatedRisks[0]['count'];?></span>
                    </div>                  
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" onclick="getRiskList('review')">
                  <div class="visual">
                    <i class="fa fa-check-circle"></i>
                  </div>
                  <div class="details">
                    <div class="desc">REVIEWED</div>
                    <div class="number"> 
                      <span data-counter="counterup" data-value="5"><?php echo $totalReviewedRisks[0]['count'];?></span></div>                  
                  </div>
                </a>
              </div>
            </div>
            <div>
                     <?php if ($_SESSION['user_role'] == 'risk_owner') {?>

             <a class="btn btn-primary btn-sm" href="javascript:Appcues.show('-LdDwurH7bBJ7bfgdBAe')">Show hints &#x27a4;</a>
                               <?php } ?>
                                <?php if ($_SESSION['user_role'] == 'risk_mitigator') {?>

             <a class="btn btn-primary btn-sm" href="javascript:Appcues.show('-LdE3sC3-bLnamR6cE6a')">Show hints &#x27a4;</a>
                               <?php } ?>
                                 <?php if ($_SESSION['user_role'] == 'risk_reviewer') {?>
             <a class="btn btn-primary btn-sm" href="javascript:Appcues.show('-LdE8E_X5_oUyNbQEfkf')">Show hints &#x27a4;</a>
                               <?php } ?> 
            <div class="clearfix" style="padding-bottom: 21px; float: right;">   
              <a href="view/common/riskFutureDashboard.php"><button type="button" class="btn btn-success">Future</button></a>        
            </div> 
          </div>
            <div class="clearfix"></div>          
            <div class="row">
              <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-bar-chart font-dark hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Risk status</span>   
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
                      <span class="caption-subject font-dark bold uppercase">Risk Score</span>         
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
                      <span class="caption-subject font-dark bold uppercase">Risk Location</span>            
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
                      <span class="caption-subject font-dark bold uppercase">Risk Team</span>               
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv4" class="display-none" style="display: block;">                      
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
                      <span class="caption-subject font-dark bold uppercase">Heat Maps</span>            
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv5" class="display-none" style="display: block;">                   
                    </div>
                  </div>
                </div>                  
              </div>                                     
            </div>
            <div class="row">   
              <div class="col-lg-6 col-xs-12 col-sm-12" style="float: right; margin-top: -465px;">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-bar-chart font-dark hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Measure of Risk</span>            
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv6" class="display-none" style="display: block;min-width: 310px; max-width: 600px; margin: 0 auto">
                    </div>
                  </div>
                </div>                  
              </div>                                     
            </div>
            <div>
            <div class="row">   
              <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-bar-chart font-dark hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Inherent Heat Maps</span> 
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv7" style="height: 400px; min-width: 310px; max-width: 600px; margin: 0 auto"></div>           
                    </div>
                  </div>
                </div> 
                     <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-share font-red-sunglo hide"></i>
                      <span class="caption-subject font-dark bold uppercase">KRI Map</span>               
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv8" style="height: 400px; min-width: 310px; max-width: 600px; margin: 0 auto"></div>           
                    </div>
                </div>                
              </div>             
              </div>
             
            <!--  <div class="row">
            <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered" style="width: 1289px; height: 601px;">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-share font-red-sunglo hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Gantt Chart for Risk</span>               
                    </div>                 
                  </div>
                 
                  <div class="portlet-body">                  
                    <div id="chartdiv8" class="display-none" style="display: block;height: 350px;">      
                    </div>                                                      
                  </div>
                </div>                
              </div>     
            </div> -->

            </div>
            
          </div>
            <button style="float: right;border-radius:40%;" onclick="topFunction()" id="myBtn" title="Go to top"  class="btn btn-info btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span>Top</button>
          </div>      
        </div>
        <div>

        <script type="text/javascript">
         
          $(document).ready( function() {

            $.ajax({
            dataType: "json",
            url: "php/common/manageRiskDashBoard.php",
            data: "",
            success: riskstatus
          });
        
           $.ajax({
            dataType: "json",
            url: "php/common/manageRiskScore.php",
            data: "",
            success: riskScore
          });
          $.ajax({
            dataType: "json",
            url: "php/common/manageRiskLocation.php",
            data: "",
            success: riskLocation
          }); 
          $.ajax({
            dataType: "json",
            url: "php/common/manageRiskTeam.php",
            data: "",
            success: riskTeam
          });
          $.ajax({
            dataType: "json",
            url: "php/common/manageRiskCalculatedStatus.php",
            data: "",
            success: riskCalculatedStatus
          });   

          $.ajax({
            dataType: "json",
            url: "php/common/manageMeasureofRisk.php",
            data: "",
            success: riskMeasure
          });  

               $.ajax({
            dataType: "json",
            url: "php/common/manageInherentRisk.php",
            data: "",
            success: InherentRisk
          }); 
           $.ajax({
            dataType: "json",
            url: "php/common/ganttchartrisk.php",
            data: "",
            success: ganttchartrisk
          });  
            $.ajax({
            dataType: "json",
            url: "php/common/managekririsk.php",
            data: "",
            success: manageKririsk
          });     
  
         });
    function riskstatus(data) {
   
    var departments=Object.keys(data);
            var chartData=new Array();
            var seriesData=new Array();            
            for(i=0;i<departments.length;i++){
              chartData[i]={name:departments[i],y:data[departments[i]].length,drilldown:departments[i]};
              seriesData[i]={name:departments[i],id:departments[i]};
              seriesData[i].data=new Array();
              for(j=0;j<data[departments[i]].length;j++){
                if(data[departments[i]][j].status=="create"){

                  data[departments[i]][j].status="Created";
                }
                seriesData[i].data[j]=[data[departments[i]][j][0]+" inherent risk score is "+data[departments[i]][j][1],data[departments[i]][j][1]];  
              }
            }
  // console.log(chartData);
           // console.log(points);
            Highcharts.chart('chartdiv1', {
              chart: {
                  type: 'column'
              },
              credits:
              {
                enabled: false
              },
              title: {
                  text: 'Inherent Risk of all Statuses'
              },
              subtitle: {
                  text: 'Click the slices to view Inherent Risk of all statuses'
              },
              plotOptions: {
                  series: {
                      dataLabels: {
                          enabled:false,
                          format: '{point.name}: {point.y:.0f}'
                      },
                      point: {
                    events: {
                        click: function () {
                              (this.name);
                        }
                    }
                   }
                  }
                  
              },

              tooltip: {
                    
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> risks<br/>'
              },

              "series":[
              {
                     "name": "Statuses",
                     "colorByPoint": true,
                     "data":chartData
              }
              ],
              "drilldown": {
                  "series":seriesData,


              }
          });

    }


    function riskScore(data){

   var departments=Object.keys(data);
            var chartData=new Array();
            var seriesData=new Array();            
            for(i=0;i<departments.length;i++){
              chartData[i]={name:departments[i],y:data[departments[i]].length,drilldown:departments[i]};
              seriesData[i]={name:departments[i],id:departments[i]};
              seriesData[i].data=new Array();
              for(j=0;j<data[departments[i]].length;j++){
                if(data[departments[i]][j].name=="Classic"){

                  data[departments[i]][j].name="Classic";
                }
                seriesData[i].data[j]=[data[departments[i]][j][0]+" inherent risk score is "+data[departments[i]][j][1],data[departments[i]][j][1]];  
              }
            }
  console.log(chartData);
 Highcharts.chart('chartdiv2', {

  //  colors: ['#ADD8E6', '#E6ACD7', '#B2B2B2', '#D0D050', 'green', 'skyblue',
  //   '#FF9655', '#FFF263', '#6AF9C4'
  // ],     
 chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'column'   
    },
credits:
{
  enabled: false
},

title: {
        text: ''
    },
  
 plotOptions: {
                  series: {
                      dataLabels: {
                          enabled:false,
                          format: '{point.name}: {point.y:.0f}'
                      },
                      point: {
                    events: {
                        click: function () {
                              (this.name);
                        }
                    }
                   }
                  }

              },

              tooltip: {
                    
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> risks<br/>'
              },

              "series":[
              {
                     "name": "Statuses",
                     "colorByPoint": true,
                     "data":chartData
              }
              ],
              "drilldown": {
                  "series":seriesData,


              }
          });

    }
  function riskLocation(data){
            var locations=Object.keys(data);
            var chartData=new Array();
            var seriesData=new Array();            
            for(i=0;i<locations.length;i++){
              chartData[i]={name:locations[i],y:data[locations[i]].length,drilldown:locations[i]};
              seriesData[i]={name:locations[i],id:locations[i]};
              seriesData[i].data=new Array();
              for(j=0;j<data[locations[i]].length;j++){
                if(data[locations[i]][j].status=="create"){
                  data[locations[i]][j].status="Created";
                }
                seriesData[i].data[j]=[data[locations[i]][j].subject+" is "+data[locations[i]][j].status,1];  
              }
              
              
                
                
            }
                      Highcharts.chart('chartdiv3', {
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              credits:
              {
                enabled: false
              },
              title: {
                  text: ''
              },
              subtitle: {
                  text: ''
              },
              plotOptions: {
                pie: {
            size: 210
             },
                  series: {
                      dataLabels: {
                          enabled: true,
                          format: '{point.name}: {point.y:.0f}'
                      }
                  }
           },
                 
              tooltip: {
                  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                  pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> Risks/Risk Clauses<br/>'
              },

              "series":[
              {
                     "name": "Location",
                     "colorByPoint": true,
                     "data":chartData
              }
              ],
              "drilldown": {
                  "series":seriesData,


              }
          });
            
          }

//     function riskLocation(data){      
//  var chart = AmCharts.makeChart( "chartdiv3", {
//   "type": "pie",
//   "theme": "light",
//   "titles": [ {
//     "text": "",
//     "size": 16
//   } ],
//   "legend":{
//                        "position":"bottom",
//                         "marginRight":0,
//                         "marginLeft":0,
//                         "autoMargins":true,
//                         "labelWidth":100
                        
//                                     },
//   "labelsEnabled":false,
//   "radius":160,
//   "dataProvider": data,
//   "valueField": "count",
//   "titleField": "name",
//   "startEffect": "elastic",
//   "startDuration": 2,
//   "labelRadius": 15,
//   "innerRadius": "30%",
//   "depth3D": 10,
//   "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
//   "angle": 10,
//   "export": {
//     "enabled": true
//   }
// } );
// }
function riskTeam(data){

  // console.log(data);
  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].name,"y":parseInt(data[i].count)});
      }

 Highcharts.chart('chartdiv4', {

  //  colors: ['#ADD8E6', '#E6ACD7', '#B2B2B2', '#D0D050', 'green', 'skyblue',
  //   '#FF9655', '#FFF263', '#6AF9C4'
  // ],     
 chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'   
    },
credits:
{
  enabled: false
},

title: {
        text: ''
    },
  
 tooltip: {
        pointFormat: '{name}<b>{count}</b>'
    },
plotOptions: {
        pie: {
            size: 200,
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
//     "series": [{
//         name:'name',
//         colorByPoint: true,
//         data:chartData,
//     }]
// });

   series: [
        {
            name: "Risk Team",
            colorByPoint: true,
            data: [
                {
                    name: "HR Team",
                    y: 25.3,
                    drilldown: "HR Team"
                },
                {
                    name: "Operational Team",
                    y: 18.8,
                    drilldown: "Operational Team"
                },
                {
                    name: "Finance Team",
                    y: 16.7,
                    drilldown: "Finance Team"
                },
                {
                    name: "IT Team",
                    y: 18.8,
                    drilldown: "IT Team"
                },
                {
                    name: "Marketing Team",
                    y: 10.2,
                    drilldown: "Marketing Team"
                },
                {
                    name: "Sales Team",
                    y: 9.1,
                    drilldown: "Sales Team"
                },
                {
                    name: "Physical Security Team",
                    y: 0.5,
                    drilldown: "Operational Team"
                }
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "HR Team",
                id: "HR Team",
                data: [
                  [
                        "IT Risk",
                        11
                    ],
                    [
                        "Enterprice Risk",
                        22
                    ],
                    [
                        "IT filter Risk",
                        33
                    ],
                    [
                        "RBM Risk",
                        34
                    ],
                    [
                        "Liquidity Risk",
                        45
                    ],
                ] 
                    
               },
               {
                name: "Operational Team",
                id: "Operational Team",
                data: [
                  [
                        "Credit Risk",
                        9
                    ],
                    [
                        "Enterprice Risk",
                        22
                    ],
                    [
                        "Dilution Risk",
                        38
                    ],
                    [
                        "Residual Risk",
                        44
                    ],
                    [
                        "Liquidity Risk",
                        45
                    ],
                     [
                        "Security Risk",
                        52
                    ],
                ] 
                    
               },
               {
                name: "Finance Team",
                id: "Finance Team",
                data: [
                  [
                        "Financial Risk",
                        1
                    ],
                    [
                        "New Risk",
                        28
                    ],
                    [
                        "Credit Risk",
                        30
                    ],
                    [
                        "RBM Risk",
                        45
                    ],
                    [
                        "planing Risk",
                        52
                    ],
                ] 
                    
               },
               {
                name: "IT Team",
                id: "IT Team",
                data: [
                  [
                        "Banking Risk",
                        17
                    ],
                    [
                        "IOB Risk",
                        62
                    ],
                    [
                        "inherent Risk",
                        42
                    ],
                    [
                        "Credit Risk",
                        8
                    ],
                    [
                        "planing Risk",
                        27
                    ],
                ] 
                    
               },
               {
                name: "Marketing Team",
                id: "Marketing Team",
                data: [
                  [
                        "Stock Risk",
                        16
                    ],
                    [
                        "Environmental Risk",
                        22
                    ],
                    [
                        "Banking Risk",
                        12
                    ],
                    [
                        "Natural Risk",
                        7
                    ],
                    [
                        "planing Risk",
                        23
                    ],
                ] 
                    
               },
               {
                name: "Sales Team",
                id: "Sales Team",
                data: [
                  [
                        "Environmental Risk",
                        11
                    ],
                    [
                        "Consumer Risk",
                        45
                    ],
                    [
                        "Internal Risk",
                        9
                    ],
                    [
                        "Resource Risk",
                        86
                    ],
                    [
                        "Data breach Risk",
                        4
                    ],
                ] 
                    
               },
               {
                name: "Physical Security Team",
                id: "Physical Security Team",
                data: [
                  [
                        "Resource Risk",
                        23
                    ],
                    [
                        "Communication Risk",
                        65
                    ],
                    [
                        "Data breach Risk",
                        22
                    ],
                    [
                        "Cybersecurity Risk",
                        9
                    ],
                    [
                        "Dilution Risk",
                        43
                    ],
                ] 
                    
               }
                ]
      
    }
});
}
//  function riskTeam(data){
 
//   var chart = AmCharts.makeChart( "chartdiv4", {
    
//  "type": "pie",
//   "theme": "light",
//   "titles": [ {
//     "text": "",
//     "size": 16
//   } ],
//   "legend":{
//                        "position":"bottom",
//                         "marginRight":0,
//                         "marginLeft":0,
//                         "autoMargins":true,
//                         "labelWidth":100
                        
//                                     },
//   "labelsEnabled":false,
//   "radius":160,
//   "dataProvider": data,
//   "depth3D":10,
//    "angle":10,
//   "valueField": "count",
//   "titleField": "name",
//    "balloon":{
//    "fixedPosition":true

//   },
 
// } );
// }

//     function riskScore(data){      
// var chart = AmCharts.makeChart("chartdiv2", {
//     "theme": "light",
//     "type": "serial",
//     "titles": [ {
//     "text": "",
//     "size": 16
//   } ],

//     "dataProvider":data,
//     "valueAxes": [{
//         "stackType": "3d",
//         "unit": "%",
//         "position": "left",
//         "title": "",
//     }],
//     "startDuration": 1,
//     "graphs": [{
//         "balloonText": " [[category]]: <b>[[value]]</b>",
//         "fillAlphas": 0.9,
//         "lineAlpha": 0.2,
//         "title": "2004",
//         "type": "column",
//         "valueField": "count"
    
//     }],
//     "plotAreaFillAlphas": 0.1,
//     "depth3D": 20,
//     "angle": 30,
//     "categoryField": "name",
//     "categoryAxis": {
//         "gridPosition": "start"
//     },
    
// });
// jQuery('.chart-input').off().on('input change',function() {
//   var property  = jQuery(this).data('property');
//   var target    = chart;
//   chart.startDuration = 0;

//   if ( property == 'topRadius') {
//     target = chart.graphs[0];
//         if ( this.value == 0 ) {
//           this.value = undefined;
//         }
//   }

//   target[property] = this.value;
//   chart.validateNow();
// });
// }
function riskCalculatedStatus(data){ 
 likelihood = ["","Rare","Unlikely","Creditble","Likely","Almostcertain"];
 impact = ["","Insignificant","Minor","Moderate","Major","Extreme/catastropic"];
 for(var i=0;i<data.length;i++){
  if (data[i].heat <= 3) {
    data[i].fill = '#84b761';
    data[i].heat = '0';
  }
  else if(data[i].heat <= 7){
     data[i].fill = '#ffb74d';
     data[i].heat = '1';
  }
  else if (data[i].heat <= 14) {
     data[i].fill = '#ef6c00';
     data[i].heat = '2';
  }
  else if (data[i].heat <= 25) {
     data[i].fill = '#d84315';
     data[i].heat = '3';
  }
  data[i].x = likelihood[data[i].x];
  data[i].y = impact[data[i].y];
  
 } 
 data

anychart.onDocumentReady(function () {
        // Creates Heat Map
        var chart = anychart.heatMap(data);

        // Sets chart settings and hover chart settings
        chart.stroke('#fff');
        chart.hovered()
                .stroke('6 #fff')
                .fill('#545f69')
                .labels({'fontColor': '#fff'});

        // Sets selection mode for single selection
        chart.interactivity().selectionMode('none');

        // Sets title
        chart.title()
                .enabled(true)
                .text('')
                .padding([0, 0, 20, 0]);

        // variable with list of labels
        var namesList = ['', '', '', ''];
        // Sets adjust chart labels
        chart.labels()
                .enabled(true)
                .minFontSize(14)
                // Formats labels
                .format(function () {
                    // replace values with words for points heat
                   if(this.x=="Creditble"&& this.y=="Insignificant" )
                    return "3";
                   if(this.x=="Creditble"&& this.y=="Moderate" )
                    return "9"
                   if(this.x=="Likely"&& this.y=="Major" )
                    return "16";
                   if(this.x=="Unlikely"&& this.y=="Moderate")
                    return "6";
                   if(this.x=="Rare"&& this.y=="Insignificant" )
                    return "1";
                   if(this.x=="Rare" && this.y=="Extreme/catastropic")
                    return "5";
                   if(this.x=="Almostcertain"&& this.y=="Extreme/catastropic" )
                    return "25";
                    
                });

        // Sets Axes
        chart.yAxis().stroke(null);
        // chart.yAxis().labels().padding([0, 15, 0, 0]);
        chart.yAxis().ticks(false);
        chart.xAxis().stroke(null);
        chart.xAxis().ticks(false);

        // Sets Tooltip
        chart.tooltip().title().useHtml(true);
        chart.tooltip().useHtml(true)
                .titleFormat(function () {
                    return '<b>' + namesList[this.heat] + '</b> Residual Risk';
                })
                .format(function () {
                    return '<span style="color: #CECECE">Likelihood: </span>' + this.x + '<br/>' +
                            '<span style="color: #CECECE">Impact: </span>' + this.y;
                });

        // set container id for the chart
        chart.container('chartdiv5');
        // initiate chart drawing
        chart.draw();
    });
}

function riskMeasure(data) {
   
    var measures=Object.keys(data);
            var chartData=new Array();
            var seriesData=new Array();            
            for(i=0;i<data.acceptable.length;i++){
              chartData[i]=[data.acceptable[i].subject,data.acceptable[i].calculated_risk]
              }
              for(j=0;j<data.notacceptable.length;j++){
                seriesData[j]=[data.notacceptable[j].subject,data.notacceptable[i].calculated_risk]
              }

//   console.log(data);

Highcharts.chart('chartdiv6', {
  
    chart: {
        type: 'pie'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    credits:
{
  enabled: false
},
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:12px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> Risk Score<br/>'
    },

    "series": [
        {
            "name": "Measure of Risk",
            "colorByPoint":true,
            "data": [
                {
                    "name": "Acceptable",
                    "y": data.acceptable.length,
                    "drilldown": "Acceptable"

                },  

                {
                    "name": "Non-Acceptable",
                    "y": data.notacceptable.length,
                    "drilldown": "Non-Acceptable"
                }
            ]
        }
    ],
    "drilldown": {
        "series": [
            {
                "name": "Acceptable",
                "id": "Acceptable",
                "data": chartData
            },
            {
                "name": "Non-Acceptable",
                "id": "Non-Acceptable",
                "data": seriesData  
            }
        ]
    }
});

}
function InherentRisk(data){

  // chartData=[];
  chartData=[];

      // el = document.getElementById("demo"),
      // html = '';
  
//   for (var i = 0; i < data.length; i++)
//   {
// html+=data[i].Risk + "<br>";
// }
//   document.getElementById("demo").innerHTML = html;

  for(i=0;i<data.length;i++)
  {
    if(data[i].heat<=9)
    {
    chartData.push({"x":data[i].x,"y":data[i].y,"z":Math.round(data[i].heat),"name":data[i].Risk,"color":"#FB3622"});
  
  }
if(data[i].heat>9&&data[i].heat<=99)
  {
  chartData.push({"x":data[i].x,"y":data[i].y,"z":Math.round(data[i].heat), "color":"#37D58D"});
  }
  if(data[i].heat==100)
  {
     chartData.push({"x":data[i].x,"y":data[i].y,"z":Math.round(data[i].heat), "color":"yellow"});
  }
 }
 // console.log(chartData);       
     
  Highcharts.chart('chartdiv7', {

      chart: {
          type: 'bubble',
          plotBorderWidth: 0,
          zoomType: 'xyz'
      },

      legend: {
          enabled: true
      },

      title: {
          text: ''
      },

      subtitle: {
          text: ''
      },
      credits:
{
  enabled: false
},

      xAxis: {
        startOnTick: true,
                endOnTick: true,
          gridLineWidth: 0,
          title: {
              text: 'Likelihood'
          },
          labels: {
              format: '',
          },
          plotLines: [{
              label: {
                  rotation: 0,
                  y: 0,
                  style: {
                      fontStyle: 'italic'
                  },
                  text: ''
              },
              zIndex: 0
          }]
      },

      yAxis: {
        startOnTick: true,
                endOnTick: true ,
          gridLineWidth: 0,

          title: {
              text: 'Impact'
          },
          labels: {
              format: ''
          },
          maxPadding: 0,
          plotLines: [{
              label: {
                  align: 'right',
                  style: {
                      fontStyle: 'italic'
                  },
                  text: '',
                  
              },
              zIndex: 0
          }]
      },

      tooltip: {
          useHTML: true,
          headerFormat: '<table>',
          pointFormat: '<tr><th>Likelihood:</th><td>{point.x}%</td></tr>'+'<tr><th>Impact:</th><td>{point.y}%</td></tr>'+'<tr><th>Inherent Risk Heat:</th><td>{point.z}%</td></tr>',
          footerFormat: '</table>',
          followPointer: true
      },

      plotOptions: {
          series: {
              dataLabels: {
                  enabled: true,
                   showInLegend: true,
                  format: '{point.z}'
              }
          }
      },

      series: [{
        colorByPoint:true,
          data:chartData 
     }]

  });
}
function ganttchartrisk(data){
   // console.log(data);
  var category=[];
  var process1=[];
  var task=[];
 for(i=0;i<data.length;i++)
     {
    category.push({"label":data[i].startmonth,"start":data[i].created_date,"end":data[i].updated_time});
     } 
 for(j=0;j<data.length;j++)
     {
    process1.push({"label":data[j].subject});
     } 
     // console.log(process1) for(k=0;k<data.length;k++)
     {
    task.push({"start":data[k].created_date,"end":data[k].updated_time});
     } 
FusionCharts.ready(function() {
  var socialMediaPlan = new FusionCharts({
    type: 'gantt',
    renderAt: '',
    width: '1250',
    height: '500',
    dataFormat: 'json',
    creditLabel:false,
    dataSource: {
      "chart": {
        // "palettecolors":"5d62b5,29c3be,f2726f",
        // "bgColor": "#FFFFFF",
        // "taskBarFillMix": "#0091AC",
        // "borderColor": "#666666",
        // "dateformat": "yyyy/mm/dd",
        // "caption": "",
        // "subcaption": "",
        // "theme": "fusion",
        // "canvasBorderAlpha": "40"
        "bgColor": "#FFFFFF",
        "taskBarFillMix": "#0091AC",
        "borderColor": "#666666",
        "dateformat": "mm/dd/yyyy",
        "theme": "fusion",
        "scrollShowButtons": "",
        "canvasBorderAlpha": "40",
        "ganttPaneDuration": "1",
        "ganttPaneDurationUnit": "m",
        "scrollColor": "#FFFFFF",
      },
      "categories": [{
         "category":category
       }],
      "processes": {
         "fontsize": "12",
         "isbold": "1",
        "align": "right",
         "process": process1
       },
       "tasks": {
         "task": task
       }

    }
  }).render();
});
} 

function manageKririsk(data){ 

  Highcharts.chart('chartdiv8', {

    chart: {
            type: 'heatmap',
            marginTop: 40,
            marginBottom: 40,


            events: {
                drilldown: function (e) {
                    console.log('I am here');
                    if (!e.seriesOptions) {

                        var chart = this;
                        var drilldownSeries = {
                            name: '',
                            borderWidth: 1,
                            data: [{
                                x: 0,
                                y: 0,
                                value: 'InherentRisk'
                            }, {
                                x: 0,
                                y: 1,
                                value: 'RBM Risk'
                            }, {
                                x: 0,
                                y: 2,
                                value: 'Enterprise Risk',
                            }, {
                                x: 0,
                                y: 3,
                                value: 'Credit Risk'
                            }, {
                                x: 0,
                                y: 4,
                                value: 'Security Risk'
                            }, {
                                x: 1,
                                y: 0,
                                value: 'RBM'
                            }, {
                                x: 1,
                                y: 1,
                                value: 'Cybersecurity Risk'
                            }, {
                                x: 1,
                                y: 2,
                                value: 'Strategic Risk'
                            }, {
                                x: 1,
                                y: 3,
                                value: 'Market Risk'
                            }, {
                                x: 1,
                                y: 4,
                                value: 'Interest Rate Risk'
                            }, {
                                x: 2,
                                y: 0,
                                value: 'Foreign Exchange Risk'
                            }, {
                                x: 2,
                                y: 1,
                                value: 'Operational Risk'
                            }, {
                                x: 2,
                                y: 2,
                                value: 'Legal Risk'
                            }, {
                                x: 2,
                                y: 3,
                                value: 'Counter Party'
                            }, {
                                x: 2,
                                y: 4,
                                value: 'Reputaional Risk'
                            }, {
                                x: 3,
                                y: 0,
                                value: 'Conflict'
                            }, {
                                x: 3,
                                y: 1,
                                value: 'Stock Risk'
                            }, {
                                x: 3,
                                y: 2,
                                value: 'Financial risk'
                            }, {
                                x: 3,
                                y: 3,
                                value: 'audit Risk'
                            }, {
                                x: 3,
                                y: 4,
                                value: 'Stock'
                            }],
                            dataLabels: {
                                enabled: true,
                                color: 'black',
                                style: {
                                    textShadow: 'none',
                                    HcTextStroke: null
                                }
                            }
                        };

                        // Show the loading label
                        chart.showLoading('');

                        setTimeout(function () {
                            chart.hideLoading();
                            chart.addSeriesAsDrilldown(e.point, drilldownSeries);
                        }, 1000);
                    }

                }
            }



        },

        plotOptions: {
            heatmap: {
                allowPointSelect: true
            }
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: ['Extreme', 'High', 'Medium', 'Low', 'Negligible']
        },

        yAxis: {
            categories: ['Remote', 'Unlikely', 'Possible', 'Likely', 'Propable'],
            title: null
        },

        colorAxis: {
            min: 0,
            minColor: '#FFFFFF',
            maxColor: Highcharts.getOptions().colors[0]
        },

        legend: {
            align: 'right',
            layout: 'vertical',
            margin: 0,
            verticalAlign: 'top',
            y: 25,
            symbolHeight: 320
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.series.xAxis.categories[this.point.x] + '</b> sold <br><b>' + this.point.value + '</b> items on <br><b>' + this.series.yAxis.categories[this.point.y] + '</b>';
            }
        },
   


        series: [{
            name: '',
            borderWidth: 1,
            drilldown: true,
            data: [{
                x: 0,
                y: 0,
                value: 5,
                color:'#64A0F2',
              
                drilldown: 'foo'
            }, {
                x: 0,
                y: 1,
                value: '',
                 color:'#64A0F2'
            }, {
                x: 0,
                y: 2,
                value: '',
                 color:'#6CC877'
                
            }, {
                x: 0,
                y: 3,
                value: '',
                 color:'#4CC25A'
                
            }, {
                x: 0,
                y: 4,
                value: 1,
                 color:'#4CC25A',
                drilldown: 'foo'
            }, {
                x: 1,
                y: 0,
                value: '' ,
                color:'#D9D153'
              
            }, {
                x: 1,
                y: 1,
                value: '',
                 color:'#64A0F2'
            }, {
                x: 1,
                y: 2,
                value: '',
                 color:'#64A0F2'
            }, {
                x: 1,
                y: 3,
                value: 8,
                 color:'#64A0F2',
                drilldown: 'foo'
            }, {
                x: 1,
                y: 4,
                value:'' ,
                color:'#6CC877'
            }, {
                x: 2,
                y: 0,
                value: '',
                color:'#F0635F'
            }, {
                x: 2,
                y: 1,
                value: '',
                color:'#D9D153'
            }, {
                x: 2,
                y: 2,
                value: 9,
                 color:'#D9D153',
                drilldown: 'foo'
            }, {
                x: 2,
                y: 3,
                value: '',
                 color:'#64A0F2'
            }, {
                x: 2,
                y: 4,
                value: '' ,
                color:'#6CC877'
            }, {
                x: 3,
                y: 0,
                value: '',
                color:'#F0635F'
            }, {
                x: 3,
                y: 1,
                value: '',
                 color:'#D9D153'
            }, {
                x: 3,
                y: 2,
                value: 2,
                 color:'#D9D153',
                drilldown: 'foo'
            }, {
                x: 3,
                y: 3,
                value: 19,
                 color:'#64A0F2',
                drilldown: 'foo'
            }, {
                x: 3,
                y: 4,
                value: '',
                 color:'#64A0F2'
            }, {
                x: 4,
                y: 0,
                value: 25,
                color:'#F0635F',
                drilldown: 'foo'
            }, {
                x: 4,
                y: 1,
                value: '',
                color:'#F0635F'
            }, {
                x: 4,
                y: 2,
                value: 8,
                color:'#F0635F',
                drilldown: 'foo'
            }, {
                x: 4,
                y: 3,
                value: '' ,
                 color:'#D9D153'
            }, {
                x: 4,
                y: 4,
                value: '',
                color:'#D9D153'
            }],
            dataLabels: {
                enabled: true,
                color: 'black',
                style: {
                    textShadow: 'none',
                    HcTextStroke: null
                }
            }
        }],

        drilldown: {
            series: []
        }

  
});
    
}


function getRiskList(status){
  if (status == 'all') {
    window.location="/freshgrc/view/risk/noofriskdashboard.php";
  }
  else if (status == 'create') {
    window.location="/freshgrc/view/risk/riskcreatedashboard.php";
  }
  else if(status == 'mitigate'){
    window.location="/freshgrc/view/risk/riskmitigatedlistdashboard.php";
  }
  else if (status == 'review') {
    window.location="/freshgrc/view/risk/riskreviewedlistdashboard.php";
  }

}


        </script>    
      </body>
    </body>
  </body>
</html>
