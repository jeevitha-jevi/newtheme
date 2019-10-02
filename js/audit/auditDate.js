$(document).ready( function() {
     	     
  $.ajax({
  dataType: "json",
  url: "php/common/auditDate.php",
  data1: "",
  success: auditDate1
  }); 
 });
  function auditDate1(data1)
    {
    	debugger
    	 var count4 = Object.keys(data1).length;
       var auditdate  = new Array();
       var audsts     =new Array();
       var enddate    = new Array();
        var d         = new Date();
        var date      = d.getDate();
        var month     =d.getMonth()+1;
        var year      =d.getFullYear();
        var date1  ;
        var month1 ;
        var year1;
        var date2  =0;
        var month2 =0;
        var year2  =0;
        var date3  =0;
        var month3 =0;
        var year3  =0;
         var date4 =0;
        var month4 =0;
        var year4  =0;
          
       
         var i=0;
         for(i=0;i<count4;i++)
         {
         auditdate.push(data1[i].start_date);
         audsts.push(data1[i].status);
         enddate.push(data1[i].end_date);
        
           
       }
         // inprogress frequency values
         for(j=0;j<count4;j++)
         {
          var name=audsts[j];
          var auditdate1 = auditdate[j];
          var  auditdate3 = enddate[j];
          var auditdate2 = new Date(auditdate1);
          date1  = auditdate2.getDate();
          month1 = auditdate2.getMonth()+1;
          year1  = auditdate2.getFullYear();
         if(name!="published"&&name!="returned")
         {
        
       debugger
       if( date == date1&&month==month1&&year==year1)

        
       {

         date2 +=1;
       }
       if( month == month1&& year ==year1)
       {
         month2 +=1;
       }
       if( year == year1)
       {
         year2 +=1;
       }

        }
        document.getElementById("date2").innerHTML=date2;
        document.getElementById("month2").innerHTML=month2;
        document.getElementById("year2").innerHTML=year2;
        // published count values
          
          if(name =="published")
             
         {
          
       debugger
       if( date == date1&& month==month1&&year==year1)
        
       {
         date3 +=1;
       }
       if( month == month1&&year==year1)
       {
         month3 +=1;
       }
       if( year == year1)
       {
         year3 +=1;
       }

        }
        document.getElementById("date3").innerHTML=date3;
        document.getElementById("month3").innerHTML=month3;
        document.getElementById("year3").innerHTML=year3;
// due  count values 
       
         var auditdate5 = new Date(auditdate3);
         var	e_date= auditdate5.getDate();
         var e_month = auditdate5.getMonth()+1;
         var	e_year  = auditdate5.getFullYear();
      //  debugger
      if(date<e_date&&month<e_month&&year<e_year)
        
         {
         
         	
       if( date == date1&& month==month1&&year==year1)
       {
         date4 +=1;
       }
       if( month == month1&&year==year1)
       {
         month4 +=1;
       }
       if( year == year1)
       {
         year4 +=1;
       }

        }
        document.getElementById("date4").innerHTML=date4;
        document.getElementById("month4").innerHTML=month4;
        document.getElementById("year4").innerHTML=year4;
        //delayed count values


        if(date>e_date&&month>e_month&&year>e_year)
        var date5  =0 ;
        var month5 =0 ;
        var year5  =0 ;
         {
          
         	
       if( date == date1&& month==month1&&year==year1)
       {
         date5 +=1;
       }
       if( month == month1&&year==year1)
       {
         month5 +=1;
       }
       if( year == year1)
       {
         year5 +=1;
       }

        }
        document.getElementById("date5").innerHTML=date5;
        document.getElementById("month5").innerHTML=month5;
        document.getElementById("year5").innerHTML=year5;
          }
        }
      
	          
           
