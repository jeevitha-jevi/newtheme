<?php require_once __DIR__.'/../header.php';
      require_once __DIR__.'/../../php/common/dashboard.php';
$complianceWiseStatusGraph=false;
$manager=new dashboard();
$cardLibraries=$manager->noOfLibraries();
$cardLibraries=$cardLibraries[0]['count'];
$cardLibrariesPublished=$manager->noOfPublished();
$cardLibrariesPublished=$cardLibrariesPublished[0]['count'];
$cardLibrariesInDraft=$manager->noOfDraft();
$cardLibrariesInDraft=$cardLibrariesInDraft[0]['count'];
$cardLibrariesAnalyzed=$manager->noOfAnalyzed();
$cardLibrariesAnalyzed=$cardLibrariesAnalyzed[0]['count'];
//error_log("no of Libraries".print_r($cardLibraries));
?>


<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Compliance</title>
    <base href="/freshgrc/">

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script> -->  
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
        // include '../common/leftMenu.php';
        include '../../php/policy/left.php';
        $userRole = $_SESSION['user_role'];
      ?>
      <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">       
        <div class="page-content-wrapper">          
          <div class="page-content">
          <!-- <div id="onclickk" onclick="myFunction()">  -->
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat dashboard-stat-v2 blue" >
                  <div class="visual">
                    <i class="fa fa-folder"></i>
                  </div>
                  <div class="details">
                    <div class="desc">No of Libraries</div>
                    <div class="number">
                      <span data-counter="counterup" data-value="<?php echo $cardLibraries ?>"><?php echo $cardLibraries ?></span>
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
                    <div class="desc">Published</div>
                    <div class="number">
                      <span data-counter="counterup" data-value="<?php echo $cardLibrariesPublished ?>"><?php echo $cardLibrariesPublished ?></span></div>                  
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat dashboard-stat-v2 green" >
                  <div class="visual">
                    <i class="fa fa-spinner"></i>
                  </div>
                  <div class="details">
                    <div class="desc"> In Progress</div>
                    <div class="number">                    
                      <span data-counter="counterup" data-value="<?php echo $cardLibrariesInDraft ?>"><?php echo $cardLibrariesInDraft ?></span>
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
                    <div class="desc"> Analyzed</div>
                    <div class="number"> 
                      <span data-counter="counterup" data-value="<?php echo $cardLibrariesAnalyzed ?>"><?php echo $cardLibrariesAnalyzed ?></span></div>                  
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
                    <div id="chartdiv1" class="display-none" style="display: block;height: 350px;">                   
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
                    <div id="chartdiv2" class="display-none" style="display: block;height: 350px;">                     
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
                      <span class="caption-subject font-dark bold uppercase">Frequency</span>            
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv3" class="display-none" style="display: block;height: 400px;">                   
                    </div>
                  </div>
                </div>                  
              </div>
              <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-share font-red-sunglo hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Compliance Wise Efficiency</span>               
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chart_4" class="display-none" style="display: block;height: 400px;">      

                    </div>
                    <input type="hidden" id="company" value="<?php echo $_SESSION['company'] ?>">                                  
                  </div>
                </div>                
              </div>             
            </div>
          <!-- </div> -->
          </div> 
        </div>
       <script>
 $(document).ready( function() {
  var modalDetails={'company':$('#company').val()};
  $.ajax({
  type: "POST",
  dataType: "json",
  url: "php/common/auditfrequencydash.php",
  data: modalDetails,
   success: auditfrequency
});  

 $.ajax({
  type: "POST",
  dataType: "json",
  url: "php/common/complianceStatusPie.php",
  data: modalDetails,

  success: statuspie
});  
  $.ajax({
  type: "POST",
  dataType: "json",
  url: "php/common/compliancepie.php",
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
     var measures=Object.keys(data);
  console.log(data[measures[0]].length);
var seriesData=[];
var chartData=[];
var t=[];
for(i=0;i<measures.length;i++)
     {
    chartData.push({"name":measures[i],"y":parseInt(data[measures[i]].length),"drilldown":measures[i]});
      } 

  for(i=0;i<measures.length;i++){
for(j=0;j<data[measures[i]].length;j++){
   // console.log(data[measures[i]][j].department_name);
   seriesData.push({"name":data[measures[i]][j].title,"y":data[measures[i]][j].count});

      } 
      t.push({"name":measures[i],"id":measures[i],"data":seriesData});
  seriesData=[];

}
Highcharts.chart('chartdiv3', {

  //  colors: ['#ADD8E6', '#E6ACD7', '#B2B2B2', '#D0D050', 'green', 'skyblue',
  //   '#FF9655', '#FFF263', '#6AF9C4'
  // ],     
 chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'   
    },
    credits:{
      enabled:false
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
                format: '<b><span style="text-transform:capitalize;">{point.name}</span></b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    "series": [{
        'name':'name',
        'colorByPoint': true,
        'data':chartData,
        'drilldown':"name"
    }],
     "drilldown": {
    "series": t,
}
});
}
//   function compliancepie(data){
//  var chart = AmCharts.makeChart( "chartdiv1", {
//   "type": "pie",
//   "theme": "light",
//   "titles": [ {
//     "text": "",
//     "size": 16
//   } ],
//   "legend":{
//     "position":"bottom",
//     "autoMargins":false,
//     "marginLeft":0,
//     "marginRight":0,
//     "labelWidth":100
//   },
//   "radius":170,
//   "labelsEnabled":false,
//   "dataProvider": data,
//   "valueField": "count",
//   "titleField": "name",
//   "startEffect": "elastic",
//   "startDuration": 2,
//   "labelRadius": 15,
//   "innerRadius": "30%",
//   "depth3D": 10,
//   "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
//   "angle": 15,
//   "export": {
//     "enabled": true
//   }
// } );
// }
 function compliancepie(data){

  console.log(data);
  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].name,"y":parseInt(data[i].count)});
      } 
 Highcharts.chart('chartdiv1', {    
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
  function statuspie(data){
 
  var chart = AmCharts.makeChart( "chartdiv2", {
    
 "type": "pie",
  "theme": "light",
  "titles": [ {
    "text": "",
    "size": 16
  } ],
  "legend":{
    "position":"bottom",
    "autoMargins":false,
  },
  "radius":180,
  "depth3D":10,
  "angle":15,
  "labelsEnabled":false,
  "dataProvider": data,
  "valueField": "count",
  "titleField": "status",
   "balloon":{
   "fixedPosition":true
  },
 
} );
}
function auditstatus3(data){      
 var chart = AmCharts.makeChart("chart_4", {
    "theme": "light",
    "type": "serial",
    "titles": [ {
    "text": "",
    "size": 16
  } ],
    "dataProvider":data,
    "valueAxes": [{
        "stackType": "3d",
        "unit": "",
        "position": "left",
        "title": "",
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": " [[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "title": "2004",
        "type": "column",
        "valueField": "count"
    
    }],
    "plotAreaFillAlphas": 0.1,
    "depth3D": 20,
    "angle": 30,
    "categoryField": "status",
    "categoryAxis": { 
    "categoryAxis.dashLength":100,
    "categoryAxis.gridPosition": "start",
    "gridPosition": "start",
    "autoGridCount": "true",
    "gridPosition": "start", 
    "autoGridCount": "true",
    "labelRotation": 60,
    "minHorizontalGap": 0
}
    
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
