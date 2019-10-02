$(document).ready(function () {  
    var userCredentials = {
        'userId' : loggedInUser,
        'userRole' : loggedInUserRole
    } 
    
$(".datepickerClass").each(function() {
        $(this).datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "2017:2099"  
        });
    });


    $.ajax({
        dataType: "json",
        type: "POST",
        url: "/freshgrc/php/risk/noofriskdashboardlist.php",
        data: userCredentials,
        success: success
    });
    if (userCredentials.userRole == "risk_reviewer") {

        var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 

    if(mm<10) {
        mm = '0'+mm
    } 

    today = mm + '/' + dd + '/' + yyyy;
   

     document.getElementById("reviewDate").innerHTML = today;
        
    }

    $("div.desc").hide();
    $("input[name$='date']").click(function() {
        var test = $(this).val();
        $("div.desc").hide();
        $("#" + test).show();
    });
    

    
});

var table;

function tableInit() {

    table = $('#modaldetails').DataTable({
        select: {
            style: 'single'
        },
        buttons: [
            { extend: 'print', className: 'btn dark btn-outline',titleAttr:'Print', text: '<span class="glyphicon glyphicon-print" data-toggle="tooltip"></span>' },
            { extend: 'copy', className: 'btn red btn-outline' ,titleAttr:'Copy', text: '<span class="glyphicon glyphicon-copy" data-toggle="tooltip"></span>'},
            { extend: 'pdf', className: 'btn green btn-outline' ,titleAttr:'PDF', text: '<span class="glyphicon glyphicon-file" data-toggle="tooltip"></span>'},
            { extend: 'csv', className: 'btn purple btn-outline ' ,titleAttr:'CSV', text: '<img src="/freshgrc/assets/images/csv.png" alt=csv width="20" height="20" data-toggle="tooltip"/>'},
            { extend: 'colvis', className: 'btn dark btn-outline',titleAttr:'Columns', text: '<span class="glyphicon glyphicon-th-list" data-toggle="tooltip"></span>'}
 ],
             "pageLength": 20,
            "ordering":false,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        columnDefs: [
            {
                targets: [0,5],
                visible: false
            }
        ]
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table.cell(cell).invalidate('dom');
        } );
    } ).draw();
    
    
}
function success(data) {
    buildHtmlTable(data);
    tableInit();
}



function buildHtmlTable(data) {
    var columns = addAllColumnHeaders(data);
    for (var i = 0; i < data.length; i++) {
        var row$ = $('<tr/>');
        for (var colIndex = 0; colIndex < columns.length; colIndex++) {
            var cellValue = data[i][columns[colIndex]];
            if(colIndex == 0){
                row$.append($('<td/>').html(""));
            }
            if (cellValue == null) {
                cellValue = "";
            }

            row$.append($('<td/>').html(cellValue));
        }
        $("#modaldetails").append(row$);
    }
}

function addAllColumnHeaders(data) {
    var columnSet = [];
    var headerTr$ = $('<tr/>');

    for (var i = 0; i < data.length; i++) {
        var rowHash = data[i];
        for (var key in rowHash) {
            if ($.inArray(key, columnSet) == -1) {
                columnSet.push(key);
                headerTr$.append($('<th/>').html(key));
            }
        }
    }
    return columnSet;
}

function showRiskPlan() {
    window.location = "/freshgrc/view/risk/riskPlan.php";
}


function getAction(){
    $('#action').val('create');
}

function getModalDetailsFromPlan() {
    
    var modalDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'riskSubject': $('#riskSubject').val(),
        'companyId': $('#company').val(),
        'incident':$('#incident').val(),
        'scenario':$('#scenario').val(),
        'action': $('#action').val(),
        'category': $('#category').val(),
        'location': $('#location').val(),
        'regulation': $('#regulation').val(),
        'subCategory':$('#subCategory').val(),
        'controlNumber': $('#controls').val(),
        'affectedAssets': $('#affectedAssets').val(),
        'technology': $('#technology').val(),
        'team': $('#team').val(),
        'additionalStakeHolder': $('#additionalStakeHolder').val(),
        'riskOwner': $('#riskOwner').val(),
        'riskMitigator': $('#riskMitigator').val(),
        'riskReviewer': $('#riskReviewer').val(),
        'riskSource': $('#riskSource').val(),
        'riskScore': $('#riskScore').val(),
        'riskAssessment': $('#riskAssessment').val(),
        'additionalNotes': $('#additionalNotes').val(),  
        'Exposure_Asset_Before_Safeguard':$('#Exposure_Asset_Before_Safeguard').val(),
        'Asset_Value_Before_Safeguard': $('#Asset_Value_Before_Safeguard').val(),
        'Single_Loss_Expectancy_Before_Safeguard': $('#Single_Loss_Expectancy_Before_Safeguard').val(),
        'Anulaized_Rate_Of_Ocurance_Before_Safeguard': $('#Anulaized_Rate_Of_Ocurance_Before_Safeguard').val(),
        'Safeguard': $('#Safeguard').val(),
        'Anualized_Loss_Expection_Before_Safeguard': $('#Anualized_Loss_Expection_Before_Safeguard').val(),
        'Exposure_Asset_After_Safeguard': $('#Exposure_Asset_After_Safeguard').val(),
        'Anulaized_Rate_Of_Ocurance_After_Safeguard': $('#Anulaized_Rate_Of_Ocurance_After_Safeguard').val(),
        'Single_Loss_Expectancy_After_Safeguard': $('#Single_Loss_Expectancy_After_Safeguard').val(),
        'Anualized_Loss_Expection_After_Safeguard': $('#Anualized_Loss_Expection_After_Safeguard').val(),
        'Frequency_of_Occurence_Without_Control': $('#Frequency_of_Occurence_Without_Control').val(),
        'Months': $('#Months').val(),
        'Worst_Case_Description': $('#Worst_Case_Description').val(),
        'Worst_Case_Likelihood': $('#Worst_Case_Likelihood').val(),
        'Worst_Case_Financial_Exposure': $('#Worst_Case_Financial_Exposure').val(),
        'Risk_Category': $('#riskcategory ').val(),
        'other_risk' : $('#other_risk').val(),
        'Typical_Case_Description': $('#Typical_Case_Description').val(),
        'Frequency_of_Occurence_Without_Control_two': $('#Frequency_of_Occurence_Without_Control_two').val(),
        'Frequency_of_Occurence_With_Control': $('#Frequency_of_Occurence_With_Control').val(),
        'Typical_Case_Likelihood': $('#Typical_Case_Likelihood').val(),

        'Typical_Case_Financial_Exposure': $('#Typical_Case_Financial_Exposure').val(),
        'Net_Risk_Reduction_Benifit' :$('#Net_Risk_Reduction_Benifit').val(),
                'assetDrop' :$('#assetDrop').val(),
        'asset_groups' :$('#asset_groups').val(),




    }
    return modalDetails;
    alert(modalDetails);
}

function getScoringDetailsFromPlan(data) {   

    var scoreDetails = {
        'action': 'score',
        'riskId': data,
        'riskScore': $('#riskScore').val(),

         //ClassicScoring 
        'likelihood': $('#likelihood').val(),
        'impact': $('#impact').val(),

        // Cvss Scoring
        'attackvector': $('#attackvector').val(),
        'attackcomplexity': $('#attackcomplexity').val(),
        'authentication': $('#authentication').val(),
        'confidentialityimpact': $('#confidentialityimpact').val(),
        'integrityimpact': $('#integrityimpact').val(),
        'availabilityimpact': $('#availabilityimpact').val(),
        'exploitability': $('#exploitability').val(),
        'remediationlevel': $('#remediationlevel').val(),
        'reportconfidence': $('#reportconfidence').val(),
        'collateraldamagepotential': $('#collateraldamagepotential').val(),
        'targetdistribution': $('#targetdistribution').val(),
        'confidentialityrequirement': $('#confidentialityrequirement').val(),
        'integrityrequirement': $('#integrityrequirement').val(),
        'availabilityrequirement': $('#availabilityrequirement').val(), 

        // DREAD Scoring
        'damagepotential': $('#damagepotential').val(),
        'reproducibility': $('#reproducibility').val(),
        'dredexploitability': $('#dredexploitability').val(),
        'affectedusers': $('#affectedusers').val(),
        'discoverability': $('#discoverability').val(),

        // OWASP Scoring
        'skilllevel': $('#skilllevel').val(),
        'motive': $('#motive').val(),
        'opportunity': $('#opportunity').val(),
        'size': $('#size').val(),
        'easeofdiscovery': $('#easeofdiscovery').val(),
        'easeofexploit': $('#easeofexploit').val(),
        'awareness': $('#awareness').val(),
        'intrusiondetection': $('#intrusiondetection').val(),
        'lossofconfidentiality': $('#lossofconfidentiality').val(),
        'lossofintegrity': $('#lossofintegrity').val(),
        'lossofavailability': $('#lossofavailability').val(),
        'lossofaccountability': $('#lossofaccountability').val(),
        'financialdamage': $('#financialdamage').val(),
        'reputationdamage': $('#reputationdamage').val(),
        'noncompliance': $('#noncompliance').val(),
        'privacyviolation': $('#privacyviolation').val(),

        // Custom Scoring
        'customvalue': $('#customvalue').val(),
        //Asset based scoring
       'asset_value_from_asset':$("#asset_value_from_asset").val(),
              'Assetlikelihood':$("#Assetlikelihood").val(),

       'Vulnerability':$("#Vulnerability").val(),
       'threat':$("#threat").val(),

         
    }
    return scoreDetails;
}

function saveRiskPlan() {   

    var modalDetails = getModalDetailsFromPlan();
    if(modalDetails.riskSubject==""||modalDetails.category=="--Select Category--"||modalDetails.location=="--Select Location--"||modalDetails.regulation=="--Select Regulation--"||modalDetails.controlNumber==""||modalDetails.affectedAssets==" "||modalDetails.technology=="--Select Technology--"||modalDetails.team=="--Select Team--"||modalDetails.additionalStakeHolder=="--Select StakeHolders--"||modalDetails.riskSource=="--Select Risk Source--"||modalDetails.riskOwner=="--Select Risk Owner--"||modalDetails.riskMitigator=="--Select Risk Mitigator--"||modalDetails.riskReviewer=="--Select Risk Reviewer--"||modalDetails.riskScore=="--Select Risk Score--"||modalDetails.category=="--Select Risk Assessment--"||modalDetails.riskAssessment==""||modalDetails.additionalNotes==""){
        swal({ 
           title:  'Please Fill all the form fields',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        });
    }
   else
{    
    
     $.ajax({
         type: "POST",
         url: "/freshgrc/php/risk/manageRisk.php",
         data: modalDetails,
         success: saveScoring
    });    
}
}
function saveScoring(data){    
    var scoreDetails = getScoringDetailsFromPlan(data);
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/risk/manageRisk.php",
        data: scoreDetails        
    }).done(function (data) {
      window.location = "/freshgrc/view/risk/riskAdmin.php";
    });
}

function getScoringMethods(){    
    var scoringDetails =  $('#riskScore').val();
    switch (scoringDetails) { 
    case "1": 
        $('#classicScoring').modal('show');
        break;
    case "2": 
        $('#cvssScoring').modal('show');
        break;
    case "3": 
        $('#dreadScoring').modal('show');
        break;      
    case "4": 
        $('#owaspScoring').modal('show');
        break;
    case "5": 
        $('#customScoring').modal('show');
        break;
    case "6":
         $('#assetscoring').modal('show');
    break;
    default:
        alert('Please Select Scoring!');
}

}



function getMitigationDetails(riskId) 
{      
  
    var action = "mitigation";    
    var mitigationDetails = {
        'loggedInUser': $('#loggedInUser').val(),
        'action': action,
        'risk_id': riskId,
        'planning_date': $('#PlannedMitigationDate').val(),
        'planning_strategy': $('#PlanningStrategy').val(),
        'mitigation_effort': $('#MitigationEffort').val(),
        'mitigation_cost': $('#MitigationCost').val(),
        'mitigation_owner': $('#MitigationOwner').val(),
        'mitigation_team': $('#MitigationTeam').val(),
        'mitigation_percent': $('#MitigationPercent').val(),
        'current_solution': $('#CurrentSolution').val(),
        'security_requirements': $('#SecurityRequirements').val(),
        'security_recommendations': $('#SecurityRecommendations').val(),
        'scenarioMitigation':$('#scenarioMitigation').val(),
        'Safeguard': $('#Safeguard').val(),
        'Exposure_Asset_After_Safeguard': $('#Exposure_Asset_After_Safeguard').val(),
        'Anulaized_Rate_Of_Ocurance_After_Safeguard': $('#Anulaized_Rate_Of_Ocurance_After_Safeguard').val(),
        'Single_Loss_Expectancy_After_Safeguard': $('#Single_Loss_Expectancy_After_Safeguard').val(),
        'Anualized_Loss_Expection_After_Safeguard': $('#Anualized_Loss_Expection_After_Safeguard').val(),
        'Frequency_of_Occurence_Without_Control': $('#Frequency_of_Occurence_Without_Control').val(),
        'Net_Risk_Reduction_Benifit' :$('#Net_Risk_Reduction_Benifit').val(),
        'Residual_risk':$('#mitigation_revi').val(),

  }
    return mitigationDetails;
}

function saveRiskMitigation(riskId) {    
    var mitigationDetails = getMitigationDetails(riskId);
     if(mitigationDetails.planning_date==""||mitigationDetails.planning_strategy=="--Select Planning Strategy--"||mitigationDetails.mitigation_effort=="--Select Mitigation Effort--"||mitigationDetails.mitigation_team=="--Select Mitigation Team--"||mitigationDetails.mitigation_percent==" "||mitigationDetails.current_solution==" "||mitigationDetails.security_requirements==" "||mitigationDetails.mitigation_cost=="--Select Mitigation Cost--"||mitigationDetails.mitigation_owner=="--Select Mitigation Owner--"||mitigationDetails.security_recommendations==" "){
        swal({ 
           title:  'Please Fill all the form fields',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        });
    }
   else
{ 
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/risk/manageRiskMitigation.php",
        data: mitigationDetails,
        success: function(){
             window.location = "/freshgrc/view/risk/riskcreatedlist.php";
        }
    });    
}
}
function rejectRisk(riskId,action) {    
    var mitigationDetails ={'action':action,'id':riskId};
  
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/risk/manageRiskMitigation.php",
        data: mitigationDetails,
        success: function(){
            window.location = "/freshgrc/view/risk/riskcreatedlist.php";
        }
    });    

}
function getModalDetailsFromReview(riskId) {     
var action = "review";
     
    var ReviewDetails = {
        'action': action,
        'risk_id': riskId,
        'reviewer': $('#loggedInUser').val(),
        'review': $('#review').val(),
        'next_step': $('#nextstep').val(),
        'comments': $('#comments').val(),
        'next_review': $('#next_review').val(),      

    }
    return ReviewDetails;
}

function saveRiskReview(riskId) {  
    var ReviewDetails = getModalDetailsFromReview(riskId);
    if(ReviewDetails.review=="--Select Review--"||ReviewDetails.next_step=="--Select Next Step--"||ReviewDetails.comments==" "){
        swal({ 
           title:  'Please Fill all the form fields',
           confirmButtonColor: '#3085d6',
           confirmButtonText:'ok'
        });
    }
   else
{ 
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/risk/manageRiskReview.php",
        data: ReviewDetails        
    }).done(function () {
        window.location = "/freshgrc/view/risk/riskmitigatedlist.php";
    });    
}
}

function showScoreDetails() {    
         document.getElementById("scoredetails").style.display = "inline";
         document.getElementById("hide").style.display = "inline";
         document.getElementById("show").style.display = "none";
    }

    function hideScoreDetails() {
        document.getElementById("scoredetails").style.display = "none";
        document.getElementById("hide").style.display = "none";
        document.getElementById("show").style.display = "inline";
    }

    function showScoreOverTimeChart(riskId){        
         $.ajax({
            type: "POST",
            url: "/freshgrc/php/risk/getriskScore.php",
            data: {'riskid': riskId},
            success: function(data){                
                var data = JSON.parse(data);
                var score = [];
                var score = [data[0].calculated_risk];
                document.getElementById("hidescoreovertime").style.display = "inline";
         document.getElementById("showscoreovertime").style.display = "none";

         $('.score-overtime-container').show(); 

         Highcharts.chart('socre-overtime-chart', {

        title: {
          text: 'Risk Scoring History'
        },   

        yAxis: {
            title: {
                text: 'Risk Score'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 2018
            }
        },

        series: [{
            name: 'Risk Score',
            data: score
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
            }
        }); 

         

        
        
    }

      function hideScoreOverTimeChart(){         
        document.getElementById("hidescoreovertime").style.display = "none";
        document.getElementById("showscoreovertime").style.display = "inline"; 
        $('.score-overtime-container').hide();          
    }




    function SingleLossExpectancyBeforeSafeguard()
     {
        var a = document.getElementById('Exposure_Asset_Before_Safeguard').value;
        var b = document.getElementById('Asset_Value_Before_Safeguard').value;
        
        var c = ((a*b)/100).toFixed(2);
        document.getElementById("Single_Loss_Expectancy_Before_Safeguard").value = c;
     }
        
        
  function AnulaizedlossExpectionPrior()
    {
        var d = document.getElementById('Anulaized_Rate_Of_Ocurance_Before_Safeguard').value;
        var k = document.getElementById('Single_Loss_Expectancy_Before_Safeguard').value; 
        var f= (d * k).toFixed(2);
        document.getElementById("Anualized_Loss_Expection_Before_Safeguard").value = f;
    }
        
  function SingleLossExpectancy()
    {
        var g = document.getElementById('Asset_Value_Before_Safeguard').value;
        var n = document.getElementById('Exposure_Asset_After_Safeguard').value;
        var i = ((g/100)*n).toFixed(2);
        document.getElementById("Single_Loss_Expectancy_After_Safeguard").value = i;
    }
          

    function AnualizedLossExpectionpost()
    {
        var p = document.getElementById('Anulaized_Rate_Of_Ocurance_After_Safeguard').value;
         var q = document.getElementById('Single_Loss_Expectancy_After_Safeguard').value;
         var x = (p*q).toFixed(2);
         document.getElementById("Anualized_Loss_Expection_After_Safeguard").value = x;
 

    }

    function NetRiskReductionBenifit()
    {
        var w = document.getElementById('Anualized_Loss_Expection_Before_Safeguard').value;
         var y = document.getElementById('Anualized_Loss_Expection_After_Safeguard').value;
        var e = parseInt(document.getElementById('Safeguard').value);
        var m=((w-y)-e).toFixed(2)
         document.getElementById("Net_Risk_Reduction_Benifit").value = m;


    }

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

    function quanti(){
        
        if($('#model').val()==1){
        $('#Qualitative_model').modal('show');
    }
       if($('#model').val()==2){
        $('#Quantitative_model').modal('show');
    }
}
   function getSubCategory(){
        var modalDetails= {'id':$('#category').val()};
         $.ajax({
        type: "POST",
        url: "/freshgrc/view/risk/riskSubCategory.php",
        data: modalDetails,
        success:function(data){
            $('#subCategoryDrop').html(data);
        
        }
    });
    }
   function getAssetvalue(){
    
        var modalDetails= {'asset':$('#assetDrop').val()};
         $.ajax({
        type: "POST",
        url: "/freshgrc/view/common/assetsDropDown.php",
        data: modalDetails,
        success:function(data){
        $('#assetId').html(data);
        
        }
    });
    }


 function getAssetValuefromAsset(){
    
        var modalDetails= {'id':$('#asset_groups').val()};
         $.ajax({
        type: "POST",
        url: "/freshgrc/php/risk/Assetvalue.php",
        data: modalDetails,
        success:function(data){
        $('#asset_value_from_asset').val(data);
        
        }
    });
    }

    function quanti(){
        
        if($('#model').val()==1){
        $('#Qualitative_model').modal('show');
    }
       if($('#model').val()==2){
        $('#Quantitative_model').modal('show');
    }
}
function planing_mitigate()
{
  if($('#PlanningStrategy').val()==3){
    $('#Aftersafecard').modal('show');
    }
}

function mitigation_reviwer()
{
var mitigated=$("#MitigationPercent").val();
 var impact=$("#impact").val();
var likelihood=$("#likelihood").val();
 var n = (likelihood*(1-mitigated/100))*(impact * (1-mitigated/100));
     var Residual_risk= n.toFixed(2);
     $("#mitigation_revi").val(Residual_risk);
}


function importRiskCsv(){

    $('#riskCsv').click();
    var myFormData = new FormData();
    myFormData.append('riskCsv', riskCsv.files[0]);
    myFormData.append('location', $('#location').val());
    myFormData.append('category', $('#category').val());
    myFormData.append('subCategory', $('#subCategory').val());
    myFormData.append('regulation', $('#regulation').val());
    myFormData.append('controls', $('#controls').val());
    myFormData.append('company', $('#company').val());
    myFormData.append('riskOwner', $('#riskOwner').val());
    myFormData.append('riskMitigator', $('#riskMitigator').val());
    myFormData.append('riskReviewer', $('#riskReviewer').val());
    myFormData.append('loggedInUser', $('#loggedInUser').val());
    $.ajax({
        url: "/freshgrc/php/risk/importRisks.php",
        type: "POST",
        processData: false, // important
        contentType: false, // important
        data: myFormData,
        /*success: function (data) {
            swal({
              title: "Plan Created",
              text: "Your Plan Has Been Created",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              setTimeout(function () {
                // window.location="/freshgrc/view/audit/auditCreateAdmin.php";
              }, 2000);
            });
            
        },*/
        //error: function () {}
    });  
}
function editRiskPlan(isUpdate) {
    $('#myModal').modal('show');
    if (isUpdate) {
        prepareModalForUpdate();
    } else {
        $('#action').val('create');
    }
}

function prepareModalForUpdate() {
    
    var selectedUser = table.rows('.selected').data();
    $('#subject').val(selectedUser[0][2]);
    $('#id').val(selectedUser[0][0]);
    $('#updaterisk').text('Update');
    $('#action').val('update');

} 

function getRiskDetailsFromModal() {
    
    var userDetails = {
        'id': $('#id').val(),
        'subject': $('#subject').val(),
        'action' : $('#action').val(),
    }
    console.log(userDetails);
    return userDetails;
}

function manageRisk() {
    if($('#action').val()=='update')
    {
    var userDetails = getRiskDetailsFromModal();
    $.ajax({
        type: "POST",
        url: "/freshgrc/php/risk/edit_risk.php",
        data: userDetails,
    });
    location.reload();
}
}