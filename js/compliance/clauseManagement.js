$(document).ready(function () {
    $('#formField').change(showOptionsModal);
});

function showOptionsModal() {
    var selectedFieldType = $('#formField option:selected').text();
    if (selectedFieldType.indexOf("multi_choice") !== -1) {
        $('#multiChoiceModal').show();
    } else {
        $('#multiChoiceModal').hide();
    }
}

function showModal(isUpdate, clauseOrCklId, isClause) {
    debugger
    $('#myModal').modal('show');
    if (isClause) {
        prepareForClauseModal(isUpdate, clauseOrCklId);
    } else {
        prepareForChecklistModal(isUpdate, clauseOrCklId);
    }
}

function prepareForChecklistModal(isUpdate, checklistId) {
    $('#complianceClauseModal').hide();
    $('#checkListModal').show();
    resetClauseModal();
    if (isUpdate) {
        prepareCklModalForUpdate(checklistId);
    } else {
        prepareCklModalForCreate(checklistId);
    }
}


function prepareCklModalForCreate(checklistId) {
    resetChecklistModal();
    $('#ckl_clauseId').val($('#clauseId' + checklistId).val());
    $('#multiChoiceModal').hide();
}

function prepareCklModalForUpdate(checklistId) {
    $('#ckl_clauseId').val($('#clauseId' + checklistId).val());
    $('#chekListId').val(checklistId);
    $('#ckl_action').val('update');
    $('#checkListDesc').val($('#checklistDesc' + checklistId).val());
    $('#formField').val($('#formFieldType' + checklistId).val());
    $('#checklistScore').val($('#checklistScore'+checklistId).val());
    $('#controlType').val($('#controlType'+checklistId).val());
    $('#classification').val($('#classification'+checklistId).val());
    $('#rating').val($('#rating'+checklistId).val());
    $('#crticality').val($('#crticality'+checklistId).val());
    $('#weakness').val($('#weakness'+checklistId).val());
    buildCklOptionsModal(checklistId);
    showOptionsModal();
    $('#manageChcekListButton').text('update');
}

function buildCklOptionsModal(checklistId) {
    $('ul#cklOpts' + checklistId + ' li').each(function (index) {
        var li = $(this);
        var div = li.children('div');
        optData = div.children(':nth-child(3)').val();
        if (index == 0) {
            resetCklOptionModal(optData);
        } else {
            addCklOption(optData);
        }
    });
}

function resetChecklistModal() {
    $('#ckl_clauseId').val('');
    $('#chekListId').val('');
    $('#ckl_action').val('create');
    $('#checkListDesc').val('');
    // Yes / No option
    $('#formField').val('1');
    $('#checklistScore').val('');
    $('#manageChcekListButton').text('create');
    resetCklOptionModal('');
}

function resetCklOptionModal(optData) {
    // Except the first row, remove all other rows
    $('ul#multiChoiceUl li:not(:first)').remove();
    var li = $('ul#multiChoiceUl li:first');
    prepareCklOptRowElements(li, 1, optData);
}

function prepareCklOptRowElements(li, idNumber, optData) {
    li.attr('id', 'cklOption-' + idNumber);
    var div = li.children('div');
    // Setting id for the child elements
    div.children(':nth-child(1)').attr('id', 'textCklOption-' + idNumber);
    div.children(':nth-child(1)').val(optData);
    //div.children('input').val(optData); The above statement and this one are same.    
    div.children(':nth-child(2)').attr('id', 'addCklOption-' + idNumber);
    div.children(':nth-child(3)').attr('id', 'removeCklOption-' + idNumber);
}

function addCklOption(optData) {
    var li = $('ul#multiChoiceUl li:first').clone().appendTo($('ul#multiChoiceUl'));
    var n = $("ul#multiChoiceUl li").length;
    prepareCklOptRowElements(li, n, optData);
}

function removeCklOption(buttonId) {
    if ($('ul#multiChoiceUl').children().length == 1) {
        $('#cklOptionsError').text('Atleast one option should be there. Change the form field type otherwise.');
        setTimeout(function () {
            $('#cklOptionsError').text('');
        }, 3000);
    } else {
        var listId = buttonId.split('-')[1];
        $('#cklOption-' + listId).remove();
    }
}

function getCklDetailsFromModal() {
    debugger;
    var cklModalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'clauseId': $('#ckl_clauseId').val(),
        'chekListId': $('#chekListId').val(),
        'action': $('#ckl_action').val(),
        'checkListDesc': $('#checkListDesc').val(),
        'formFieldType': $('#formField').val(),
        'score':$('#checklistScore').val(),
        'controlType':$('#controlType').val(),
        'classification':$('#classification').val(),
        'rating':$('#rating').val(),
        'crticality':$('#crticality').val(),
        'weakness':$('#weakness').val(),
        'mapped':$('#controls').val(),
        'cklOptionTexts': $("input[name='ckl_options[]']")
            .map(function () {
                return $(this).val();
            }).get()
    }
    return cklModalDetails;
}

function manageCheckList() {
    var cklModalDetails = getCklDetailsFromModal();
    $.ajax({
        type: "POST",
        url: "/newtheme/php/compliance/manageChecklist.php",
        data: cklModalDetails
    }).done(function (data) {
        location.reload();
    });
}

function deleteChecklist(checklistId) {
    var modalDetails = {
        'chekListId': checklistId,
        'action': 'delete'
    }
    $.ajax({
        type: "POST",
        url: "/newtheme/php/compliance/manageChecklist.php",
        data: modalDetails
    }).done(function (data) {
        location.reload();
    });
}

// Clause Modal preparation
function prepareForClauseModal(isUpdate, clauseId) {
    $('#complianceClauseModal').show();
    $('#checkListModal').hide();
    resetChecklistModal();
    if (isUpdate) {
        prepareModalForUpdate(clauseId);
    } else {
        prepareModalForCreate(clauseId);
    }
}

function resetClauseModal() {
    $('#clauseId').val('');
    $('#parentClauseId').val('');
    $('#clauseName').val('');
    $('#clauseDesc').val('');
    $('#number').val('');
    $('#manageButton').text('create');
    $('#action').val('create');
}

function prepareModalForCreate(clauseId) {
    //$('#complianceId').val($('#complianceId' + clauseId).val());
    resetClauseModal();
    if (clauseId) {
        $('#parentClauseId').val(clauseId);
    } else {
        $('#parentClauseId').val('');
    }
}

function prepareModalForUpdate(clauseId) {
    //$('#complianceId').val($('#complianceId' + clauseId).val());
    $('#clauseId').val(clauseId);
    $('#parentClauseId').val($('#parentClauseId' + clauseId).val());
    $('#clauseName').val($('#clauseName' + clauseId).val());
    $('#clauseDesc').val($('#clauseDesc' + clauseId).val());
    $('#number').val($('#orderNumber' + clauseId).val());
    $('#manageButton').text('Update');
    $('#action').val('update');
}

function getModalDetailsFromModal() {
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'complianceId': $('#complianceId').val(),
        'action': $('#action').val(),
        'clauseId': $('#clauseId').val(),
        //'score':$('#')
        'parentClauseId': $('#parentClauseId').val(),
        'clauseName': $('#clauseName').val(),
        'clauseDesc': $('#clauseDesc').val(),
        'number': $('#number').val()
    }
    return modalDetails;
}

function manageModal() {
    var modalDetails = getModalDetailsFromModal();
    $.ajax({
        type: "POST",
        url: "/newtheme/php/compliance/manageClause.php",
        data: modalDetails
    }).done(function (data) {
        location.reload();
    });
}

function deleteModal(clauseId) {
    var modalDetails = {
        'clauseId': clauseId,
        'action': 'delete'
    }
    $.ajax({
        type: "POST",
        url: "/newtheme/php/compliance/manageClause.php",
        data: modalDetails
    }).done(function (data) {
        location.reload();
    });
}

function saveComplStatus(isDraft){
    debugger
    var status=$('#currentWorkingStatus').val();
    var modalDetails = {
        'loggedInUser': $('#currentLoggedInUser').val(),
        'complianceId': $('#currentComplianceId').val(),
        'status': $('#currentWorkingStatus').val(),
        'action': 'saveComplianceStatus',
        'isDraft': isDraft
    } 
    $.ajax({
        type: "POST",
        url: "/newtheme/php/compliance/manageCompliance.php",
        data: modalDetails
    }).done(function (data) {
        
        if(status=="created" || status=="reviewed" )
        {
        window.location="/newtheme/view/compliance/complianceCreateAdmin.php";    
        }
        if(status=="in_draft" || status=="in_review" )
        {
        window.location="/newtheme/view/compliance/complianceReviewAdmin.php";    
        }
        if(status=="in_publish" )
        {
        window.location="/newtheme/view/compliance/complianceAnalyzeAdmin.php";    
        }
    });
   
}
function getControls(){
    debugger
     var compliance=$('#compliance').val();
    var modalDetails={'id':compliance};
      $.ajax({
        type: "POST",
        url: "/newtheme/view/common/controlsDropDown.php",
        data: modalDetails,
        success:function(data){
            $('#controlsDrop').html(data);
        
        }
    });
}

function deletecompliancename() {
    
    var modalDetails = {
       
        'complianceId': $('#currentComplianceId').val(),
        'action': 'deleted',
    }
    $.ajax({
        type: "POST",
        url: "/newtheme/php/compliance/manageCompliance.php",
        data: modalDetails
    }).done(function (data) {
           swal({
              title: "Are you sure want to delete this record?",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              closeOnConfirm: false
            }, function () {
              swal("Checklist Deleted!", "Your Checklist Has Got Deleted.", "success");
              setTimeout(function () {
                window.location="/newtheme/view/policy/Regulatoryengine.php";
              }, 1000);
            });

 
    });
}
