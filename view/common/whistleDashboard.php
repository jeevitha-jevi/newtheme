<?php require_once __DIR__.'/../header.php';
$complianceWiseStatusGraph=false;

?>
<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>WhistleBlower</title>
    <base href="/freshgrc/">
    <script src="https://code.highcharts.com/highcharts.js"></script>   
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    
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
        <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>    

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
        height: 435px;      
      }
      #chartdiv2 {
        height: 435px;
        background-color: white;
      }
      #chartdiv3{
        background-color: white;
        height: 435px;      
      }
       #chartdiv4 {
        height: 435px;
        background-color: white;
      }
      #chartdiv1 a, #chartdiv2 a, #chartdiv3 a, #chartdiv4 a{
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
    .page-sidebar.navbar-collapse {
    max-height: none!important;
    position: fixed;
}
      </style>
  </head>
  <body style="font-family: sans-serif !important;">
    <body>
      <?php 
        include '../siteHeader.php';
        $currentMenu = 'whistleDashboard';
        include '../../php/policy/left.php';
        $userRole = $_SESSION['user_role'];
      ?>
      <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">       
        <div class="page-content-wrapper">          
          <div class="page-content">
          <div id="onclickk" ondblclick="myFunction()"> 
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="/freshgrc/view/whistleBlower/whistleBlowCreated.php ">
                  <div class="visual">
                    <i class="fa fa-registered"></i>
                  </div>
                  <div class="details">
                    <div class="desc">REGISTERED USERS</div>
                    <div class="number">
                      <span data-counter="counterup" data-value="18">18</span>
                    </div>                  
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="/freshgrc/view/whistleBlower/whistleBlowReported.php">
                  <div class="visual">
                    <i class="fa fa-binoculars"></i>
                  </div>
                  <div class="details">
                    <div class="desc">INVESTIGATE </div>
                    <div class="number">
                      <span data-counter="counterup" data-value="3">3</span></div>                  
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="/freshgrc/view/whistleBlower/whistleBlowClosed.php">
                  <div class="visual">
                    <i class="fa fa-check-circle"></i>
                  </div>
                  <div class="details">
                    <div class="desc">REVIEWED</div>
                    <div class="number">                    
                      <span data-counter="counterup" data-value="3">3</span>
                    </div>                  
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="/freshgrc/view/whistleBlower/whistlePermanentlyClosed.php">
                  <div class="visual">
                    <i class="fa fa-thumbs-up"></i>
                  </div>
                  <div class="details">
                    <div class="desc">APPROVED</div>
                    <div class="number"> 
                      <span data-counter="counterup" data-value="5">5</span></div>                  
                  </div>
                </a>
              </div>
            </div>
            <div class="clearfix"></div>          
            <div class="row">
              <div class="col-lg-6 col-xs-12 col-sm-12">                  
                <div class="portlet light bordered">
                  <div class="portlet-title">
                    <div class="caption">
                      <i class="icon-bar-chart font-dark hide"></i>
                      <span class="caption-subject font-dark bold uppercase">Relation</span>   
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
                      <span class="caption-subject font-dark bold uppercase">Monetary Value</span>         
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
                      <span class="caption-subject font-dark bold uppercase">Status</span>            
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
                      <span class="caption-subject font-dark bold uppercase">Company</span>               
                    </div>                 
                  </div>
                  <div class="portlet-body">                  
                    <div id="chartdiv4" class="display-none" style="display: block;">                      
                    </div>                  
                  </div>
                </div>                
              </div>             
            </div>
          </div>
          </div> 
        </div>
        <script type="text/javascript">
          document.getElementById("onclickk").ondblclick = function() {myFunction()}; 
          function myFunction() {
             location.href = "/freshgrc/view/whistleBlower/whistleBlowCreated.php";
          }
         $(document).ready( function() {
            $.ajax({
            dataType: "json",
            url: "php/common/manageWhistleDashBoard.php",
            data: "",
            success: whistleRelation
          });
        
           $.ajax({
            dataType: "json",
            url: "php/common/whistleMoney.php",
            data: "",
            success: whistleMoneyRange
          });
          $.ajax({
            dataType: "json",
            url: "php/common/whistleStatus.php",
            data: "",
            success: whistleStatus
          }); 
          $.ajax({
            dataType: "json",
            url: "php/common/whistleCompany.php",
            data: "",
            success: whistleCompany
          });    
          });

function whistleRelation(data){
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
Highcharts.chart('chartdiv1', {

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
//   var chartData=[];
//   seriesData=[];
//   var chartDrillData=[];
// for(i=0;i<data.length;i++){
//   debugger
//     chartData.push({"name":data[i].name,"y":parseInt(data[i].count),"drilldown":data[i].name});
//   }
//   for(i=0;i<data.length;i++){
// for(j=0;j<data.length;j++){
//    seriesData.push([data[j].employeeID,1]);
//       } 
//       chartDrillData.push({"name":data[i].name,"id":data[i].name,"data":seriesData,"drilldown":data[i].name});
//   seriesData=[];

// }
//      console.log(data);
//   var chartData=[];
// for(i=0;i<data.length;i++)
//      {
//     chartData.push({"name":data[i].name,"y":parseInt(data[i].count)});
//       } 
 // Highcharts.chart('chartdiv1', {

  //  colors: ['#ADD8E6', '#E6ACD7', '#B2B2B2', '#D0D050', 'green', 'skyblue',
  //   '#FF9655', '#FFF263', '#6AF9C4'
  // ],     
//  chart: {
//         plotBackgroundColor: null,
//         plotBorderWidth: null,
//         plotShadow: false,
//         type: 'pie'   
//     },
//   credits:
//   {
//     enabled: false
//   },

// title: {
//         text: ''
//     },
  
//  tooltip: {
//         pointFormat: '{name}<b>{point.percentage:.1f}%</b>'
//     },
// plotOptions: {
    //     pie: {
    //         size:200,
    //         allowPointSelect: false,
    //         cursor: 'pointer',
    //         dataLabels: {
    //             enabled: true,
    //             format: '<b><span style="text-transform:capitalize;">{point.name}</span></b>: {point.percentage:.1f} %',
    //             style: {
    //                 color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
    //             }
    //         }
    //     }
    // },
    // "series": [{
    //     name:'name',
    //     colorByPoint: true,
//         data:chartData,
//     }]
// });

   
          // function whistleRelation(data){
         
          //   var chart = AmCharts.makeChart( "chartdiv1", {
          //   "type": "pie",
          //   "theme": "light",
          //   "titles": [ {
          //     "text": "",
          //     "size": 16
          //   } ],
          //   "labelsEnabled":false,
          //   "radius":160,
          //   "dataProvider": data,
          //   "valueField": "count",
          //   "legend":{
          //              "position":"bottom",
                        
          //               "marginLeft":50,
          //               "align":"center",
                        
          //               "autoMargins":true
                       
                        
          //                           },
          //   "titleField": "name",
          //   "outlineAlpha": 0.4,
          //   "depth3D": 15,
          //   "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
          //   "angle": 15,
          //   "export": {
          //     "enabled": true
          //   }
          // } );

          // }
function whistleStatus(data){
     console.log(data);
  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].name,"y":parseInt(data[i].count)});
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
credits:
  {
    enabled: false
  },

title: {
        text: ''
    },
  
 tooltip: {
        pointFormat: '{name}<b>{point.percentage:.1f}%</b>'
    },
plotOptions: {
        pie: {
             size:200,
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
        name:'name',
        colorByPoint: true,
        data:chartData,
    }]
});
}    
      //     function whistleStatus(data){

      //  var chart = AmCharts.makeChart( "chartdiv3", {
      //   "type": "pie",
      //   "theme": "light",
      //   "titles": [ {
      //     "text": "",
      //     "size": 16
      //   } ],
      //   "labelsEnabled":false,
      //   "radius":160,
      //   "dataProvider": data,
      //   "valueField": "count",
      //   "titleField": "name",
      //   "legend":{
      //                  "position":"bottom",
                        
      //                   "marginLeft":50,
      //                   "align":"center",
                        
      //                   "autoMargins":true
                       
                        
      //                               },
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
function whistleCompany(data){
     console.log(data);
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
        pointFormat: '{name}<b>{point.percentage:.1f}%</b>'
    },
plotOptions: {
        pie: {
             size:200,
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
        name:'name',
        colorByPoint: true,
        data:chartData,
    }]
});
}          
      //  function whistleCompany(data){
       
      //   var chart = AmCharts.makeChart( "chartdiv4", {
          
      //  "type": "pie",
      //   "theme": "light",
      //   "titles": [ {
      //     "text": "",
      //     "size": 16
      //   } ],
      //   "labelsEnabled":false,
      //   "radius":160,
      //   "dataProvider": data,
      //   "legend":{
      //                  "position":"bottom",
                        
      //                   "marginLeft":50,
      //                   "align":"center",
                        
      //                   "autoMargins":true
                       
                        
      //                               },
      //   "valueField": "count",
      //   "titleField": "name",
      //   "depth3D":10,
      //   "angle":10,
      //   "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
      //     "export": {
      //     "enabled": true
      //    // "balloon":{
      //    // "fixedPosition":true
      //   },
       
      // } );
      // }

    function whistleMoneyRange(data){      
var chart = AmCharts.makeChart("chartdiv2", {
    "theme": "light",
    "type": "serial",
    "titles": [ {
    "text": "",
    "size": 16
  } ],
    "dataProvider":data,
    /*"valueAxes": [{
        "stackType": "3d",
        "unit": "%",
        "position": "left",
        "title": ""
    }],*/
    "startDuration": 1,
    "graphs": [{
        "balloonText": " [[category]]: <b>[[value]]</b>",
        "fillAlphas": 2,
        "lineAlpha": 0.3,
        "type": "column",
        "valueField": "count"
    
    }],
    "plotAreaFillAlphas": 0.1,
    "depth3D": 20,
    "angle": 40,
    "categoryField": "pricing",
    "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 90
    },
    
});
jQuery('.chart-input').off().on('input change',function() {
  var property  = jQuery(this).data('property');
  var target    = chart;
  chart.startDuration = 0;

  if ( property == 'topRadius') {
    target = chart.graphs[0];
        if ( this.value == 0 ) {
          this.value = undefined;
        }
  }

  target[property] = this.value;
  chart.validateNow();
});
}


        </script> 
         <button style="float: right;border-radius:40%;" onclick="topFunction()" id="myBtn" title="Go to top"  class="btn btn-info btn-lg"><span class="glyphicon glyphicon-circle-arrow-up"></span>Top</button> 
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
      </body>
    </body>
  </body>
</html>