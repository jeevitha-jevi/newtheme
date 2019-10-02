$(document).ready(function(){
  var currentDate = new Date(),
      day = currentDate.getDate(),
      month = currentDate.getMonth() + 1,
      year = currentDate.getFullYear();
 document.getElementById("dateDefault").innerHTML= day + "/" + month + "/" + year;
});



function getControls(){
    
     var compliance=$('#regulation').val();
    var modalDetails={'id':compliance};
      $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/controlsDropDown.php",
        data: modalDetails,
        success:function(data){
            $('#controlDrop').html(data);
        
        }
    });
}


function getSubAssetClass(){
        
        var modalDetails= {
            't':$('#assettype').val(),
        };

        $.ajax({
        type: "POST",
        url: "/freshgrc/view/bcpm/bcpmSubAssetClass.php",
        data: modalDetails,
        success:function(data){
            $('#bcpmSubAsset').html(data);
        
        }
    });
         
    }

    function manageModal()
    {
        var data =
        {
            'bcpm_plan_name':$("#bcpm_plan_name").val(),
            'regulation':$("#regulation").val(),
            'controlDrop':$("#controls").val(),
            'assettype':$("#assettype").val(),
            'bcpmSubAsset':$("#subPolicy").val(),
            'function_process':$("#function_process").val(),
            'location':$("#location").val(),
            'owner':$("#assignedto").val(),
            'approver':$("#assignedto").val(),

        }

        $.ajax({
            type:"POST",
            url:"/freshgrc/php/bcpm/manageNewBcpm.php",
            data:data,
            // success:function(data){
            //     window.location.href="https://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_event_ready";
            
        })
    }