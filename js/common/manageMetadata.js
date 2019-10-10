$(document).ready(function() {
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/common/manageMetadataService.php",
        data: {
            'action' : 'configTypeList'
        },
        success: listConfigTypes

    });    
});

function listConfigTypes(data) {
    var htmlText = '';
    for (var key in data) {
        htmlText += '<div class="settings_flowpic" onclick="clickConfigType(\'' + data[key] + '\')">';
        htmlText += '<div class="openend settings_pic" id="blueline12' + data[key] + '"></div>';
        //htmlText += '<img src="../files/' + company_name + '/images_project/' + data[key].projectimage + '" class="work_pic">';
        htmlText += '<p class="flowword"> <b>' + data[key] + '</b></p>';
        htmlText += '</div>';
    }
    //alert (htmlText);
    $('#configTypes').html(htmlText);
    
    $(".openend").hide();
}

function clickConfigType(confType) {
    var id = confType;

    $(".openend").hide();
    //$("#blueline12" + id).show();
    $("#blueline12" + id).css("background-color","yellow");

    var datas = {
        'configType': id,
        'action' : 'fetchConfig'
    }

    $.ajax({
        type: "POST",
        url: "/freshgrc/php/common/manageMetadataService.php",
        data: datas
    }).done(function (data) {
        alert(data);
    });
}


