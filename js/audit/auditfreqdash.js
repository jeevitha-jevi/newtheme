  $(document).ready( function() {
     	debugger;
         
  $.ajax({
  dataType: "json",
  url: "php/common/auditfrequencydash.php",
  data: "",
  success: auditfrequency
});  

});
     var auditfrequency1=new Array();
     var totcount2=new Array();

     function auditfrequency(data){
     	debugger;
     	
     	var count = Object.keys(data).length;
     	console.log(data);
     	var i;
     	for(i=0;i<count;i++)
     	{
     		auditfrequency1.push(data[i].audit_freq);
     		totcount2.push(data[i].count);

     	}
     	console.log(auditfrequency1);
     	console.log(totcount2);
      loadfrequency();
     }


     
    function loadfrequency(){
    var config = {
        type: 'radar',
        data: {
            datasets: [{
                data: totcount2,
                backgroundColor: window.chartColors.white,
                borderColor: window.chartColors.red,
                pointBackgroundColor: window.chartColors.red,

              
                label: auditfrequency1

            }],
            labels: auditfrequency1
        },
         options: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Frequency Chart'
            },
            scale: {
              ticks: {
                beginAtZero: true
              }
            }
        }

        
    };
    
var ctx = document.getElementById("chart-area1");
window.myDoughnut = new Chart(ctx, config);
   }