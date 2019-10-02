$(document).ready( function() {
   debugger
       
  $.ajax({
  dataType: "json",
  url: "php/common/dashboardauditstatus.php",
  data: "",
  success: auditstatus3
});  
   // var uniqueNames = new Array();

  var auditstatuscnt = new Array();
    var totalcnt   = new Array();
    var chartData =new Array();
    function auditstatus3(data){
      debugger
        var count = Object.keys(data).length;
        console.log(data);
        var i;
      for(i=0;i<count;i++)     
        { 
        debugger       
            auditstatuscnt.push(data[i].status);
            totalcnt.push(data[i].count);
             chartData[i]={'auditStatus':auditstatuscnt[i],'count':totalcnt[i]};
        }

    }
    console.log(chartData);




var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "dataProvider":chartData,
    "valueAxes": [{
        "stackType": "3d",
        "unit": "%",
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
    "depth3D": 60,
    "angle": 30,
    "categoryField": "auditStatus",
    "categoryAxis": {
        "gridPosition": "start"
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
 });