<?php

require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/dbOperations.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/workflowManager.php';
require_once __DIR__.'/auditClauseManager.php';
require_once __DIR__.'/../common/cronJobEscalationMail.php';

class AuditManager {
    
    public function getAllAudits($userId, $userRole){
        switch ($userRole){
            case 'auditor' :
                $auditRecords = $this->getAllAuditsForAuditor($userId);
                break;
            case 'auditee' :
                $auditRecords = $this->getAllAuditsForAuditee($userId);
                break;
            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getAllAvlAudits();
                break;
        }
        return $auditRecords;
    }

    
    private function getAllAvlAudits(){
        $sql = 'SELECT a.id as auditId,a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, c.name as companyName, a.status as status, compl.id as complianceId  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and parent_audit=0 ORDER BY auditId DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    
    private function getAllAuditsForAuditor($userId){
        $sql = 'SELECT a.id as auditId,a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, c.name as companyName, a.status as status, compl.id as complianceId  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and parent_audit=0 ORDER BY auditId DESC';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
    
    private function getAllAuditsForAuditee($userId){
        $sql = 'SELECT a.id as auditId,a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, c.name as companyName, a.status as status, compl.id as complianceId  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and parent_audit=0 ORDER BY auditId DESC';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }    
      public function getallduelist($userId, $userRole){
        switch ($userRole){
            case 'auditor' :
                $auditRecords = $this->getallduelistauditor($userId);
                break;
            case 'auditee' :
                $auditRecords = $this->getallduelistauditee($userId);
                break;
            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getallduelistauditor();
                break;
        }
        return $auditRecords;
    }


      
  private function getallduelistauditor($userId){
        $sql = 'SELECT a.id as auditId,a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,a.start_date as Start_Date,a.end_date as End_Date, c.name as companyName, a.status as status, compl.id as complianceId  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and a.start_date<CURDATE() and a.status!="published" and a.status!="approved" and a.status!="returned" and a.status!="prepared" and a.status!="approval pending" and parent_audit=0';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }
         
  private function getallduelistauditee($userId){
        $sql = 'SELECT a.id as auditId,a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,a.start_date as Start_Date,a.end_date as End_Date, c.name as companyName, a.status as status, compl.id as complianceId  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and a.status!="published" and a.status!="approved" and a.status!="create" and a.status!="approval pending" and a.status!="performed" and parent_audit=0';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);        
    }



public function getAllAuditsForPublish($userId, $userRole){
        switch ($userRole){
            case 'auditor' :
                $auditRecords = $this->getAllAuditsForAuditorForPublish($userId);
                break;
            case 'auditee' :
                $auditRecords = $this->getAllAuditsForAuditeeForPublish($userId);
                break;
            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getAllAvlAuditsForPublish();
                break;
        }
        return $auditRecords;
    }


    private function getAllAvlAuditsForPublish(){
        $sql = 'SELECT a.id as auditId,a.created_date as date,  concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditor,u.id)>0 or INSTR(a.auditor,7)>0 ) and (a.status="published" or a.status="approved") and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()))) and u.id=8 ORDER BY a.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    
    
       private function getAllAuditsForAuditorForPublish($userId){
        $sql = 'SELECT a.id as auditId,a.created_date as date,  concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditor,u.id)>0 or INSTR(a.auditor,7)>0 ) and (a.status="published" or a.status="approved") and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()))) and u.id=8 ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }
    
    private function getAllAuditsForAuditeeForPublish($userId){
        $sql = 'SELECT  a.id as auditId,a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditee,u.id)>0 or INSTR(a.auditee,7)>0 ) and (a.status="approved" or a.status="published") and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()))) and u.id=8 ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);         
    }
    public function getalldelaylist($userId, $userRole){
        switch ($userRole){
            case 'auditor' :
                $auditRecords = $this->getalldelaylistauditor($userId);
                break;
            case 'auditee' :
                $auditRecords = $this->getalldelaylistauditee($userId);
                break;
            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getalldelaylistauditor();
                break;
        }
        return $auditRecords;
    }

 
      private function getalldelaylistauditor($userId){
        $sql = 'SELECT a.id as auditId,a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,a.start_date as Start_Date,a.end_date as End_Date, c.name as companyName, a.status as status, compl.id as complianceId  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and a.end_date>CURDATE() and a.status!="published" and a.status!="approved" and a.status!="returned" and a.status!="prepared" and a.status!="approval pending" and parent_audit=0';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }   
    
      private function getalldelaylistauditee($userId){
        $sql = 'SELECT a.id as auditId,a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,a.start_date as Start_Date,a.end_date as End_Date, c.name as companyName, a.status as status, compl.id as complianceId  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and a.end_date>CURDATE() and a.status!="published" and a.status!="approved" and a.status!="create" and a.status!="approval pending" and a.status!="performed" and parent_audit=0';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }   
    
    public function getAllAuditsForCreate($userId, $userRole){
        switch ($userRole){
            case 'auditor' :
                $auditRecords = $this->getAllAuditsForAuditorForCreate($userId);
                break;
            case 'auditee' :
                $auditRecords = $this->getAllAuditsForAuditeeForCreate($userId);
                break;
            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getAllAvlAuditsForCreate();
                break;
        }
        return $auditRecords;
    }

    private function getAllAvlAuditsForCreate(){
        $sql = 'SELECT a.id as auditId, a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (a.auditor = u.id or a.auditor=",")  and a.status="create" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()))) ORDER BY a.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    
    
    private function getAllAuditsForAuditorForCreate($userId){
        $sql = 'SELECT a.id as auditId, a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,a.start_date as Start_Date,a.end_date as End_Date, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditor,u.id)>0 or INSTR(a.auditor,?)>0 ) and a.status="create" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()) or a.parent_audit=0)) and u.id=a.created_by and u.id=? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }
    
    private function getAllAuditsForAuditeeForCreate($userId){
        $sql = 'SELECT a.id as auditId, a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditee,u.id)>0 or INSTR(a.auditee,?)>0 ) and a.status="create" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()) or a.parent_audit=0)) and u.id=? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }
    public function getAllAuditsForPrepared($userId, $userRole){
        switch ($userRole){
            case 'auditor' :
                $auditRecords = $this->getAllAuditsForAuditorForPrepared($userId);
                break;
            case 'auditee' :
                $auditRecords = $this->getAllAuditsForAuditeeForPrepared($userId);
                break;
            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getAllAvlAuditsForPrepared();
                break;
        }
        return $auditRecords;
    } 

    private function getAllAvlAuditsForPrepared(){
        $sql = 'SELECT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId,a.created_date as date from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id  and (a.status="prepared") and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()) or a.parent_audit=0)   ORDER BY a.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    
    private function getAllAuditsForAuditorForPrepared($userId){
        $sql = 'SELECT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditor,u.id)>0 or INSTR(a.auditor,?)>0 ) and a.status="prepared" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()) or a.parent_audit=0 )) and u.id=? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }
    
    private function getAllAuditsForAuditeeForPrepared($userId){
        $sql = 'SELECT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,a.created_date as date,a.start_date as Start_Date,a.end_date as End_Date, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditee,u.id)>0 or INSTR(a.auditee,?)>0 ) and a.status="prepared" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()) or a.parent_audit=0)) and u.id=? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }
    public function getAllAuditsForPerformed($userId, $userRole){
        switch ($userRole){
            case 'auditor' :
                $auditRecords = $this->getAllAuditsForAuditorForPerformed($userId);
                break;
            case 'auditee' :
                $auditRecords = $this->getAllAuditsForAuditeeForPerformed($userId);
                break;
            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getAllAvlAuditsForPerformed();
                break;
        }
        return $auditRecords;
    }

    private function getAllAvlAuditsForPerformed(){
        $sql = 'SELECT  a.id as auditId, a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id  and (a.status="performed") and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()) or a.parent_audit=0) ORDER BY a.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    
    private function getAllAuditsForAuditorForPerformed($userId){
        $sql = 'SELECT a.id as auditId, a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,a.start_date as Start_Date,a.end_date as End_Date,c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditor,u.id)>0 or INSTR(a.auditor,?)>0 ) and a.status="performed" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()) or a.parent_audit=0)) and u.id=? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }
    
    private function getAllAuditsForAuditeeForPerformed($userId){
        $sql = 'SELECT a.id as auditId, a.created_date as date, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditee,u.id)>0 or INSTR(a.auditee,?)>0 ) and a.status="performed" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()) or a.parent_audit=0)) and u.id=? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }
     public function getAllAuditsForReturned($userId, $userRole){
        switch ($userRole){
            case 'auditor' :
                $auditRecords = $this->getAllAuditsForAuditorForReturned($userId);
                break;
            case 'auditee' :
                $auditRecords = $this->getAllAuditsForAuditeeForReturned($userId);
                break;
            default:
                // This is for grc admin and any other admin.
                $auditRecords = $this->getAllAvlAuditsForReturned();
                break;
        }
        return $auditRecords;
    }
    
    //escalation mail starts fopr priority and severity 
    
    public function getAllAuditsforEscalation($comp)
    {
        $sql = 'SELECT a.id as id, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, a.auditor as auditor, a.auditee as auditee, a.priority_mail as priority_mail,a.severity_mail as severity_mail,a.end_date as end_date FROM audit a WHERE (a.status != "published" or a.status!="approved") AND a.company_id =? AND a.end_date<CURDATE() ORDER BY `id` DESC';     
        $paramArray = array();
        $paramArray[] = $comp;
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);
    }

    public function getvalueofMail()
    {
        $sql = 'SELECT m.company_id as company, m.mailperweekpriority as mailmaximumpriority, m.mailperweekseverity as mailmaximumseverity, m.updated_by as admin,m.mailperweekprioritymed as mailmaximumprioritymed, m.mailperweekseveritymed as mailmaximumseveritymed,m.mailperweekpriorityhigh as mailmaximumpriorityhigh, m.mailperweekseverityhigh as mailmaximumseverityhigh FROM mail m';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }

    public function incrementPrioritymail($mailIncrementer,$id){
        $sql = 'UPDATE `audit_clauses` SET `mailperweekpriority` = ? WHERE id=?';
        $paramArray = array();
        $paramArray[] = $mailIncrementer; 
        $paramArray[] = $id;     
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'ii', $paramArray); 
    }
    public function incrementPriorityMailMed($mailIncrementer,$id){
        $sql = 'UPDATE `audit_clauses` SET `mailperweekprioritymed` = ? WHERE id=?';
        $paramArray = array();
        $paramArray[] = $mailIncrementer; 
        $paramArray[] = $id;     
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'ii', $paramArray); 
    }

    public function incrementPriorityMailHigh($mailIncrementer,$id){
        $sql = 'UPDATE `audit_clauses` SET `mailperweekpriorityhigh` = ? WHERE id=?';
        $paramArray = array();
        $paramArray[] = $mailIncrementer;  
        $paramArray[] = $id;   
        $dbOps = new DBOperations();
        error_log("counter".print_r($id,true));
        error_log("mail increment".print_r($mailIncrementer,true));
        return $dbOps->cudData($sql, 'ii', $paramArray); 
    }

    public function incrementSeveritymail($mailIncrementer,$id){
        $sql = 'UPDATE `audit_clauses` SET `mailperweekseverity` = ? WHERE id=?';
        $paramArray = array();
        $paramArray[] = $mailIncrementer;     
        $paramArray[] = $id;
        $dbOps = new DBOperations();
        error_log("mail incerementer sev".print_r($paramArray,true));
        return $dbOps->cudData($sql, 'ii', $paramArray);  
    }
    public function incrementSeverityMailMed($mailIncrementer,$id){
        $sql = 'UPDATE `audit_clauses` SET `mailperweekseveritymed` = ? WHERE id=?';
        $paramArray = array();
        $paramArray[] = $mailIncrementer;     
        $paramArray[] = $id;
        $dbOps = new DBOperations();
        return $dbOps->cudData($sql, 'ii', $paramArray);  
    }
    public function incrementSeverityMailHigh($mailIncrementer,$id){
        $sql = 'UPDATE `audit_clauses` SET `mailperweekseverityhigh` = ? WHERE id=?';
        $paramArray = array();
        $paramArray[] = $mailIncrementer;     
        $paramArray[] = $id;
        $dbOps = new DBOperations();
         error_log("counter severity".print_r($id,true));
        error_log("mail increment severity".print_r($mailIncrementer,true));
        return $dbOps->cudData($sql, 'ii', $paramArray);  
    }

    //escalation mail ends for priority and severity

    private function getAllAvlAuditsForReturned(){
        $sql = 'SELECT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId,a.created_date as date from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id  and (a.status="returned") and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW())) ORDER BY a.id DESC';     
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);        
    }    
    
    private function getAllAuditsForAuditorForReturned($userId){
        $sql = 'SELECT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditor,u.id)>0 or INSTR(a.auditor,?)>0 ) and a.status="returned" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()))) and u.id=? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }
    
    private function getAllAuditsForAuditeeForReturned($userId){
        $sql = 'SELECT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type,a.start_date as Start_Date,a.end_date as End_Date, u.last_name as auditorName, c.name as companyName, a.status as status, compl.id as complianceId from audit a, company c, compliance compl, user u where (a.company_id = c.id and a.compliance_id = compl.id and (INSTR(a.auditee,u.id)>0 or INSTR(a.auditee,?)>0 ) and a.status="returned" and (a.audit_freq="once" or DATE(a.start_date)<=DATE(NOW()))) and u.id=? ORDER BY a.id DESC';
        $paramArray = array();
        $paramArray[] =",".$userId;
         $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'si', $paramArray);        
    }  
    public function getAuditDetails($auditId){
        $sql = 'SELECT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title,compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, a.auditee as auditee, a.compliance_id as complianceId, d.name as deptname, l.name as lname, compl.version as version FROM audit a,bu_deparment d,bu_location l,user u,compliance compl,company c where a.compliance_id=compl.id and a.company_id=c.id and a.auditor = u.id and a.department_id=d.id and a.location_id=l.id and a.id=?'; 
        $paramArray = array($auditId); 
        $dbOps = new DBOperations();        
        $resultArray = $dbOps->fetchData($sql, 'i', $paramArray);
 
       
        return $resultArray;
    }
    
    public function getMailforid($id)
    {
        $sql = 'SELECT u.email FROM user u WHERE u.id=?'; 
        $paramArray = array($id); 
        $dbOps = new DBOperations();        
        return $dbOps->fetchData($sql, 'i', $paramArray);
    }

    public function create($auditData){
        $sql = 'INSERT INTO audit(title, company_id, compliance_id, audit_type, description, start_date, end_date, auditor, auditee, audit_freq, location_id, department_id,status, created_by,parent_audit) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $auditData->auditTitle;
        $paramArray[] = $auditData->company;
        $paramArray[] = $auditData->compliance;
        $paramArray[] = $auditData->auditType;
        $paramArray[] = $auditData->auditDesc;
        $paramArray[] = $auditData->start_date;
        $paramArray[] = $auditData->end_date; 
        $paramArray[] = $auditData->auditor;
        $paramArray[] = $auditData->auditee;
        $paramArray[] = $auditData->auditFreq;
        $paramArray[] = $auditData->location;
        $paramArray[] = $auditData->department;
        $paramArray[] = 'create';
        $paramArray[] = $auditData->loggedInUser; 
         $paramArray[] = $auditData->parentAudit;           
        $dbOps = new DBOperations();     
        error_log("paramArray inside Manage Audit".print_r($paramArray,true));   
        return $dbOps->cudData($sql, 'sisssssssssssii', $paramArray); 
    }
     public function createChildrenAudit($auditData){
        $sql = 'INSERT INTO audit(title, company_id, compliance_id,audit_type, description, start_date, end_date,auditor, auditee, audit_freq,location_id,department_id,status, created_by,parent_audit) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $auditData->auditTitle;
        $paramArray[] = $auditData->company;
        $paramArray[] = $auditData->compliance;
        $paramArray[] = $auditData->auditType;
        $paramArray[] = $auditData->auditDesc;
        $paramArray[] = $auditData->start_date;
        $paramArray[] = $auditData->end_date; 
        $paramArray[] = $auditData->auditor;
        $paramArray[] = $auditData->auditee;
        $paramArray[] = $auditData->auditFreq;
        $paramArray[] = $auditData->location;
        $paramArray[] = $auditData->department;
        $paramArray[] = 'create';
        $paramArray[] = $auditData->loggedInUser;
        $paramArray[] = $auditData->parentAudit;       
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sisssssssssssii', $paramArray); 
    }
    public function getWorkingDetails($auditId, $userRole){
        $sql = 'SELECT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, compl.name as complianceName, a.audit_type as type, u.last_name as auditorName, c.name as companyName, a.status as status, a.auditee as auditee,a.auditor as auditor, a.compliance_id as complianceId, compl.version as version  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.auditor = u.id and a.id=?'; 
        $paramArray = array($auditId); 
        $dbOps = new DBOperations();        
        $resultArray = $dbOps->fetchData($sql, 'i', $paramArray);
        $auditDetails = $resultArray[0]; 
        $auditDetails['user_role'] = $userRole;
        $this->decideWorkingDetails($auditDetails);
        $this->addAuditClauseDetails($auditDetails);
        $this->addAuditCklDetails($auditDetails);
        return $auditDetails;
    }
    
    private function addAuditCklDetails(&$auditDetails){
        $auditClauseManager = new AuditClauseManager();
        $auditChecklists = $auditClauseManager->getAllAuditChecklists($auditDetails);
        if ($auditChecklists != null){
            $auditDetails['auditChecklists'] = $auditChecklists;
        }        
    }
    
    private function addAuditClauseDetails(&$auditDetails){
        $auditClauseManager = new AuditClauseManager();
        $auditClauses = $auditClauseManager->getAllAuditClauses($auditDetails);
        if ($auditClauses != null){
            $auditDetails['auditClauses'] = $auditClauses;
        }
    }
    
    private function decideWorkingDetails(&$auditDetails){
        $userRole = $auditDetails['user_role'];
        $currentStatus = $auditDetails['status'];
        $workingStatus = WorkflowManager::determineNext('audit','inprogress',$currentStatus);
        $isViewOnly = WorkflowManager::determineVisiblity($userRole, $workingStatus);
        $auditDetails['workingStatus'] = $workingStatus;
        $auditDetails['isViewOnly'] = $isViewOnly;
    }
    
    public function saveStatus($auditData){
        $status = $this->determineWorkflowStatus($auditData);
        $sql = 'UPDATE audit SET status=?, updated_by=?, updated_time=? WHERE id=?';
        $paramArray = array($status, $auditData->loggedInUser, date("Y-m-d h:i:s"), $auditData->auditId); 
        $dbOps = new DBOperations(); 
        error_log("show params".print_r($paramArray,true));       
        return $dbOps->cudData($sql, 'sisi', $paramArray);         
    }
    
    private function determineWorkflowStatus($auditData){
        $isDraft = $auditData->isDraft;
        $nextStatus = $auditData->status;
        if ($isDraft == 'false'){
            $nextStatus = WorkflowManager::determineNext('audit','completed',$nextStatus);
        }
        return $nextStatus;
    }
    
    public function auditDataForCalendar(){
        $sql='SELECT id,title,start_date,end_date,auditor,auditee FROM audit';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    
    public function getAllCompliances($companyId){
        $sql = 'SELECT * from compliance where (status = "published" or status= "analyzed") and company_id=7';
        $dbOps = new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

    public function getAllCompliance($companyId){
        $sql = 'SELECT * from compliance where (status = "published" or status= "in_draft") and company_id=?';
        $dbOps = new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

    public function getAllRegulatory($companyId){
        $sql = 'Select r.id as Id, r.comp_id as Comp_Id, c.name as Compliance_Name, r.status as Status from compliance c, regulatory r where c.id=r.comp_id and (r.status = "in_draft" or c.status= "in_draft") and r.company_id=?';
        $dbOps = new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    
    public function getAllPriorityAuditsForAuditor(){
        $sql = 'SELECT DISTINCT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title,a.start_date as startDate,a.end_date as endDate, a.status as auditstatus, u.last_name as name, u.email as email from audit a, user u, audit_clauses ac WHERE a.status!="published" and a.id=ac.audit_id and ac.priority="high" and a.auditor=u.id';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }

    public function getAllPriorityAuditsForAuditee(){
        $sql = 'SELECT DISTINCT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title,a.start_date as startDate,a.end_date as endDate, a.status as auditstatus,u.last_name as name, u.email as email from audit a, user u, audit_clauses ac WHERE a.status!="published" and a.id=ac.audit_id and ac.priority="high" and a.auditee=u.id';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }

    public function getAllSeverityAuditsForAuditor(){
        $sql = 'SELECT DISTINCT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, a.start_date as startDate , a.status as auditstatus,u.last_name as name, u.email as email from audit a, user u, audit_clauses ac WHERE a.status!="published" and a.id=ac.audit_id and a.auditor=u.id and a.end_date<=NOW()';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }

    public function getAllSeverityAuditsForAuditee(){
        $sql = 'SELECT DISTINCT a.id as auditId, concat(ucase(mid(a.title,1,1)),lcase(mid(a.title,2))) as title, a.start_date as startDate , a.status as auditstatus,u.last_name as name, u.email as email from audit a, user u, audit_clauses ac WHERE a.status!="published" and a.id=ac.audit_id and a.auditee=u.id and a.end_date<=NOW()';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getZip($auditId){

        $sql='SELECT DISTINCT ackl.file_name FROM `audit_checklists` ackl ,audit a WHERE ackl.file_name != " " and ackl.audit_id = a.id and a.id=?';
        $paramArray=array($auditId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function auditornotification()
    {
    $sql="SELECT * FROM audit WHERE parent_audit =0 ORDER BY id DESC";
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyintoseen()
    {
        $sql = "UPDATE `audit` SET notification_status =0 WHERE company_id =7 AND notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyinkickoff()
    {
        $sql = "UPDATE `audit` SET kickoff_notification_status =0 WHERE company_id =7 AND kickoff_notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyinrespond()
    {
        $sql = "UPDATE `audit` SET respond_notification_status =0 WHERE company_id =7 AND respond_notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyinreview()
    {
        $sql = "UPDATE `audit` SET review_notification_status =0 WHERE company_id =7 AND review_notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyinfollowup()
    {
        $sql = "UPDATE `audit` SET followup_notification_status =0 WHERE company_id =7 AND followup_notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }
    public function setnotifyinreports()
    {
        $sql = "UPDATE `audit` SET reports_notification_status =0 WHERE company_id =7 AND reports_notification_status =1";
        $dbOps = new dbOperations();
        return $dbOps->fetchData($sql);
    }
}
