$(document).ready( function() {
     	     
  $.ajax({
  dataType: "json",
  url: "php/common/companyAudit.php",
  data: "",
  success: companyAudit
  }); 
 });


var colors=['#9999ff','#ff6666','#00ff00','#ff3300','#483D8B','#FF8C00','#708090'];
   var count1=colors.length;
  
    var companyname  = new Array();
    var uniqueNames = new Array();
    var auditcount = new Array();
    var totalcount    = 0;
    
       function companyAudit(data)
    {

        var count = Object.keys(data).length;
        console.log(data);
        var i;
        for(i=0;i<count;i++)
        {
            if(i>count){
          col[i]=colors[i-count];
        }
        else{
          col[i]=colors[i];
        }
        companyname.push(data[i].name);
        
 }        

       var count_company = uniqueNames.length;
         
     $.each(companyname, function(i, el){
      debugger
    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
   });


  for(i=1; i<=uniqueNames.length; i++){

    for(j =0;j<count;j++)
     {
      name = companyname[j];
      company_name = uniqueNames[i];
      if(name == company_name)
        {
          debugger
         totalcount += 1;
             
        }

      }

     auditcount.push(totalcount);     

  }
      
   loadpiechart();                     
     
   }
   

        
   function loadpiechart(){
    debugger
    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: auditcount,
                backgroundColor:[
                 window.chartColors.yellow,
                  window.chartColors.red, 
                  window.chartColors.blue,
                  window.chartColors.orange
                ],
                label: 'uniqueNames'

            }],
            labels: uniqueNames
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Company Audit'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
        
    };
    
var ctx = document.getElementById("chart-area3").getContext("2d");
window.myDoughnut = new Chart(ctx, config);
   }

$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
