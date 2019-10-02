<?php
require_once __DIR__.'/../common/delimitedFileReader.php';
require_once __DIR__.'/clauseManager.php';
require_once __DIR__.'/complianceManager.php';

function importCompliance(){
    $uploadedCsvFile = uploadFile();
    $csvFileName = $_FILES['complianceCsv']['name'];
        chmod($uploadedCsvFile,0777);
    error_log('The read file : '.$uploadedCsvFile);
    if ($uploadedCsvFile != null){
        $allClausesCsvData = DelimitedFileReader::readFile($uploadedCsvFile, true, 2);
        error_log('The data : '.print_r($allClausesCsvData, true));
        $loggedInUser = $_POST['loggedInUser'];
        $complianceManager = new ComplianceManager();
        $complianceId = $complianceManager->importDataFromCsv($allClausesCsvData, $loggedInUser, $csvFileName);
        $clauseManager = new ClauseManager();
        $clauseManager->importDataFromCsv($allClausesCsvData, $complianceId, $loggedInUser);
        // After successful upload rename the file with the created compliance id and 
        // move the same to the success folder
        rename($uploadedCsvFile, "../../uploadedFiles/compliance/success/".$complianceId."_".$csvFileName);
    }
}

function uploadFile(){
    if(is_array($_FILES)) {
        if(is_uploaded_file($_FILES['complianceCsv']['tmp_name'])) {
            $sourcePath = $_FILES['complianceCsv']['tmp_name'];
            $targetPath = "../../uploadedFiles/compliance/".$_FILES['complianceCsv']['name'];
            if(move_uploaded_file($sourcePath,$targetPath)) {
                return $targetPath;
            }
        }
    }    
}

importCompliance();
