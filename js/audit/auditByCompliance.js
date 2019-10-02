$(document).ready(function () {
    
    $("#canvas-holder").hide();
       $("#canvas-holder1").hide();
    
});

 function barForControlSets() {
        
         
  $.ajax({
  dataType: "json",
  url: "php/audit/barchartForStatus.php",
  data: "",
  success: auditcompstatus
});  

}
 
 function barForControls() {
        
    
  $.ajax({
  dataType: "json",
  url: "php/audit/barchartForControls.php",
  data: "",
  success: auditcompstatus1
});  

}    
     function auditcompstatus(data){
       $("#canvas-holder").show();
       $("#canvas-holder1").hide();
        
        debugger;
        var count2=1;
        var countCompName=0;
        var countRejected=0;
        var countInProgress=0;
        var count = Object.keys(data).length;
        //debugger;
        var auditcompstatus1=new Array();
     var totcompcount1=new Array();
     var compname1=new Array();
     var datasets=new Array();
     datasets[0]=new Array();
     var auditcompstatus2=new Array();
     auditcompstatus2[0]=new Array();
     auditcompstatus2[1]=new Array();
     auditcompstatus2[2]=new Array();
     var totcompcount2=new Array();
     var col2=new Array();
     var colors=['#00FFFF','#8A2BE2','#5F9EA0','#00FFFF','#FF8C00','#B22222'];
     var col=new Array();
     for(i=0;i<count;)
     {  auditcompstatus2[0].push(data[i].count);
        auditcompstatus1[0]=data[i].status;
        col[0]=colors[0];
        if(i==count-1){
           compname1[countCompName]=data[i].name;
            
            i=i+1;
        }
        else{
        for(j=i+1;j<count;j++){
            if(data[i].name==data[j].name){
              
              if(data[j].status== "rejected")
              {                  
                    auditcompstatus1[1]=data[j].status;
                    auditcompstatus2[1].push(data[j].count);

                   
                    col[1]=colors[1];
                    countRejected=countRejected+1;
                  }
                    
                else if(data[j].status==  "in-progress")
                {
                    
                    auditcompstatus1[2]=data[j].status;
                    auditcompstatus2[2].push(data[j].count);
                    
                    col[2]=colors[2];
                    countInProgress=countInProgress+1;
                   
                  }
                if(j==count-1){
                  compname1[countCompName]=data[i].name;
                }
                
            

                count2++;
          }
            else{
              compname1[countCompName]=data[i].name;
              countCompName=countCompName+1;
              if(countRejected==0){
               auditcompstatus2[1].push(0); 

              }
              if(countInProgress==0){
                auditcompstatus2[2].push(0); 
              }
                break;
              
              }
            }
        }
        countRejected=0;
        countInProgress=0;
        i=i+count2;
        count2=1;
     }
 
     console.log(auditcompstatus2);
     console.log(compname1);
        
        console.log(data);
      
      loadbar(compname1,datasets[0],auditcompstatus1,auditcompstatus2);
     }

     function auditcompstatus1(data){
        debugger;
          $("#canvas-holder1").show();
       $("#canvas-holder").hide();
        
         
        var count2=1;
        var countCompName=0;
        var countRejected=0;
        var countInProgress=0;
        var count = Object.keys(data).length;
        //debugger;
        var auditcompstatus1=new Array();
     var totcompcount1=new Array();
     var compname1=new Array();
     var datasets=new Array();
     datasets[0]=new Array();
     var auditcompstatus2=new Array();
     auditcompstatus2[0]=new Array();
     auditcompstatus2[1]=new Array();
     auditcompstatus2[2]=new Array();
     var totcompcount2=new Array();
     var col2=new Array();
     var colors=['#00FFFF','#8A2BE2','#5F9EA0','#00FFFF','#FF8C00','#B22222'];
     var col=new Array();
     for(i=0;i<count;)
     {  auditcompstatus2[0].push(data[i].count);
        auditcompstatus1[0]=data[i].status;
        col[0]=colors[0];
        if(i==count-1){
           compname1[countCompName]=data[i].name;
            //auditcompstatus2[0].push(data[j].count);
            i=i+1;
        }
        else{
        for(j=i+1;j<count;j++){
            if(data[i].name==data[j].name){
              
              if(data[j].status== "rejected")
              {                  //datasets.push({'label':auditcompstatus1,'backgroundColor':colour[0],'data':totcompcount1});
                    auditcompstatus1[1]=data[j].status;
                    auditcompstatus2[1].push(data[j].count);

                    //auditcompstatus2[j-i]=auditcompstatus1;
                    //totcompcount1[j]=data[j].count;
                    //auditcompstatus2[0].push(totcompcount1[j]);
                    col[1]=colors[1];
                    countRejected=countRejected+1;
                  }
                    
                else if(data[j].status==  "in-progress")
                {
                    //datasets.push({'label':auditcompstatus1,'backgroundColor':colour[0],'data':totcompcount1});
                    auditcompstatus1[2]=data[j].status;
                    auditcompstatus2[2].push(data[j].count);
                    //totcompcount1[j]=data[j].count;
                    //auditcompstatus2[1].push(totcompcount1[j]);
                    col[2]=colors[2];
                    countInProgress=countInProgress+1;
                   
                  }
                if(j==count-1){
                  compname1[countCompName]=data[i].name;
                }
                
            

                count2++;
          }
            else{
              compname1[countCompName]=data[i].name;
              countCompName=countCompName+1;
              if(countRejected==0){
               auditcompstatus2[1].push(0); 

              }
              if(countInProgress==0){
                auditcompstatus2[2].push(0); 
              }
                break;
              
              }
            }
        }
        countRejected=0;
        countInProgress=0;
        i=i+count2;
        count2=1;
     }
 
     console.log(auditcompstatus2);
     console.log(compname1);
        
        console.log(data);
        
      loadbar1(compname1,datasets[0],auditcompstatus1,auditcompstatus2);
     }

    function loadbar(compname,dataset,auditcompstatus1,auditcompstatus2){
        debugger;

        var barChartData = {
            labels: compname,
            datasets: [{
                label: auditcompstatus1[0],
                backgroundColor: window.chartColors.green,
                data: auditcompstatus2[0]
            }, {
                label: auditcompstatus1[1],
                backgroundColor: window.chartColors.red,
                data: auditcompstatus2[1]
            }, {
                label: auditcompstatus1[2],
                backgroundColor: window.chartColors.blue,
                data: auditcompstatus2[2]
            }]

        };  
    
 var ctx = document.getElementById("chart-by-compliance").getContext("2d");
     window.myBar = new Chart(ctx, {
                type: 'horizontalBar',
                data: barChartData,
                options: {
                    title:{
                        display:true,
                        text:"By Compliance"
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scaleBeginAtZero: true,
                    scaleStartValue : 0,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            
                            stacked: true
                        }]
                    }, 
                 
                }
            });
        for(i=0;i<auditcompstatus1.length;i++){
            auditcompstatus1.pop();
        }
        for(i=0;i<auditcompstatus2.length;i++){
            auditcompstatus2.pop();
        }
        
        
   } 
     
    function loadbar1(compname,dataset,auditcompstatus1,auditcompstatus2){
        debugger;

        var barChartData = {
            labels: compname,
            datasets: [{
                label: auditcompstatus1[0],
                backgroundColor: window.chartColors.green,
                data: auditcompstatus2[0]
            }, {
                label: auditcompstatus1[1],
                backgroundColor: window.chartColors.red,
                data: auditcompstatus2[1]
            }, {
                label: auditcompstatus1[2],
                backgroundColor: window.chartColors.blue,
                data: auditcompstatus2[2]
            }]

        };  
    
 var ctx = document.getElementById("chart-by-compliance1").getContext("2d");
     window.myBar = new Chart(ctx, {
                type: 'horizontalBar',
                data: barChartData,
                options: {
                    title:{
                        display:true,
                        text:"By Compliance"
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    responsive: true,
                    scaleBeginAtZero: true,
                    scaleStartValue : 0,
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            
                            stacked: true
                        }]
                    }, 
                 
                }
            });
        for(i=0;i<auditcompstatus1.length;i++){
            auditcompstatus1.pop();
        }
        for(i=0;i<auditcompstatus2.length;i++){
            auditcompstatus2.pop();
        }
        
        
   } 



