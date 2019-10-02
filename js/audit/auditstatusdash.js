 $(document).ready( function() {
     	     
  $.ajax({
  dataType: "json",
  url: "php/common/dashboardauditstatus.php",
  data: "",
  success: auditstatus
});  


});


     var colors=['#9999ff','#ff6666','#00ff00','#ff3300','#483D8B','#1E857B','#708090'];
     var auditstatus1=new Array();
     var totcount1=new Array();
     var create=0;
     var createcount=0;
     var prepared=0;
     var preparedcount=0;
     var performed=0;
     var performedcount=0;
     var approved=0;
     var approvedcount=0;
     var returned=0;
     var returnedcount=0;
     var published=0;
     var publishedcount=0;
     var inprogress=0;
     var due=0;
     var count1=colors.length;
     var col=new Array();


     function auditstatus(data){

     	var count = Object.keys(data).length;
     	console.log(data);
     	var i;
     	for(i=1;i<count;i++)
     	{
        if(i>count){
          col[i]=colors[i-count];
        }
        else{
          col[i]=colors[i];
        }
     		auditstatus1.push(data[i].status);
     		totcount1.push(data[i].count);

     	}
        for(i=0;i<count;i++){

        if(auditstatus1[i]=="performed")
        {
          performed=auditstatus1[i];
          performedcount=totcount1[i];

        }

        if(auditstatus1[i]=="approved")
        {
          approved=auditstatus1[i];
          approvedcount=totcount1[i];
        }
        if(auditstatus1[i]=="published")
        {
          published=auditstatus1[i];
          publishedcount=totcount1[i];

        }
        if(auditstatus1[i]=="returned")
        {
          returned=auditstatus1[i];
          returnedcount=totcount1[i];

        }
        if(auditstatus1[i]=="prepared")
        {
          prepared=auditstatus1[i];
          preparedcount=totcount1[i];

        }
        if(auditstatus1[i]=="create")
        {
          create=auditstatus1[i];
          createcount=totcount1[i];

        }
        
                
      }
      /*inprogress=(performedcount+createcount+approvedcount+returnedcount+preparedcount)-publishedcount;
         due=performedcount+createcount+approvedcount+preparedcount;
       	console.log(auditstatus1);
        console.log(totcount1);
      document.getElementById("inprogress").innerHTML=inprogress;
      document.getElementById("due").innerHTML=due;
      document.getElementById("published").innerHTML=publishedcount;
      document.getElementById("delayed").innerHTML=returnedcount;*/
      
      loadpie();


     }


    

    function loadpie(){
      
    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: totcount1,
                backgroundColor: col,
                label: 'audittype1'

            }],
            labels: auditstatus1
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Audit Status'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
        
    };
    
var ctx = document.getElementById("chart-area2").getContext("2d");
window.myDoughnut = new Chart(ctx, config);
   }

   