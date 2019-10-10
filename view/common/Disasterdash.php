<!DOCTYPE html>
<html>
<head>

  <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
  <script src="https://www.amcharts.com/lib/3/serial.js"></script>
  <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
  <script src="https://www.amcharts.com/lib/3/pie.js"></script>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
  <link href="metronic/theme/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
  <link rel="shortcut icon" href="favicon.ico" />

  <script src="https://www.amcharts.com/lib/3/radar.js"></script>
  <script src="https://www.amcharts.com/lib/3/gauge.js"></script>


</head>
  <style>
  .col-md-3{
        position: relative;
        /*width: 100%;*/
  }
    #businessimpact {
      background-color: white;
      height: 345px;
      
    }
    #businessimpact a, #category a, #chartdiv3 a, #dr_critical a{
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
    #category {

      height: 344px;
      background-color: white;

    }
    #dr_location {
      height: 315px;
      background-color: white;
    }  
      
    #dr_critical{
      background-color: white;
      height: 315px;
  
    }      
    .notification-body:after {
    display: block;
    content: '';
    clear: both;
    }
    .notification-body {
    padding: 10px 10px 0 0;
    position: relative;
    }
    body {
       /* font-family: 'Roboto' !important;*/
        background-color: #e9ecf3;
    }
    .dash-notification {
        font-weight: 100;
        margin-bottom: 10px;
    }
   
    .notification-body i {
      color: #fff;
      float: left;    
      opacity: 0.1;
      position: absolute;
      top: 40px;
      left: 10px;
    }
    .fa {    
      font: normal normal normal 14px/1 FontAwesome;
      }
    .header-align {
      float: right;
      color: #fff;
      margin-top: -12px;
    }
    .session-wise {
      color: #fff;
      padding-top: 5px;
    }
    .list-class{
      display: inline-block;
      text-align: center;
      padding: 0 5px;
    }
    .header-align h4 {
      margin: 0;
      font-size: 50px;
      text-align: right;
      font-weight: 100;
      margin-top: -20px;
    } 
    .page-container{
      max-width: 1520px !important; 
          max-width: 100%;
    }

    @media only screen and (max-width: 414px){
      #businessimpact, #category, #chartdiv3, #dr_critical{
       width: 1140% !important;

      }
      .session{
               /*width: 405px !important;*/
           max-width: 372px !important;
      }
       .red1, .blue1, .green1, .orange1{
                   width: 100% !important;

         
     }
    }
    @media only  screen and (max-width: 1025px){
     .red, .blue, .green, .orange{
                   width: 100% !important;

         
     }
     .green{
          margin-top: 15px !important;
     }
     .session{
           margin-left: -290px !important;
           width: 750px !important;
         
     }
     .col-md-6{
                    width: 140% !important;
     }
    .page-container{
         
    }
    .category{
         
    }
    .charts {
         margin-left: -270px !important;
    }
    .page-container {
    max-width: 100% !important;
}

    }



       




       
  </style>    
</head>
<body>

<!-- <div style="color: #666;font-weight: initial;font-size: 22px; margin-left: 10px;">Audit Dashboard</div> -->
  <div class="row session" style=" height: auto;width: 1275px;margin-left: -60px;">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 blue blue1" style=" height: auto;width: 24%;">
      <div class="dash-notification">
        <div class="notification-body" style="background-color: #3598dc;">
          <i class="fa fa-users" style="font-size: 70px;"></i>
          <div class="header-align">
            <p>REGISTERED USERS</p>
            <a ui-sref="home.list" href="#!/audit/list"><h4 id="reg_users" style="color:#fff">18</h4></a>

          </div>
        </div>
        <div class="session-wise" style="background-color: #2c93da;height: 35px; ">
          <ul style="height: 45px; background-color: #3892da; padding-left: 50px;">
            <li class="list-class">
              <span>Today</span><br>              
              <label id="reg_user_today">0</label>
            </li>
            <li class="list-class">
              <span>Week</span><br>              
              <label id="reg_user_week">0</label>
            </li>
            <li class="list-class">
              <span>Monthly</span><br>              
              <label id="reg_user_month">0</label>
            </li>
            <li class="list-class">
              <span>Year</span><br>              
              <label id="reg_user">0</label>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 green green1" style=" height: auto; width: 24%;">
      <div class="dash-notification">
        <div class="notification-body" style="background-color: #26a69a;">
          <i class="fa fa-cloud-upload" style="font-size: 85px;"></i>
          <div class="header-align">
            <p>PUBLISHED</p>
            <a ui-sref="home.list" href="#!/audit/list"><h4 id="publish" style="color: #fff">3</h4> </a>

          </div>
        </div>
        <div class="session-wise" style="background-color: #229a8f; height: 50px; ">
          <ul style="height: 45px; padding-left: 50px;">
            <li class="list-class">
              <span>Today</span><br>
              <label id="publish_today">0</label>
            </li>
            <li class="list-class">
               <span>Week</span><br>
              <label id="publish_week">0</label>  
            </li>
            <li class="list-class">
              <span>Monthly</span><br>
              <label id="publish_month">1</label>
            </li>
            <li class="list-class">
              <span>Year</span><br>
              <label id="published">1</label>
            </li>
          </ul>
        </div>
      </div>
    </div> 
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 orange orange1" style=" height: auto; width: 24%;">
      <div class="dash-notification">
        <div class="notification-body" style="background-color: #f2784b;">
          <i class="fa fa-clock-o" style="font-size: 85px;"></i>
          <div class="header-align">
            <p>DUE</p>
            <a ui-sref="home.list" href="#!/audit/list"><h4 id="due" style="color: #fff">0</h4></a>

          </div>
        </div>
        <div class="session-wise" style="background-color: #f16e3d; height: 50px; ">
          <ul style="height: 45px; padding-left: 50px;">
            <li class="list-class">
              <span>Today</span><br>          
              <label id="due_today">0</label>
            </li>
            <li class="list-class">
              <span>Week</span><br>
              <label id="due_week">0</label>
            </li>
            <li class="list-class">
              <span>Monthly</span><br>
              <label id="due_month">0</label>
            </li>
            <li class="list-class">
              <span>Year</span><br>
              <label id="dues">0</label>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 red red1" style=" height: auto;width: 24%;">
      <div class="dash-notification">
        <div class="notification-body" style="background-color: #cb5a5e;">
          <i class="fa fa-exclamation-triangle" style="font-size: 85px;"></i>
          <div class="header-align">
            <p>DELAYED</p>
            <a ui-sref="home.list" href="#!/audit/list"><h4 id="delay" style="color: #fff">1</h4></a>
          </div>
        </div>
        <div class="session-wise" style="background-color: #ca4c4d; height: 50px; ">
          <ul style="height: 45px; padding-left: 50px;">
            <li class="list-class">
              <span>Today</span><br>              
              <label id="delay_today">0</label>
            </li>
            <li class="list-class">
              <span>Week</span><br>             
              <label id="delay_week">0</label>
            </li>
            <li class="list-class">
              <span>Monthly</span><br>              
              <label id="delay_month">1</label>
            </li>
            <li class="list-class">
             <span>Year</span><br>             
              <label id="delayed">1</label>
            </li>
          </ul>
        </div>
      </div>
    </div>     
  </div>
<div class="charts" style="margin-left: -40px;width: 116%;">
 <div class="row" >
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<h3>Business Impact</h3>
       <div id="businessimpact" >
       </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<h3>Category</h3>
      <div  id="category" ></div>
  </div>
</div>
  <div class="row" >
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<h3>Location</h3>
      <div  id="dr_location"  ></div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<h3>Critical Resource</h3>
       <div  id="dr_critical" > </div>
       </div> 
      
  </div> 

 
</div> 
<script>
 $(document).ready( function() {
  $.ajax({
  dataType: "json",
  url: "php/disaster/disasterBusinessimpactDash.php",
  data: "",
  success: businessimpact
});  

 $.ajax({
  dataType: "json",
  url: "php/disaster/disasterCategoryDash.php",
  data: "",
  success: disastercategory
});  
  $.ajax({
  dataType: "json",
  url: "php/disaster/disasterLocationDash.php",
  data: "",
  success: locationdash
}); 
 $.ajax({
  dataType: "json",
  url: "php/disaster/disasterCriticalDash.php",
  data: "",
  success: disasterCritical
});  
});
  function businessimpact(data){
    AmCharts.makeChart("businessimpact",
          {
            "type": "pie",
            "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
            "depth3D": 3,
            "innerRadius": "60%",
            "labelRadius": 0,
            "colors": [
              "#3598dc",
              "#cb5a5e",
              "#26a69a"
            ],
            "marginTop": 0,
            "marginBottom": 0,
            "labelColorField": "#000",
            "outlineThickness": 0,
            "titleField": "business_impact_scale",
            "valueField": "count",
            "color": "#87919E",
            "fontFamily": "arial",
            "fontSize": 12,
            "allLabels": [],
            "balloon": {},
            "legend": {
              "enabled": false,
              "align": "center",
              "markerType": "circle"
            },
            "titles": [],
            "dataProvider": data
          }
        );


  }


  function disastercategory(data){
    debugger
 var chart = AmCharts.makeChart("category",
        {
          "type": "serial",
          "categoryField": "Disaster_category",
          "rotate": true,
          "colors": [
            "#26a69a"
          ],
          "startDuration": 1,
          "color": "#87919E",
          "fontFamily": "Arial",
          "fontSize": 12,
          "categoryAxis": {
            "gridPosition": "start"
          },
          "chartCursor": {
            "enabled": true
          },
          "chartScrollbar": {
            "enabled": true
          },
          "trendLines": [],
          "graphs": [
            {
              "fillAlphas": 1,
              "id": "AmGraph-1",
              "title": "graph 1",
              "type": "column",
              "valueField": "count"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "id": "ValueAxis-1",
              "title": ""
            }
          ],
          "allLabels": [],
          "balloon": {},
          "dataProvider": data
        });  

}






 function locationdash(data){
  debugger
 var chart = AmCharts.makeChart("dr_location",
        {

          "type": "radar",
          "categoryField": "backup_offsite_location",
          "colors": [
            "#3598dc",
            "#26a69a",
            "#f2784b",
            "#cb5a5e",
            "#26c281",
            "#1bbc9b",
            "#8e5fa2",
            "#95a5a6"
          ],
          "startDuration": 2,
          "color": "#87919E",
          "fontFamily": "arial",
          "fontSize": 12,
          "graphs": [
            {
              "balloonText": "[[count]]",
              "bullet": "round",
              "id": "AmGraph-1",
              "valueField": "count"
            }
          ],
          "guides": [],
          "valueAxes": [
            {
              "axisTitleOffset": 20,
              "gridType": "circles",
              "id": "ValueAxis-1",
              "minimum": 0,
              "axisAlpha": 0.15,
              "dashLength": 3
            }
          ],
          "allLabels": [],
          "balloon": {},
          "titles": [],
          "dataProvider": data
        });
}

function disasterCritical(data){
    debugger
AmCharts.makeChart("dr_critical",
      {
          "type": "serial",
          "theme": "light",
          "dataProvider": data,
          "valueAxes": [{
              "maximum": 100,
              "minimum": 0,
              "axisAlpha": 0,
              "dashLength": 4,
              "position": "left"
          }],
          "startDuration": 1,
          "graphs": [{
              "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
              "bulletOffset": 10,
              "bulletSize": 52,
              "colorField": "color",
              "cornerRadiusTop": 8,
              "customBulletField": "bullet",
              "fillAlphas": 0.8,
              "lineAlpha": 0,
              "type": "column",
              "valueField": "count"
          }],
          "marginTop": 0,
          "marginRight": 0,
          "marginLeft": 0,
          "marginBottom": 0,
          "autoMargins": false,
          "categoryField": "critical_resources",
          "categoryAxis": {
              "axisAlpha": 0,
              "gridAlpha": 0,
              "inside": true,
              "tickLength": 0
          },
          "export": {
            "enabled": true
           }

      });
 }
</script>

<script src="metronic/theme/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="metronic/theme/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="metronic/theme/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="metronic/theme/assets/global/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<script src="metronic/theme/assets/global/plugins/flot/jquery.flot.stack.min.js" type="text/javascript"></script>
<script src="metronic/theme/assets/global/plugins/flot/jquery.flot.crosshair.min.js" type="text/javascript"></script>
<script src="metronic/theme/assets/global/plugins/flot/jquery.flot.axislabels.js" type="text/javascript"></script>
<script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="metronic/theme/assets/pages/scripts/charts-flotcharts.min.js" type="text/javascript"></script>
</body>
</html>