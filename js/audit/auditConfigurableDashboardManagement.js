$(document).ready(function() {
  var chart={'company':$('#company').val()};
$.ajax({
  dataType:"json",
  type: "POST",
    url: "/freshgrc/php/audit/getAllCharts.php",
    data: chart,
    success:populateCharts
})  
});
function populateCharts(data){
  
  for(var i=0;i<data.length;i++){
    var modalDetails={'company':$('#company').val(),'id':data[i].id};
    id=data[i].id;
    switch(data[i].chart_type){
      case "Pie Chart":
    switch(data[i].data){
      case "Frequency":
       $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/auditfrequencydashconf.php",
              data:modalDetails,
              success: auditfrequencyPie
            });
      break;
      case "Status":
      
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/statuspieconf.php",
              data:modalDetails,
              success: statuspie
            });
      break;
      case "Location":
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/locationconf.php",
              data:modalDetails,
              success: locationPie
            });
      break;
      case "Department":
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/departmentconf.php",
              data:modalDetails,
              success: departmentPie
            });
      break;
      case "Compliance":
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/complianceconf.php",
              data:modalDetails,
              success: compliancePie
            });
      break;
      case "Audit Type":
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/auditTypeConf.php",
              data:modalDetails,
              success:auditTypePie
            });
      break;
    }

    break;
    case "Bar Chart":
    switch(data[i].data){
      case "Frequency":
       $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/auditfrequencydashconf.php",
              data:modalDetails,
              success: auditfrequencyBar
            });
      break;
      case "Status":
      
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/statuspieconf.php",
              data:modalDetails,
              success: statusBar
            });
      break;
      case "Location":
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/locationconf.php",
              data:modalDetails,
              success: locationBar
            });
      break;
      case "Department":
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/departmentconf.php",
              data:modalDetails,
              success: departmentBar
            });
      break;
      case "Compliance":
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/complianceconf.php",
              data:modalDetails,
              success: complianceBar
            });
      break;
      case "Audit Type":
      $.ajax({
              type:"POST",
              dataType: "json",
              url: "php/common/auditTypeConf.php",
              data:modalDetails,
              success:auditTypeBar
            });
      break;
    }
  }

  }
}

  function compliancePie(data){
  // var chartDiv="chartdiv"+data[0].id;

  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].compliance,"y":parseInt(data[i].count)});
      } 
 Highcharts.chart('chartdiv'+data[0].id, {     
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
  // var chartDiv="chartdiv"+data[0].id;
  //   var chart = AmCharts.makeChart( chartDiv, {
  //               "type": "pie",
  //               "theme": "light",
  //               "titles": [ {
  //                 "text": "",
  //                 "size": 16
  //               } ],
  //               "radius": 150,
  //               "labelsEnabled":false,
  //               "dataProvider": data,
  //               "valueField": "count",
  //               "titleField": "compliance",
  //               "outlineAlpha": 0.4,
  //               "depth3D": 15,
                
  //               "balloonText": "[[title]]<br><span style='font-size:14px; text-transform:capitalize;'><b>[[value]]</b> ([[percents]]%)</span>",
  //               "angle": 30,
  //               "export": {
  //                 "enabled": true
  //               }
  //             } );
    
    
  // }
function complianceBar(data){
  var chartDiv="chartdiv"+data[0].id;
  var chart = AmCharts.makeChart( chartDiv, {
  "type": "serial",
  "hideCredits":true,
  "theme": "light",
  "dataProvider":data,
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "count"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "compliance",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 200
  },
  "categoryAxis":{
    "gridPosition" : "start",
    "labelRotation":15
  },
  "export": {
    "enabled": true
  }
});
}
function departmentBar(data){
  var chartDiv="chartdiv"+data[0].id;
  var chart = AmCharts.makeChart( chartDiv, {
  "type": "serial",
  "hideCredits":true,
  "theme": "light",
  "dataProvider":data,
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "count"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "departmentName",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 200
  },
  "categoryAxis":{
    "gridPosition" : "start",
    "labelRotation":15
  },
  "export": {
    "enabled": true
  }
});
}
 
function departmentPie(data){

  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].departmentName,"y":parseInt(data[i].count)});
      } 
 Highcharts.chart('chartdiv'+data[0].id, {     
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
//   var chartDiv="chartdiv"+data[0].id;
//     var chart = AmCharts.makeChart( chartDiv, {
//                 "type": "pie",
//                 "theme": "light",
//                 "titles": [ {
//                   "text": "",
//                   "size": 16
//                 } ],
//                 "radius": 150,
//                 "labelsEnabled":false,
//                 "dataProvider": data,
//                 "valueField": "count",
//                 "titleField": "departmentName",
//                 "outlineAlpha": 0.4,
//                 "depth3D": 15,
//                 "legend":{
//                        "position":"bottom",
                        
//                         "marginLeft":50,
//                         "align":"center",
                        
//                         "autoMargins":true
                       
                        
//                                     },
//                 "balloonText": "[[title]]<br><span style='font-size:14px; text-transform:capitalize;'><b>[[value]]</b> ([[percents]]%)</span>",
//                 "angle": 30,
//                 "export": {
//                   "enabled": true
//                 }
//               } );
// }
function locationBar(data){
  var chartDiv="chartdiv"+data[0].id;
  var chart = AmCharts.makeChart( chartDiv, {
  "type": "serial",
  "hideCredits":true,
  "theme": "light",
  "dataProvider":data,
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "count"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "locationName",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 200
  },
  "categoryAxis":{
    "gridPosition" : "start",
    "labelRotation":15
  },
  "export": {
    "enabled": true
  }
});
}
function locationPie(data){
  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].locationName,"y":parseInt(data[i].count)});
      } 
 Highcharts.chart('chartdiv'+data[0].id, {     
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

//   var chartDiv="chartdiv"+data[0].id;
//     var chart = AmCharts.makeChart( chartDiv, {
//                 "type": "pie",
//                 "theme": "light",
//                 "titles": [ {
//                   "text": "",
//                   "size": 16
//                 } ],
//                 "radius": 150,
//                 "labelsEnabled":false,
//                 "dataProvider": data,
//                 "valueField": "count",
//                 "titleField": "locationName",
//                 "outlineAlpha": 0.4,
//                 "depth3D": 15,
//                 "legend":{
//                        "position":"bottom",
                        
//                         "marginLeft":50,
//                         "align":"center",
                        
//                         "autoMargins":true
                       
                        
//                                     },
//                 "balloonText": "[[title]]<br><span style='font-size:14px; text-transform:capitalize;'><b>[[value]]</b> ([[percents]]%)</span>",
//                 "angle": 30,
//                 "export": {
//                   "enabled": true
//                 }
//               } );
// }
function auditTypeBar(data){
  var chartDiv="chartdiv"+data[0].id;
  var chart = AmCharts.makeChart( chartDiv, {
  "type": "serial",
  "hideCredits":true,
  "theme": "light",
  "dataProvider":data,
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "count"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "audit_type",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 200
  },
  "categoryAxis":{
    "gridPosition" : "start",
    "labelRotation":15
  },
  "export": {
    "enabled": true
  }
});
}
function auditTypePie(data){
  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].audit_type,"y":parseInt(data[i].count)});
      } 
 Highcharts.chart('chartdiv'+data[0].id, {     
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

//   var chartDiv="chartdiv"+data[0].id;
//   var chart = AmCharts.makeChart( chartDiv, {
//                 "type": "pie",
//                 "theme": "light",
//                 "titles": [ {
//                   "text": "",
//                   "size": 16
//                 } ],
//                 "radius": 150,
//                 "labelsEnabled":false,
//                 "dataProvider": data,
//                 "valueField": "count",
//                 "titleField": "audit_type",
//                 "outlineAlpha": 0.4,
//                 "depth3D": 15,
//                 "legend":{
//                        "position":"bottom",
                        
//                         "marginLeft":50,
//                         "align":"center",
                        
//                         "autoMargins":true
                       
                        
//                                     },
//                 "balloonText": "[[title]]<br><span style='font-size:14px; text-transform:capitalize;'><b>[[value]]</b> ([[percents]]%)</span>",
//                 "angle": 30,
//                 "export": {
//                   "enabled": true
//                 }
//               } );
// }
function auditfrequencyBar(data){
  var chartDiv="chartdiv"+data[0].id;
  var chart = AmCharts.makeChart( chartDiv, {
  "type": "serial",
  "hideCredits":true,
  "theme": "light",
  "dataProvider":data,
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "count"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "audit_freq",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 200
  },
  "categoryAxis":{
    "gridPosition" : "start",
    "labelRotation":15
  },
  "export": {
    "enabled": true
  }
});
}
function auditfrequencyPie(data){
  var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].audit_freq,"y":parseInt(data[i].count)});
      } 
 Highcharts.chart('chartdiv'+data[0].id, {     
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
//   var chartDiv="chartdiv"+data[0].id;
//   var chart = AmCharts.makeChart( chartDiv, {
//                 "type": "pie",
//                 "theme": "light",
//                 "titles": [ {
//                   "text": "",
//                   "size": 16
//                 } ],
//                 "radius": 150,
//                 "labelsEnabled":false,
//                 "dataProvider": data,
//                 "valueField": "count",
//                 "titleField": "audit_freq",
//                 "outlineAlpha": 0.4,
//                 "depth3D": 15,
//                 "legend":{
//                        "position":"bottom",
                        
//                         "marginLeft":50,
//                         "align":"center",
                        
//                         "autoMargins":true
                       
                        
//                                     },
//                 "balloonText": "[[title]]<br><span style='font-size:14px; text-transform:capitalize;'><b>[[value]]</b> ([[percents]]%)</span>",
//                 "angle": 30,
//                 "export": {
//                   "enabled": true
//                 }
//               } );
// }
function statusBar(data){
  var chartDiv="chartdiv"+data[0].id;
  var chart = AmCharts.makeChart( chartDiv, {
  "type": "serial",
  "hideCredits":true,
  "theme": "light",
  "dataProvider":data,
  "valueAxes": [ {
    "gridColor": "#FFFFFF",
    "gridAlpha": 0.2,
    "dashLength": 0
  } ],
  "gridAboveGraphs": true,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "count"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "status",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 200
  },
  "categoryAxis":{
    "gridPosition" : "start",
    "labelRotation":15
  },

  "export": {
    "enabled": true
  }
});
}
function statuspie(data){
   var chartData=[];
for(i=0;i<data.length;i++)
     {
    chartData.push({"name":data[i].status,"y":parseInt(data[i].count)});
      } 
 Highcharts.chart('chartdiv'+data[0].id, {     
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

      // var chartDiv="chartdiv"+data[0].id;
      //         var chart = AmCharts.makeChart( chartDiv, {
                
      //          "type": "pie",
      //           "theme": "light",
      //           "titles": [ {
      //             "text": "",
      //             "size": 16
      //           } ],
      //           "legend":{
      //                  "position":"bottom",
      //                   "marginRight":0,
      //                   "marginLeft":0,
      //                   "autoMargins":true,
      //                   "labelWidth":100
                        
      //                               },
      //           "radius": 150,
      //           "angle": 30,
      //           "depth3D": 15,
      //           "labelsEnabled":false,
      //           "dataProvider": data,
      //           "valueField": "count",
      //           "titleField": "status",
      //            "balloon":{
      //            "fixedPosition":true

      //           },
               
      //         } );
      //       }
function getData(){
  $('#dataModal').modal('show');
}
function saveChartData(){
  var chartDetails={
    'chartType':$('#chartType').val(),
    'chartData':$('#chartData').val(),
    'company':$('#company').val(),
    'user':$('#user').val()
  }
   $.ajax({
        type: "POST",
        url: "/freshgrc/php/audit/createChart.php",
        data: chartDetails,
        dataType:"json",
        success:reload
    }); 
}
function reload(data){
  var chartselectData = data;
  var charttype1 = chartselectData[0].audit_chart_type_id;
  var chartdata1 = chartselectData[0].audit_chart_data_id;
  switch (chartdata1) {
    case 1:
        switch (charttype1) {
          case 1:
           window.location.href = "/freshgrc/view/audit/auditstatuschart.php/7";
          break;
          case 2:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/1";
          break;
        }
         break;
        case 2:
           switch (charttype1) {
          case 1:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/8";
          break;
          case 2:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/2";
          break;
        }
        break;
        case 3:
         switch (charttype1) {
          case 1:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/9";
          break;
          case 2:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/3";
          break;
        }
         break;
        case 4:
            switch (charttype1) {
          case 1:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/10";
          break;
          case 2:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/4";
          break;
        }
         break;
        case 5:
         switch (charttype1) {
          case 1:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/11";
          break;
          case 2:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/5";
          break;
        }
         break;
        case 6:
            switch (charttype1) {
          case 1:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/12";
          break;
          case 2:
          window.location.href = "/freshgrc/view/audit/auditstatuschart.php/6";
          break;
        }
         break;
   
}
}