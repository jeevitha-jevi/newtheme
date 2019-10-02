function importCsv() {
    debugger
    //var selectedData = table.rows('.selected').data();
    //var complianceId = selectedData[0][0];
    $('#complianceCsv').click();
    var myFormData = new FormData();
    myFormData.append('complianceCsv', complianceCsv.files[0]);
    //myFormData.append('complianceId', complianceId);
    myFormData.append('loggedInUser', $('#loggedInUser').val());
    var csvName = complianceCsv.files[0].name;
    $.ajax({
        url: "/freshgrc/php/compliance/importCompliance.php",
        type: "POST",
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        success: function (data) {
            //alert('Successfully uploaded : '+data);
            window.location="view/compliance/complianceCreateAdmin.php";
        },
        error: function () {}
    });
}
