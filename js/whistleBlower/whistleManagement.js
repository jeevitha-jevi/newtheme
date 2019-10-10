function getwhisleReview(whistle_id,status_id) { 
 

    var saveApproveDetails = {
        'whistle_id': whistle_id,
        'status_id': status_id,
        'wb_solution_by_reviewer' : $('#wb_solutions').val(),
        'action':'Approve',
    }
    return saveApproveDetails;
}
function saveApprove(whistle_id,status_id) {  

   var saveApproveDetails = getwhisleReview(whistle_id,status_id);
     $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/whistleblower/management.php",
        data: saveApproveDetails,
        success: function(data){
            
            window.location = "/freshgrc/view/whistleBlower/whistleBlowReported.php";
        }
    });    
} 
function getwhislesaveReject(whistleid,statusid) { 
   

    var saveRejectDetails = {
        'whistleid': whistleid,
        'statusid': statusid,
        'reason_for_reject_by_reviewer': $('#reson_for_reject').val(),
        'action':'Reject',
    }
    return saveRejectDetails;
}
function saveReject(whistleid,statusid) {  
 
   var saveRejectDetails = getwhislesaveReject(whistleid,statusid);
     $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/whistleblower/management.php",
        data: saveRejectDetails,
        success: function(data){
       
            window.location = "/freshgrc/view/whistleBlower/whistleBlowReported.php";
        }
    });    
} 
function getwhisleUserReopen(whistleId,statusId) { 
debugger
    var saveReopenDetails = {
        'whistleId': whistleId,
        'statusId': statusId,
        'reopen_reason_by_wb_user' : $('#reson_for_reopen').val(),
        'action':'Reopen',
    }
    return saveReopenDetails;
}
function saveReopen(whistleId,statusId) {  
debugger  
   var saveReopenDetails = getwhisleUserReopen(whistleId,statusId);
     $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/whistleblower/management.php",
        data: saveReopenDetails,
        success: function(data){
            debugger
            window.location = "/freshgrc/view/whistleBlower/whistleBlowerLogin.php";
        }
    });    
} 
function getwhislesaveAccept(Whistle_id,Status_id) { 
debugger   

    var saveAcceptDetails = {
        'Whistle_id': Whistle_id,
        'Status_id': Status_id,
        'additional_info_by_wb_user': $('#additional_info').val(),
        'action':'Accept',
    }
    return saveAcceptDetails;
}
function saveAccept(Whistle_id,Status_id) {  
debugger  
   var saveAcceptDetails = getwhislesaveAccept(Whistle_id,Status_id);
     $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/whistleblower/management.php",
        data: saveAcceptDetails,
        success: function(data){
            debugger
            window.location = "/freshgrc/view/whistleBlower/whistleBlowerLogin.php";
        }
    });    
} 
