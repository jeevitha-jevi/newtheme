  $(document).ready( function() {
        
         
  $.ajax({
  dataType: "json",
  url: "php/common/dashboarddata.php",
  data: "",
  success: audittype
});  
    
});


     var audittype1=new Array();
     var totcount=new Array();

     function audittype(data){
     
        
        var count = Object.keys(data).length;
        console.log(data);
        var i;
        for(i=0;i<count;i++)
        {
            audittype1.push(data[i].audit_type);
            totcount.push(data[i].count);

        }
        console.log(audittype1);
        console.log(totcount);
     loadtype();

        
     }
     function loadtype(){


/*var config =( {
  animationEnabled: true,
  type: "pie",
  data: {
            datasets: [{
                data: totcount,
                backgroundColor: [
                  window.chartColors.yellowz,
                  window.chartColors.red 
                ],
                label: 'audittype1'

            }],
            labels: audittype1
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Audit Type'
            }
};
chart.render();

});*/

    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: totcount,
                backgroundColor: [
                  window.chartColors.yellowz,
                  window.chartColors.red 
                ],
                label: 'audittype1'

            }],
            labels: audittype1
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Audit Type'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
}


        
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myDoughnut = new Chart(ctx, config);
    



}