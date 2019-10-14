<?php
require_once __DIR__.'/dbOperations.php';
require_once __DIR__.'/appConfig.php';

class dashboard{
  //--------------------------------------------------------------------------------------------------  
    public function audittype(){
        $sql = 'SELECT audit_type, count(*) AS count FROM audit WHERE audit_type is not null GROUP BY audit_type';
        return $this->fetchDataFromDB($sql);
    }
     public function pendingAudits($companyId){
       $sql=' SELECT ac.status,count(ac.status) AS count FROM audit_checklists ac ,audit a,company c WHERE ac.status!="NULL" and ac.status!="--Select Status--" and ac.audit_id=a.id and a.company_id=c.id and c.id=? GROUP BY ac.status ORDER BY ac.status ASC';
       $dbOps=new DBOperations();
       $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    
    public function status($companyId){
        $sql = 'SELECT a.status, count(*) AS count FROM audit a,company c WHERE c.id=? and a.status is not null GROUP BY status';
         $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
        }
    public function getstatus($id)
    {
    $sql="SELECT a.status,a.title as title,count(*) AS count FROM audit a where a.status=? GROUP BY title";
    $dbOps = new DBOperations();
         $paramArray = array($id);
         $dbOps=new DBOperations();
        return $dbOps->fetchData($sql, 's', $paramArray);
 }


    public function noOfAudits($companyId){
        $sql='SELECT count(*) as count FROM audit a,company c WHERE a.company_id=c.id and c.id=? and parent_audit=0';
        $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
        
    }  
     public function noOfAuditsPublished($companyId){
        $sql='SELECT count(*) as count FROM audit a,company c WHERE a.company_id=c.id and c.id=? and (a.status="published" or a.status="approved")';
        $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
        
    } 
      public function noOfAuditsDue($companyId){
        $sql='SELECT count(*) as count  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and a.start_date<CURDATE() and a.status!="published" and a.status!="approved" and a.status!="returned" and a.status!="prepared" and a.status!="approval pending"';
        $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
        
    } 
     public function noOfAuditsDueauditee($companyId){
        $sql='SELECT count(*) as count  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and a.status!="published" and a.status!="approved" and a.status!="create" and a.status!="approval pending" and a.status!="performed"';
        $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
        
    }     
    public function noOfAuditsDelayed($companyId){
        $sql='SELECT count(*) as count from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and a.end_date>CURDATE() and a.status!="published" and a.status!="approved" and a.status!="returned" and a.status!="prepared" and a.status!="approval pending" and parent_audit=0';
        $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
        
    }   
     public function noOfAuditsDelayedauditee($companyId){
        $sql='SELECT count(*) as count  from audit a, company c, compliance compl, user u where a.company_id = c.id and a.compliance_id = compl.id and a.auditor = u.id and a.end_date>CURDATE() and a.status!="published" and a.status!="approved" and a.status!="create" and a.status!="approval pending" and a.status!="performed" and parent_audit=0';
        $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
        
    }   

    public function compliance($companyId){
        $sql = 'SELECT c.name, count(*) AS count FROM compliance c,company co,audit a WHERE a.compliance_id=c.id and c.company_id=co.id and co.id=? and c.name is not null GROUP BY c.name';
       $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }    
    public function auditRemainderChart($companyId){
        $sql='SELECT ac.priority,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date>=CURDATE() AND a.end_date<=CURDATE()+7) AND ac.audit_id=a.id AND ac.target_date>=CURDATE() AND ac.target_date<=CURDATE()+7 GROUP BY ac.priority';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function auditRemainderChartCompl(){
        $sql='SELECT ac.priority,ac.id,count(*) as count FROM audit_clauses ac,audit a WHERE ac.audit_id=a.id AND ac.audit_status="create"AND (ac.priority="low" OR ac.priority="medium" OR ac.priority="high")GROUP BY ac.priority';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function auditEscalationChart($companyId){
        $sql='SELECT ac.severity,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date<CURDATE()) AND ac.audit_id=a.id AND ac.target_date<CURDATE() GROUP BY ac.severity';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function auditLowList($companyId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date>=CURDATE() AND a.end_date<=CURDATE()+7) AND ac.audit_id=a.id AND ac.target_date>=CURDATE() AND ac.target_date<=CURDATE()+7 AND ac.priority="low" GROUP BY a.id';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function auditLowListCompl($companyId,$complianceId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=?  AND ac.audit_id=a.id  AND ac.priority="low" AND a.compliance_id=? GROUP BY a.id';
        $paramArray=array($companyId,$complianceId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditMedList($companyId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date>=CURDATE() AND a.end_date<=CURDATE()+7) AND ac.audit_id=a.id AND ac.target_date>=CURDATE() AND ac.target_date<=CURDATE()+7 AND ac.priority="medium" GROUP BY a.id';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function auditMedListCompl($companyId,$complianceId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=?  AND ac.audit_id=a.id  AND ac.priority="medium" AND a.compliance_id=? GROUP BY a.id';
        $paramArray=array($companyId,$complianceId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditHighList($companyId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date>=CURDATE() AND a.end_date<=CURDATE()+7) AND ac.audit_id=a.id AND ac.target_date>=CURDATE() AND ac.target_date<=CURDATE()+7 AND ac.priority="high" GROUP BY a.id';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function auditHighListCompl($companyId,$complianceId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=?  AND ac.audit_id=a.id AND  ac.priority="high" AND a.compliance_id=? GROUP BY a.id';
        $paramArray=array($companyId,$complianceId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditLowListSev($companyId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date<CURDATE()) AND ac.audit_id=a.id AND  ac.target_date<CURDATE() AND ac.severity="low" GROUP BY a.id';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function auditMedListSev($companyId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date<CURDATE()) AND ac.audit_id=a.id AND  ac.target_date<CURDATE() AND ac.severity="medium" GROUP BY a.id';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function auditHighListSev($companyId){
        $sql='SELECT a.id as id,a.title as title,count(*) as count FROM audit a,audit_clauses ac WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date<CURDATE()) AND ac.audit_id=a.id AND  ac.target_date<CURDATE() AND ac.severity="high" GROUP BY a.id';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

    public function auditHighListClause($companyId,$auditId){
        $sql='SELECT c.numbering as name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date>=CURDATE() AND a.end_date<=CURDATE()+7) AND ac.audit_id=a.id AND ac.target_date>=CURDATE() AND ac.target_date<=CURDATE()+7 AND ac.clause_id=c.id AND ac.priority="high" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditHighListClauseCompl($companyId,$auditId){
        $sql='SELECT c.numbering as name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=?  AND ac.audit_id=a.id AND ac.clause_id=c.id AND ac.priority="high" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditLowListClause($companyId,$auditId){
        $sql='SELECT c.numbering as name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date>=CURDATE() AND a.end_date<=CURDATE()+7) AND ac.audit_id=a.id AND ac.target_date>=CURDATE() AND ac.target_date<=CURDATE()+7 AND ac.clause_id=c.id AND ac.priority="low" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditLowListClauseCompl($companyId,$auditId){
        $sql='SELECT c.numbering as name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=?  AND ac.audit_id=a.id  AND ac.clause_id=c.id AND ac.priority="low" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditMedListClause($companyId,$auditId){
        $sql='SELECT c.numbering as name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date>=CURDATE() AND a.end_date<=CURDATE()+7) AND ac.audit_id=a.id AND ac.target_date>=CURDATE() AND ac.target_date<=CURDATE()+7 AND ac.clause_id=c.id AND ac.priority="medium" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditMedListClauseCompl($companyId,$auditId){
        $sql='SELECT c.numbering as name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=?  AND ac.audit_id=a.id  AND ac.clause_id=c.id AND ac.priority="medium" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditHighListClauseSev($companyId,$auditId){
        $sql='SELECT c.name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date<CURDATE()) AND ac.audit_id=a.id AND ac.target_date<CURDATE()  AND ac.clause_id=c.id AND ac.severity="high" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditLowListClauseSev($companyId,$auditId){
        $sql='SELECT c.name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date<CURDATE()) AND ac.audit_id=a.id AND ac.target_date<CURDATE()  AND ac.clause_id=c.id AND ac.severity="low" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }
    public function auditMedListClauseSev($companyId,$auditId){
        $sql='SELECT c.name FROM audit a,audit_clauses ac,compliance_clause c WHERE (a.status != "published" or a.status!="approved") AND a.company_id=? AND (a.end_date<CURDATE()) AND ac.audit_id=a.id AND ac.target_date<CURDATE()  AND ac.clause_id=c.id AND ac.severity="medium" AND a.id=? ORDER BY a.id DESC';
        $paramArray=array($companyId,$auditId);
        error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'ii',$paramArray);
    }

    
      public function frequency($companyId){
          $sql = 'SELECT a.audit_freq,count(*) AS count FROM audit a ,company c WHERE c.id=a.company_id and c.id=? and a.audit_freq is not null GROUP BY a.audit_freq';
          $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

public function getfrequency($id)
{
    $sql="SELECT a.audit_freq,a.title as title,count(*) AS count FROM audit a where a.audit_freq=? GROUP BY title"; 
    $dbOps = new DBOperations();
        $paramArray = array($id);
         $dbOps=new DBOperations();
        return $dbOps->fetchData($sql, 's', $paramArray);
}
    public function barchart(){
        $sql='SELECT ac.status,count(ac.status) AS count,c.name FROM audit_clauses ac ,compliance_clause cc,compliance c WHERE ac.status!="NULL" and ac.status!="--Select Status--" and(ac.clause_id=cc.id and cc.compliance_id=c.id) GROUP BY ac.status,c.name ORDER BY c.name ASC,ac.status ASC';
               return $this->fetchDataFromDB($sql);
    }
    public function barChartForControls(){
        $sql='SELECT ac.status,count(ac.status) AS count,c.name FROM audit_checklists ac ,audit a,compliance c WHERE ac.status!="NULL" and ac.status!="--Select Status--" and(ac.audit_id=a.id and a.compliance_id=c.id) GROUP BY ac.status,c.name ORDER BY c.name ASC,ac.status ASC';
               return $this->fetchDataFromDB($sql);
    }

     public function companyAudit(){
        $sql = 'SELECT audit.company_id, company.name, audit.title ,audit.status FROM audit LEFT JOIN company ON audit.company_id=company.id';
        return $this->fetchDataFromDB($sql);
    }

    public function auditDate(){
        $sql = 'SELECT audit.start_date,audit.end_date,audit.status FROM audit';
        return $this->fetchDataFromDB($sql);
    }
     public function auditcheckliststatus(){
        $sql = 'SELECT audit.status,audit_checklist.status count(*) AS count FROM audit LEFT JOIN audit_checklist ON audit.id==audit_checklist.id';
        return $this->fetchDataFromDB($sql);
    }
    public function locationGraph($companyId){
        $sql='SELECT l.name,count(*) as count FROM `audit` a,bu_location l WHERE a.location_id=l.id AND a.company_id=? GROUP BY l.name';
        $paramArray=array($companyId);
        $dbOperations=new DBOperations();
        return $dbOperations->fetchData($sql,'i',$paramArray);
    }
    public function departmentGraph($companyId){
        $sql='SELECT d.name,count(*) as count FROM `audit` a,bu_deparment d WHERE a.department_id=d.id AND a.company_id=? GROUP BY d.name';
        $paramArray=array($companyId);
        $dbOperations=new DBOperations();
        return $dbOperations->fetchData($sql,'i',$paramArray);
    }
    public function monthGraph($companyId){
        $sql='SELECT month(a.start_date) as month,count(*) as count FROM `audit` a WHERE a.company_id=? GROUP BY month(a.start_date)';
        $paramArray=array($companyId);
        $dbOperations=new DBOperations();
        return $dbOperations->fetchData($sql,'i',$paramArray);
    }
    public function getAllAuditsForLocation($locationId,$companyId){
        $sql='SELECT a.id,a.title,a.status FROM `audit` a,bu_location l WHERE a.location_id=l.id AND a.company_id=? and l.name=?';
        $paramArray=array($companyId,$locationId);
        $dbOperations=new DBOperations();
        error_log("paramArray".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'is',$paramArray);   
    }
    public function getAllRisksForLocation($locationId,$companyId){
        $sql='SELECT a.subject,a.id,a.status,l.name FROM risks a,bu_location l WHERE a.location=l.id AND a.company_id=? and l.name=?';
        $paramArray=array($companyId,$locationId);
        $dbOperations=new DBOperations();
        error_log("paramArray".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'is',$paramArray);   
    }
    public function getAllAuditsForDepartment($department_id,$companyId){
        $sql='SELECT a.id,a.title,a.status FROM `audit` a,bu_deparment d WHERE a.department_id=d.id AND a.company_id=? and d.name=?';
        $paramArray=array($companyId,$department_id);
        $dbOperations=new DBOperations();
        error_log("paramArray".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'is',$paramArray);   
    }
    public function getAllAuditsForMonth($month,$companyId){
        $sql='SELECT a.id,a.title,a.status FROM `audit` a WHERE month(a.start_date)=? AND a.company_id=?';
        $paramArray=array($month,$companyId);
        $dbOperations=new DBOperations();
        error_log("paramArray".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'ii',$paramArray);   
    }
    public function getganttchartdata()
    {
       $sql='SELECT `id`, `title`, `start_date`, `end_date`,monthname(start_date) AS startmonth,monthname(end_date) AS endmonth,year(start_date) AS startyear,year(end_date) AS endyear FROM `audit` GROUP BY `startmonth`ORDER BY `start_date`';
        return $this->fetchDataFromDB($sql);  
    }

    //--------------------Configurable Dasboard-------------------//
    public function chartTypes(){
        $sql='SELECT `id`, `name` FROM `audit_chart_type` WHERE name="Bar Chart" or name="Pie Chart"';
        return $this->fetchDataFromDB($sql);
    }
    public function chartDataType(){
        $sql='SELECT `id`, `name` FROM `audit_chart_data` ';
        return $this->fetchDataFromDB($sql);
    }
    public function createChart($chartData){
        $sql='INSERT INTO `audit_configurable_dashboard`(`audit_chart_type_id`, `audit_chart_data_id`, `company_id`, `created_by`) VALUES (?,?,?,?)';
        $paramArray=array($chartData->chartType,$chartData->chartData,$chartData->company,$chartData->user);
        $dbOps=new DBOperations();
        $dbOps->cudData($sql,'iiii',$paramArray);


    }
    public function chartData($companyId){
        $sql='SELECT act.name as chart_type,ac.name as data,u.last_name as created_by,acd.id FROM `audit_configurable_dashboard` acd,audit_chart_data ac,audit_chart_type act,user u,company c WHERE acd.audit_chart_type_id=act.id and acd.audit_chart_data_id=ac.id and c.id=7 and acd.created_by=u.id GROUP BY ac.name';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function statusconf($companyId){
        $sql = 'SELECT a.status, count(*) AS count FROM audit a WHERE  a.company_id=?   and a.status is not null GROUP BY status';
         $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
        
    }
    public function frequencyconf($companyId,$id){
          $sql = 'SELECT a.audit_freq, count(*) AS count FROM audit a ,company c WHERE c.id=a.company_id and c.id=?  and a.audit_freq is not null GROUP BY a.audit_freq';
          $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }
    public function typeConf($companyId,$id){
         $sql = 'SELECT a.audit_type, count(*) AS count FROM audit a ,company c WHERE c.id=a.company_id and c.id=?  and a.audit_type is not null and a.audit_type!=" " GROUP BY a.audit_type';
          $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);   
    }
    public function locationconf($companyId,$id){
         $sql = 'SELECT  count(*) AS count,l.name as locationName FROM audit a ,company c,bu_location l WHERE c.id=a.company_id and c.id=?  and a.location_id is not null and a.location_id=l.id GROUP BY l.name';
          $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);   
    }
    public function departmentconf($companyId,$id){
         $sql = 'SELECT  count(*) AS count,d.name as departmentName FROM audit a ,company c,bu_deparment d WHERE c.id=a.company_id and c.id=?  and a.department_id is not null and a.department_id=d.id GROUP BY d.name';
          $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);   
    }
    public function complianceconf($companyId,$id){
         $sql = 'SELECT  count(*) AS count,comp.name as compliance FROM audit a ,company c,compliance comp WHERE c.id=a.company_id and c.id=?  and a.compliance_id is not null and a.compliance_id=comp.id GROUP BY comp.name';
          $paramArray=array($companyId);
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);   
    }
//Audit Related Queries Ends Here --------------------------------------------------------//
         
    private function fetchDataFromDB($sql){
        $dbOps = new DBOperations();
        $dataFromDB = $dbOps->fetchData($sql);
        return $dataFromDB;         
    }

    public function createEvent($eventData){
        $sql = 'INSERT INTO calendar(event) VALUES (?)';
        $paramArray = array();
        $paramArray[] = $eventData->event;
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 's', $paramArray); 
    }

   /* public function events(){
          $sql = 'SELECT * FROM calendar';
        return $this->fetchDataFromDB($sql);
    }
        */
    public function calendarEvents(){
          $sql = 'SELECT  id,event,event_date,created_date FROM calendar';
           $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function events($userid){
          $sql = 'SELECT a.id as id,a.title as event,a.start_date as event_date,a.created_date FROM audit a,user u WHERE (a.auditor=u.id or a.auditee=u.id) and a.parent_audit=0 and u.id=?';
          $paramArray= array();
          $paramArray[]=$userid;
           $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);
    }    
    public function eventUpdate($eventData){        
        $sql = 'UPDATE calendar SET event_date=? WHERE id=?';
        $paramArray = array($eventData->event_date, $eventData->id); 
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'si', $paramArray);         
    }
    public function getAllUsersForTicket(){
          $sql = 'SELECT * FROM user ORDER BY `id` DESC';
        return $this->fetchDataFromDB($sql);
    } 

    public function createSupportTicket($ticketData){
        $sql = 'INSERT INTO `support_ticket` (`title`, `customer_name`,`customer_email`,`assigned_to`, `status`) VALUES (?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $ticketData->title;
        $paramArray[] = $ticketData->customername;
        $paramArray[] = $ticketData->customeremail;
        $paramArray[] = $ticketData->assignedto;
        $paramArray[] = $ticketData->status;
        error_log("param array support ticket".print_r($paramArray,true));
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sssss', $paramArray); 
    }
    public function updateSupportTicket($ticketData){
        $sql='UPDATE support_ticket SET status=? WHERE id=?';
        $paramArray=array($ticketData->status,$ticketData->id);
        $dbOps=new DBOperations();
        return $dbOps->cudData($sql,'si',$paramArray);
    }
     public function deleteSupportTicket($ticketData){
        $sql='DELETE FROM support_ticket WHERE id=?';
        $paramArray=array($ticketData->id);
        // error_log("paramArray".print_r($paramArray,true));
        $dbOps=new DBOperations();
        return $dbOps->cudData($sql,'i',$paramArray);
    }

    public function getAllSupportTicket(){
          $sql = 'SELECT id,title,customer_name,customer_email,status FROM support_ticket ORDER BY `id` DESC';
          $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }    
    public function getLocation()
    {
        $sql='SELECT l.state , count(*) AS count FROM audit a, bu_location l WHERE l.id=a.location_id GROUP BY location_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    } 
    public function createTask($taskData){
        $sql = 'INSERT INTO task(project_id, task_name, description, due_date, assignee, assigned_to, attachment, status) VALUES (?,?,?,?,?,?,?,?)';
        $paramArray = array();
        $paramArray[] = $taskData->project;
        $paramArray[] = $taskData->task;
        $paramArray[] = $taskData->description;
        $paramArray[] = $taskData->duedate;
        $paramArray[] = $taskData->assignee;
        $paramArray[] = $taskData->assignedto;        
        $paramArray[] = $taskData->attachment;
        $paramArray[] = $taskData->status;    
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'isssisss', $paramArray); 
    }
    public function getAllTask($projectId){
        $sql = 'SELECT t.task_name as taskName,t.project_id as projectId,t.id as taskId,t.assigned_to as assignedTo,t.due_date as dueDate,u.id as userId,u.last_name as userName,t.description as description FROM task t, user u WHERE t.assigned_to=u.id and assigned_to=?';
        $paramArray = array();
        $paramArray[] = $projectId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);
    }
     public function getAllTaskForUser($projectId){
        $sql = 'SELECT t.task_name as taskName,t.project_id as projectId,t.id as taskId,t.assigned_to as assignedTo,u.last_name as userass ,t.due_date as dueDate,u.id as userId,u.last_name as userName,t.description as description FROM task t, user u WHERE t.assigned_to=u.id and u.id=?';
        $paramArray = array();
        $paramArray[] = $projectId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);
    }
    public function updateTask($taskData){        
        $sql = 'UPDATE task SET project_id=?, task_name=?, description=?, due_date=?, assignee=?, assigned_to=?,  attachment=?, status=?  WHERE id=?';
        $paramArray = array();
        $paramArray[] = $taskData->project;
        $paramArray[] = $taskData->task;
        $paramArray[] = $taskData->description;
        $paramArray[] = $taskData->duedate;
        $paramArray[] = $taskData->assignee;
        $paramArray[] = $taskData->assignedto;        
        $paramArray[] = $taskData->attachment;
        $paramArray[] = $taskData->status;
        $paramArray[] = $taskData->taskId;
        $dbOps = new DBOperations();       
        error_log("updateTask".print_r($paramArray,true)); 
        return $dbOps->cudData($sql, 'isssiissi', $paramArray);         
    }

    public function getAllProjectForTask(){
          $sql = 'SELECT * FROM project ORDER BY `id` DESC';
        return $this->fetchDataFromDB($sql);
    } 
    public function createProject($projectData){
        $sql = 'INSERT INTO project(project_name, project_description, assigned_to) VALUES (?,?,?)';
        $paramArray = array();
        $paramArray[] = $projectData->projectname;
        $paramArray[] = $projectData->projectDescription; 
        $paramArray[] = $projectData->assignedto;       
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'sss', $paramArray); 
    }
    public function updateProject($projectData){        
        $sql = 'UPDATE project SET project_name=? WHERE id=?';
        $paramArray = array($projectData->projectname, $projectData->id); 
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql, 'si', $paramArray);         
    }
    public function getAllProject($projectId){
          $sql = 'SELECT * FROM project order by id desc';
        $paramArray = array();
        $paramArray[] = $projectId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);
    } 


   
    public function riskStatus(){
        $sql='SELECT r.status,count(r.status) AS count FROM risks r GROUP BY r.status';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function riskScoring(){
        $sql='SELECT s.name,count(r.risk_scoring) AS count FROM risks r,scoring_methods s WHERE r.risk_scoring=s.id GROUP BY r.risk_scoring';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }

     public function riskLocation($companyId){
        $sql='SELECT b.name, count(r.location) AS count FROM risks r, bu_location b WHERE r.location=b.id GROUP BY b.name';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }

    public function riskTeam(){
        $sql='SELECT rt.name, count(r.team) AS count FROM risks r, risk_team rt WHERE r.team=rt.id GROUP BY r.team';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function riskFutureTeam(){
        $sql='SELECT rt.name, count(r.team) AS count FROM risks r, risk_team rt WHERE r.team=rt.id GROUP BY r.team DESC LIMIT 3';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
   
      public function riskFutureDashStatus()
    {
        $sql='SELECT r.status,count(r.status) AS count FROM risks r GROUP BY r.status DESC LIMIT 3';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
     public function riskFutureScoring(){
        $sql='SELECT s.name,count(r.risk_scoring) AS count FROM risks r,scoring_methods s WHERE r.risk_scoring=s.id GROUP BY r.risk_scoring DESC LIMIT 3';
        $dbOps=new DBOperations(); 
        return $dbOps->fetchData($sql);

    } 
      public function riskFutureLocation(){
        $sql='SELECT bl.name,COUNT(r.location) as count FROM risks r,bu_location bl WHERE r.location=bl.id GROUP BY r.location ORDER BY count DESC LIMIT 5';
          $dbOps=new DBOperations();
          return $dbOps->fetchData($sql);
  
      }


    public function riskFutureReviewNextStep(){
        $sql='SELECT ns.name, COUNT(mr.next_step) as count FROM mgmt_reviews mr, next_step ns WHERE mr.next_step=ns.id GROUP BY mr.next_step ORDER BY count DESC LIMIT 1';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
     public function riskTopThreeCategory(){
        $sql='SELECT c.name, COUNT(r.category) as count FROM risks r,category c WHERE r.category=c.id GROUP BY r.category ORDER BY count DESC LIMIT 3';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function riskTopThreeRegulation(){
        $sql='SELECT rg.name, COUNT(r.regulation) as count FROM risks r,regulation rg WHERE r.regulation=rg.id GROUP BY r.regulation ORDER BY count DESC LIMIT 3';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function riskTopOneTechnology(){
        $sql='SELECT t.name,COUNT(r.technology) as count FROM risks r,technology t WHERE r.technology=t.id GROUP BY r.technology ORDER BY count DESC LIMIT 1';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function riskTopOneSource(){
        $sql='SELECT s.name,COUNT(r.source) as count FROM risks r,source s WHERE r.source=s.id GROUP BY r.source ORDER BY count DESC LIMIT 1';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function totalAdminProjects(){
        $sql='SELECT count(*) as total_projects FROM project WHERE assigned_to = 1';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalAuditProjects(){
        $sql='SELECT count(*) as total_projects FROM project WHERE assigned_to IN (7,8)';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalAdminTasks(){
        $sql='SELECT count( * ) as total_tasks FROM task WHERE assigned_to = 1';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalAuditTasks(){
        $sql='SELECT count( * ) as total_tasks FROM task WHERE assigned_to IN (7,8)';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalRiskProjects(){
        $sql='SELECT count(*) as total_projects FROM project WHERE assigned_to IN (13,14,15)';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalRiskTasks(){
        $sql='SELECT count( * ) as total_tasks FROM task WHERE assigned_to IN (13,14,15)';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalCompProjects(){
        $sql='SELECT count(*) as total_projects FROM project WHERE assigned_to IN (11,12)';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalCompTasks(){
        $sql='SELECT count( * ) as total_tasks FROM task WHERE assigned_to IN (11,12)';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }


    public function totalUploads(){
        $sql="SELECT COUNT(attachment) as total_uploads from task where attachment like '%' AND attachment<>''";
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function risklist($status){
        $sql='SELECT r.id as riskId, r.subject as subject, r.status as status, u.last_name as riskName from risks r, user u where r.owner = u.id AND r.status=?';
        $paramArray = array();
        $paramArray[] = $status;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'s',$paramArray);
    }
     public function getUserSocialMedias($loggedInUser){
        $sql='SELECT facebook, twitter, site FROM user_profile WHERE user_id=?';
        $paramArray = array();
        $paramArray[] = $loggedInUser;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);

    }
    public function mail($userId){
        $sql='SELECT email, phone_no FROM user WHERE id=?';
        $paramArray = array();
        $paramArray[] = $userId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);

    }

     public function riskFuturePlanningStrategy(){         
         $sql='SELECT p.name, count(m.planning_strategy) AS count FROM mitigations m, planning_strategy p WHERE m.planning_strategy=p.id GROUP BY m.planning_strategy ORDER BY count DESC LIMIT 3';
          $dbOps=new DBOperations();
          return $dbOps->fetchData($sql);  
      }
       public function riskFutureMitigationTeam(){ 
         $sql='SELECT rt.name,COUNT(m.mitigation_team) as count FROM mitigations m,risk_team rt WHERE m.mitigation_team=rt.id GROUP BY m.mitigation_team ORDER BY count DESC LIMIT 1';
          $dbOps=new DBOperations();
          return $dbOps->fetchData($sql);  
      }
       public function riskFutureMitigationEffort(){ 
        $sql='SELECT me.name,COUNT(m.mitigation_cost) as count FROM mitigations m,mitigation_effort me WHERE m.mitigation_cost=me.id GROUP BY m.mitigation_cost ORDER BY count DESC LIMIT 1';
          $dbOps=new DBOperations();
          return $dbOps->fetchData($sql);  
      }
      public function riskFutureMitigationCost(){ 
         $sql='SELECT mc.pricing,COUNT(m.mitigation_cost) as count FROM mitigations m,mitigation_cost mc WHERE m.mitigation_cost=mc.id GROUP BY m.mitigation_cost ORDER BY count DESC LIMIT 1';
          $dbOps=new DBOperations();
          return $dbOps->fetchData($sql);  
      }
      public function riskFutureMitigationPercent(){
         $sql='SELECT MAX(mitigation_percent) as mitigationPercent FROM mitigations';
         $dbOps=new DBOperations();
         return $dbOps->fetchData($sql); 
      }
      public function riskFutureMitigationReview(){ 
        $sql='SELECT r.name, COUNT(mr.review) as count FROM mgmt_reviews mr, review r WHERE mr.review=r.id GROUP BY mr.review ORDER BY count DESC LIMIT 1';
          $dbOps=new DBOperations();
          return $dbOps->fetchData($sql);  
      }
      public function getUserImage($loggedInUser){
        $sql='SELECT image_name FROM `user_profile` WHERE user_id =?';
        $paramArray = array();
        $paramArray[] = $loggedInUser;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql,'i',$paramArray);

    }
    public function getNoOfCreatedRisk(){
        $sql = 'SELECT count(*) as count from risks r,user u where r.mitigator = u.id AND r.status="create"';
       $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);         
    }
  public function getNoOfMitigatedRisk(){
        $sql = 'SELECT count(*) as count FROM risks r WHERE r.status="Mitigated"';
       $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);         
    }
      public function getNoOfReviewedRisk(){
        $sql = 'SELECT count(*) as count FROM risks r WHERE r.status="Reviewed"';
       $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);         
    }
    public function getTotalNoOfRisks(){
        $sql = 'SELECT count(*) AS total_records FROM risks r WHERE (r.status="Mitigated" OR r.status="Create" OR r.status="Reviewed")';
       $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);         
    }

    /// Asset Dashboard///
 
  public function AssetGroup(){
        $sql='SELECT ag.name,count(a.asset_group) AS count FROM asset a,asset_group ag WHERE a.asset_group=ag.id GROUP BY a.asset_group';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function AssetClassfication(){
        $sql='SELECT ac.classification,count(a.classification) AS count FROM asset a,asset_classification ac WHERE a.classification=ac.id GROUP BY a.classification';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
     public function Assetlocation(){
        $sql='SELECT al.name,count(a.location_id) AS count FROM asset a,bu_location al WHERE a.location_id=al.id GROUP BY al.id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
     public function Assetdepartment(){
        $sql='SELECT al.name,count(a.department_id) AS count FROM asset a,bu_deparment al WHERE a.department_id=al.id GROUP BY a.department_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function Assetstatus(){
        $sql='SELECT ag.id AS id,ag.name AS assetname,count(*) AS count FROM asset_group ag,
        audit_clauses ac WHERE ac.audit_id=ag.id GROUP BY ac.audit_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function getganttchartdataasset(){
        $sql='SELECT `id`, `name`, `start_Date`, `end_date`,monthname(start_Date) AS startmonth,monthname(end_date) AS endmonth,year(start_Date) AS startyear,year(end_date) AS endyear FROM `asset` GROUP BY `name`,`startmonth` ORDER BY `start_date`';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
             
public function assetfieldstatus($id){
        $sql='SELECT ag.id AS id,ac.audit_status AS status,count(*) AS count FROM
        asset_group ag,audit_clauses ac where ac.audit_id=? and ac.audit_id=ag.id  GROUP BY ac.audit_status';
        $dbOps=new DBOperations();
      $paramArray = array($id);
     return $dbOps->fetchData($sql, 'i', $paramArray);
    }
             

    ////end////


    //DISASTER DASHBORAD//

    public function disaster_business(){
        $sql = 'SELECT business_impact_scale, count(*) AS count FROM disaster_plan WHERE business_impact_scale is not null GROUP BY business_impact_scale';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);    
    }  

    public function disaster_category(){
         $sql = 'SELECT system_category, count(*) AS count FROM disaster_plan WHERE system_category is not null GROUP BY system_category';
        return $this->fetchDataFromDB($sql);
    } 

    public function disaster_critical(){
         $sql = 'SELECT critical_resources, count(*) AS count FROM disaster_plan WHERE critical_resources is not null GROUP BY critical_resources';
        return $this->fetchDataFromDB($sql);
    } 

    public function disaster_resource(){
         $sql = 'SELECT critical_resources, count(*) AS count FROM disaster_plan WHERE critical_resources is not null GROUP BY critical_resources';
        return $this->fetchDataFromDB($sql);
    } 

    public function disaster_location(){
        $sql = 'SELECT backup_offsite_location, count(*) AS count FROM `disaster_strategy` WHERE backup_offsite_location is not null GROUP BY backup_offsite_location';
        return $this->fetchDataFromDB($sql);
    } 

    public function disaster_plan_count(){
         $sql = 'SELECT COUNT(id) AS plan_id FROM disaster_plan';
        return $this->fetchDataFromDB($sql);
    }

    public function disaster_test_count(){
         $sql = 'SELECT COUNT(id) AS test_id FROM disaster_strategy';
        return $this->fetchDataFromDB($sql);
    }

    public function disaster_train_count(){
         $sql = 'SELECT COUNT(id) AS train_id FROM disaster_training';
        return $this->fetchDataFromDB($sql);
    }

    public function disaster_test_dash(){
        $sql = 'SELECT id,system_name,number_of_test_completed,test_no,test_date FROM disaster_strategy';
        return $this->fetchDataFromDB($sql);
    }
    public function noOfLibraries(){
        $sql='SELECT count(id) as count FROM compliance';
        return $this->fetchDataFromDB($sql);
    }
    public function noOfPublished(){
        $sql='SELECT count(*) as count FROM compliance where status="published"';
        return $this->fetchDataFromDB($sql);
    }
    public function noOfDraft(){
        $sql='SELECT count(*) as count FROM compliance where (status!="published" || status!="analyzed")';
        return $this->fetchDataFromDB($sql);
    }
    public function noOfAnalyzed(){
        $sql='SELECT count(*) as count FROM compliance where status="analyzed"';
        return $this->fetchDataFromDB($sql);
    }
    public function complianceStatuses($companyId,$complianceId){
        $sql='SELECT COUNT(ac.status) as audit_status,cc.parent_clause_id,ac.status,cc.id,a.id as audit_id FROM `audit_checklists` ac,audit a,compliance c,compliance_clause cc WHERE c.id=? and a.compliance_id=c.id and ac.audit_id=a.id and cc.compliance_id=c.id and cc.id=ac.clause_id and a.company_id=? GROUP BY ac.status,cc.parent_clause_id';
        $dbOperations=new dbOperations();
        $paramArray=array($complianceId,$companyId);
        error_log("paramArray".print_r($paramArray,true));
        $status= $dbOperations->fetchData($sql,'ii',$paramArray);
        return $status;
        
    }
    public function barChartComplianceStatus($complianceId,$companyId){
        $sql='SELECT COUNT(ac.status) as audit_status,cc.numbering as subClauseNumbering,cc.parent_clause_id,ac.status,
        cc.id as id,a.title as audit FROM `audit_checklists` ac,audit a,compliance c,compliance_clause cc WHERE c.id=?
        and ac.audit_id=a.id and cc.compliance_id=c.id and a.company_id=? GROUP BY ac.status,cc.parent_clause_id';
        $paramArray=array($complianceId,$companyId);
        $dbOperations=new dbOperations();
        return $dbOperations->fetchData($sql,'ii',$paramArray);
    }
    public function getClauseNumber($id){
        $sql='SELECT numbering  FROM `compliance_clause` WHERE id=?';
        $paramArray=array($id);
        $dbOperations=new dbOperations();
        return $dbOperations->fetchData($sql,'i',$paramArray);

    }
    public function getChecklists($clause_id,$status){
        $sql='SELECT cc.id as description FROM audit_checklists ac,cc_check_list cc WHERE ac.clause_id=? and 
        ac.status=? and ac.checklist_id=cc.id';
        $paramArray=array($clause_id,$status);
        $dbOperations=new DBOperations();
        error_log("paramArray".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'is',$paramArray);
    }
    public function getComplianceName($complianceId){
        $sql='SELECT name FROM compliance c WHERE id=?';
        $paramArray=array($complianceId);
        $dbOperations=new DBOperations();
        return $dbOperations->fetchData($sql,'i',$paramArray);
    }
    public function auditComplianceStatus($companyId,$compliance){
        $sql='SELECT COUNT(*) as count,status FROM `audit` WHERE company_id=? and compliance_id=? GROUP BY status';
        $paramArray=array($companyId,$compliance);
        $dbOperations=new DBOperations();
        error_log("paramArray Status".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'ii',$paramArray);

    }
    public function dueAuditsCompl($companyId,$compliance){
        $sql='SELECT title,status,end_date,start_date FROM `audit` WHERE company_id=? and compliance_id=? and status="create"';
        $paramArray=array($companyId,$compliance);
        $dbOperations=new DBOperations();
        error_log("paramArray Status".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'ii',$paramArray);

    }
    public function completedAuditsCompl($companyId,$compliance){
        $sql='SELECT title,status,end_date,start_date FROM `audit` WHERE company_id=? and compliance_id=? and (status="published" or status="approved")';
        $paramArray=array($companyId,$compliance);
        $dbOperations=new DBOperations();
        error_log("paramArray Status".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'ii',$paramArray);

    }
    public function pendingAuditsCompl($companyId,$compliance){
        $sql='SELECT title,status,end_date,start_date FROM `audit` WHERE company_id=? and compliance_id=? and (status="prepared" or status="performed" or status="returned")';
        $paramArray=array($companyId,$compliance);
        $dbOperations=new DBOperations();
        error_log("paramArray Status".print_r($paramArray,true));
        return $dbOperations->fetchData($sql,'ii',$paramArray);

    }
    
    /////////////////////////////
    /////POLICY DASHBOARD/////
    public function policyTypes(){
        $sql='SELECT pt.name, count(p.policy_type) AS count FROM policy p,policy_types pt WHERE p.policy_type=pt.id GROUP BY p.policy_type ORDER BY count(p.policy_type) desc';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function policyProcedure(){
        $sql='SELECT pp.name, count(p.policy_procedure) AS count FROM policy p,policy_procedure pp WHERE p.policy_procedure=pp.id GROUP BY p.policy_procedure';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getpolicydata()
{
    $sql="SELECT l.name,l.id,count(*) AS count FROM ethics as e,bu_location as l where e.location=l.id 
    GROUP BY location";
 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql); 
}
     public function getpolicyClassification(){
         $sql='SELECT pc.name AS policyname, pc.id AS id, count(*) AS count FROM policy as p,policy_classification as pc WHERE p.policy_classification=pc.id GROUP BY p.policy_classification';
        $dbOps=new DBOperations();
         return $dbOps->fetchData($sql);
    }
 public function getclassificationdata($id)
 {
    $sql ="SELECT pc.id as id,p.title as title,count(*) AS count FROM policy as p,policy_classification as pc where 
    p.policy_classification=? and p.policy_classification=pc.id GROUP BY title";
  $dbOps = new DBOperations();
         $paramArray = array($id);
         return $dbOps->fetchData($sql, 'i', $paramArray);
 }

//     public function getdatafordepartment($id)
// {
// $sql ="SELECT d.id as id,d.name as department_name,count(*) AS count FROM ethics as e,bu_location as l,bu_deparment as d where e.location=l.id and l.id=? and e.department=d.id GROUP BY department";
//   $dbOps = new DBOperations();
//         $paramArray = array($id);
//         return $dbOps->fetchData($sql, 'i', $paramArray);
// }
// public function getChartdata()
// {
//     $sql="SELECT l.name,l.id,count(*) AS count FROM ethics as e,bu_location as l where e.location=l.id GROUP BY location";
//  $dbOps = new DBOperations();
//         return $dbOps->fetchData($sql); 
// }
//     
    public function securityClassification(){
        $sql='SELECT sc.name, count(p.security_classification) AS count FROM policy p,security_classification sc WHERE p.security_classification=sc.id GROUP BY p.security_classification';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function policyAudienceClassification(){
        $sql='SELECT ac.name, count(p.security_classification) AS count FROM policy p,audience ac WHERE p.audience=ac.id GROUP BY p.audience';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function policyStatus(){
        $sql='SELECT p.status,count(p.status) AS count FROM policy p GROUP BY p.status';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
     public function totalPolicy(){
        $sql='SELECT COUNT(*) as count FROM policy';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalPolicyPublished(){
        $sql='SELECT COUNT(*) as count FROM policy WHERE status="published"';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalPolicyIdentified(){
        $sql='SELECT COUNT(*) as count FROM policy WHERE status="identified"';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function totalPolicyExpired(){
        $sql='SELECT COUNT(*) as count FROM policy WHERE status="expired"';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    /////////////////////////////

    ////////INCIDENT DASHBOARD///////
    public function incidentStatus(){
        $sql='SELECT Incf.status as name,count(Incf.status) AS count FROM incident_file Incf GROUP BY Incf.status';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function incidentType(){
        $sql='SELECT Incf.Type as name,count(Incf.Type) AS count FROM incident_file Incf GROUP BY Incf.Type';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function incidentCategory(){
        $sql='SELECT ic.name,count(inf.Category) AS count FROM incident_file inf, incident_category ic WHERE inf.Category = ic.id GROUP BY inf.Category';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function incidentSource(){
        $sql='SELECT Incf.source as name,count(Incf.source) AS count FROM incident_file Incf GROUP BY Incf.source';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }
    public function incidentRecordedStatus(){
        $sql = 'SELECT Incf.status as name,count(Incf.status) AS count FROM incident_file Incf WHERE Incf.status="Recorded"';
       $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);         
    }
    public function incidentAssignedStatus(){
        $sql = 'SELECT Incf.status as name,count(Incf.status) AS count FROM incident_file Incf WHERE Incf.status="Assigned"';
       $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);         
    }
    public function incidentResolvedStatus(){
        $sql = 'SELECT Incf.status as name,count(Incf.status) AS count FROM incident_file Incf WHERE Incf.status="Resolved"';
       $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);         
    }
    public function incidentClosedStatus(){
        $sql = 'SELECT Incf.status as name,count(Incf.status) AS count FROM incident_file Incf WHERE Incf.status="Closed"';
       $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);         
    }
      public function riskCreateList(){
        $sql='SELECT r.subject,rs.calculated_risk FROM risks r,risk_scoring rs WHERE r.status="create" and r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
        public function riskMitigateList(){
        $sql='SELECT r.subject,rs.calculated_risk FROM risks r,risk_scoring rs WHERE r.status="mitigated" and r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
       public function riskReviewList(){
        $sql='SELECT r.subject,rs.calculated_risk FROM risks r,risk_scoring rs WHERE r.status="reviewed" and r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
     public function riskClassicList(){
        $sql='SELECT r.subject, r.risk_scoring,rs.calculated_risk FROM risks r,risk_scoring rs WHERE risk_scoring=1 AND r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function riskCvssList(){
        $sql='SELECT r.subject, r.risk_scoring,rs.calculated_risk FROM risks r,risk_scoring rs WHERE risk_scoring=2 AND r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
     public function riskDreadList(){
        $sql='SELECT r.subject, r.risk_scoring,rs.calculated_risk FROM risks r,risk_scoring rs WHERE risk_scoring=3 AND r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
     public function riskOwaspList(){
        $sql='SELECT r.subject, r.risk_scoring,rs.calculated_risk FROM risks r,risk_scoring rs WHERE risk_scoring=4 AND r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
     public function riskCustomList(){
        $sql='SELECT r.subject, r.risk_scoring,rs.calculated_risk FROM risks r,risk_scoring rs WHERE risk_scoring=5 AND r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
     public function riskAbsList(){
        $sql='SELECT r.subject, r.risk_scoring,rs.calculated_risk FROM risks r,risk_scoring rs WHERE risk_scoring=6 AND r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }

    // SELECT r.subject,rs.calculated_risk, rs.scoring_methods FROM risks r,risk_scoring rs WHERE r.id=rs.risk_id and scoring_methods=1

    public function getAllSupportTickets($projectId){
        $sql='SELECT ua.id,u.last_name,ua.logged_in_time,ur.role_id as projectId,ua.logged_out_time FROM `user_activity_log` ua,user u,role r,user_role ur WHERE ua.user_id=u.id and u.id=ur.user_id and r.id=ur.role_id AND u.id=?';
        $paramArray = array();
        $paramArray[] = $projectId;
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);
    }

    //Measure of Risk

    
    public function riskAcceptableList(){
        $sql='SELECT r.subject,rs.calculated_risk FROM risks r,risk_scoring rs WHERE rs.calculated_risk_status<=2 and rs.scoring_methods=5 and r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }

    public function riskNotAcceptableList(){
        $sql='SELECT r.subject,rs.calculated_risk FROM risks r,risk_scoring rs WHERE rs.calculated_risk_status>=3 and rs.scoring_methods=5 and r.id=rs.risk_id';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
public function getganttchartdatarisk(){
    $sql='SELECT `id`, `subject`, `created_date`, `updated_time`,monthname(created_date) AS startmonth,monthname(updated_time) AS endmonth,year(created_date) AS startyear,year(updated_time) AS endyear FROM `risks` GROUP BY `subject`,`startmonth` ORDER BY `created_date`';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

}
    // public function riskMeasure()


    // to create number of audits 
    public function totalAudits()
    {
         $sql='SELECT * FROM `audit`';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }


    public function totaldelayAudit()
    {
        $sql="SELECT * from audit where (end_date < CAST(CURRENT_TIMESTAMP AS DATE)) and (status!='published')";
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }


    public function totalDueAudit()
    {
         $sql="SELECT * FROM audit WHERE (status!='published')";
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }

       public function totalAuditPublished()
    {
         $sql="SELECT * FROM `audit` WHERE status='published'";
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);

    }


    public function efficacy(){
        $sql='SELECT id FROM compliance WHERE status="analyzed"';
        $dbOps=new DBOperations();
        $res=$dbOps->fetchData($sql);
        $returnElement=array();
        
        foreach ($res as $result) {
            $sql='SELECT c.name as status,AVG(ca.compliance_efficacy) as count FROM `compliance` c,compliance_clause cl,cc_check_list as cc,cc_checklist_analyze as ca WHERE c.id=cl.compliance_id and cl.id=cc.clause_id and cc.id=ca.checklist_id and c.status="analyzed" and c.id=? ';
            $dbOps=new DBOperations();
            $paramArray=array($result['id']);
            $result2=new StdClass();
            $result1=$dbOps->fetchData($sql,'i',$paramArray);
            //mysqli_num_rows($result1);
            //$count=mysqli_num_rows($result1);
            //$count=mysql_num_rows($result1);
            //$count=count($result);
            $count=count($result1);
            foreach($result1 as $res){
                if($res['count']!=null){
                $result2->status=$res['status'];
                $result2->count=$res['count'];
                 //$result2->count=1;
                array_push($returnElement,$result2);
            
        }
    }
        error_log("efficacy".print_r($returnElement,true));
        //echo json_encode($returnElement);

    }
    return $returnElement;

}

    public function riskCalculatedRiskStatus(){
        $sql='SELECT CLASSIC_likelihood as x, CLASSIC_impact as y, CLASSIC_likelihood*CLASSIC_impact as heat FROM risk_scoring WHERE calculated_risk_status=CLASSIC_likelihood=CLASSIC_impact IS NOT NULL ORDER BY CLASSIC_likelihood,CLASSIC_impact';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
       public function kriCalculatedRisk(){
        $sql='SELECT CLASSIC_likelihood as x, CLASSIC_impact as y, CLASSIC_likelihood*CLASSIC_impact as heat FROM risk_scoring WHERE calculated_risk_status=CLASSIC_likelihood=CLASSIC_impact IS NOT NULL ORDER BY CLASSIC_likelihood,CLASSIC_impact';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
      public function InherentheatRisk(){
           $sql='SELECT rs.CLASSIC_likelihood as x,rs.CLASSIC_impact as y,rs.Residual_risk as heat 
           from risks as r,risk_scoring as rs where r.id=rs.id GROUP BY rs.CLASSIC_likelihood,rs.CLASSIC_impact,rs.Residual_risk';
            $dbOps=new dbOperations();
            return $dbOps->fetchData($sql);
    }
    public function showall(){
        $sql='SELECT r.subject as Risk from risks as r, risk_scoring as rs where r.id = rs.risk_id' ;
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function complianceStatus($companyId){
        $sql='SELECT c.status,COUNT(*) as count FROM compliance c,company comp WHERE c.company_id=comp.id and comp.id=?';
        $dbOps=new DBOperations();
        $paramArray=array($companyId);
        return $dbOps->fetchData($sql,'i',$paramArray);
    }

    ///////////////////////////

// bcpm Dashboard
     public function bcpmStatus(){
        $sql='SELECT b.status,count(b.status) AS count FROM bcpm b GROUP BY b.status';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmFooter(){
        $sql='SELECT f.name,count(b.bcpm_footer) AS count FROM bcpm b, bcpm_footer f WHERE b.bcpm_footer=f.id GROUP BY b.bcpm_footer';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmLocation(){
        $sql='SELECT b.name, count(bu.location_id) AS count FROM bcpm bu, bu_location b WHERE bu.location_id=b.id GROUP BY b.name';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    
    // Bcpm futureDashboard
    public function bcpmFutureFooter(){
        $sql='SELECT f.name,count(b.bcpm_footer) AS count FROM bcpm b, bcpm_footer f WHERE b.bcpm_footer=f.id GROUP BY b.bcpm_footer ORDER BY count DESC LIMIT 2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmFutureLocation(){
        $sql='SELECT b.name, count(bu.location_id) AS count FROM bcpm bu, bu_location b WHERE bu.location_id=b.id GROUP BY b.name ORDER BY count DESC LIMIT 2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmFutureExercise(){
        $sql='SELECT SUM(number_exercise) AS count,erercise_type FROM `bcpm_exercise` GROUP BY erercise_type ORDER BY count DESC LIMIT 2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmFutureControl(){
        $sql='SELECT b.control_scale,count(b.control_scale) AS count FROM bcpm_plan b GROUP BY b.control_scale ORDER BY count DESC LIMIT 2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmFutureBusinessImpact(){
        $sql='SELECT b.business_impact_scale,count(b.business_impact_scale) AS count FROM bcpm_plan b GROUP BY b.business_impact_scale ORDER BY count DESC LIMIT 2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmFutureProbabilityImpact(){
        $sql='SELECT b.probabilty_scale,count(b.probabilty_scale) AS count FROM bcpm_plan b GROUP BY b.probabilty_scale ORDER BY count DESC LIMIT 2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmFutureRto(){
        $sql='SELECT bia  ,SUM(rto) AS count FROM `bcpm_implement` GROUP BY bia ORDER BY count DESC LIMIT 2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function bcpmFutureDailyLoss(){
        $sql='SELECT SUM(daily_loss) AS count,bia FROM `bcpm_implement` GROUP BY bia ORDER BY count DESC LIMIT 2';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    
    public function getRiskNotify(){
        $sql='SELECT * FROM `risks` WHERE notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    
    public function getAuditNotify(){
        $sql='SELECT * FROM `audit` WHERE notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getAuditNotifyinkickoff(){
        $sql='SELECT * FROM `audit` WHERE kickoff_notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
      public function getAuditNotifyinrespond(){
        $sql='SELECT * FROM `audit` WHERE status="prepared" and respond_notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getAuditNotifyinperformed(){
        $sql='SELECT * FROM `audit` WHERE status="performed" and review_notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getAuditNotifyinfollowup(){
        $sql='SELECT * FROM `audit` WHERE status="returned" and followup_notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getAuditNotifyinreports(){
        $sql='SELECT * FROM `audit` WHERE status="approved" and reports_notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    public function getAuditNotifyinreview(){
        $sql='SELECT * FROM `audit` WHERE kickoff_notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }

    public function getPolicyNotify(){
        $sql='SELECT * FROM `policy` WHERE notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }

    public function getDisasterNotify(){
        $sql='SELECT * FROM `disaster_plan` WHERE notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }

    public function getComplianceNotify(){
        $sql='SELECT * FROM `compliance` WHERE notification_status =1 ORDER BY `id` DESC';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }

     public function getAssetsNotify(){
        $sql = 'SELECT * FROM `asset` WHERE notification_status =1 ORDER BY `id` DESC';
        $dbOps = new DBOperations();    
        return $dbOps->fetchData($sql);        
     }

    public function getganttchartdatapolicy(){
        $sql='SELECT `id`, `title`, `created_date`, `updated_date`,monthname(created_date) AS startmonth,monthname(updated_date) AS endmonth,year(created_date) AS startyear,year(updated_date) AS endyear FROM `policy` GROUP BY `title`,`startmonth` ORDER BY `created_date`';
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
    //board
    public function totalmeetings(){
    $sql='SELECT count(*) as count FROM boardindex';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);
    }

    public function approve(){
    $sql='SELECT count(*) as count FROM boardpublish';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);
    }
    public function returned(){
    $sql='SELECT count(*) as count FROM boardminutes';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);
    }
    public function cancel(){
    $sql='SELECT count(*) as count FROM boardminutes';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);
    }
//boarddashboardchart
    public function totalmeetingschart(){
    $sql='SELECT boardindex.title, count(*) AS count FROM boardindex GROUP BY title';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);    
    }
    public function approvechart(){
    $sql='SELECT boardindex.title, count(*) AS count FROM boardindex,boardpublish where boardindex.m_no= boardpublish.m_no GROUP BY title';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);    
    }
    public function returnchart(){
    $sql='SELECT boardindex.title, count(*) AS count FROM boardindex,boardminutes where boardindex.m_no= boardminutes.m_no GROUP BY title';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);    
    }
    public function cancelchart(){
    $sql='SELECT boardindex.title, count(*) AS count FROM boardindex,boardminutes where boardindex.m_no= boardminutes.m_no GROUP BY title';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);    
    }
    public function getAllAdmin(){
          $sql = 'SELECT * FROM boarduser_info';
        return $this->fetchDataFromDB($sql);
    }
    public function boardDataForCalendar(){
        $sql='SELECT m_no,title,date FROM boardindex';
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);
    }
      public function getAllUsers(){
          $sql = 'SELECT * FROM user WHERE company_id=7 ORDER BY `id` DESC';
        return $this->fetchDataFromDB($sql);
    } 
     public function actionitems(){
    $sql='SELECT boardindex.m_no as m_no, boardindex.title as title,count(*) AS count FROM  boardminutes,boardindex WHERE boardminutes.m_no=boardindex.m_no GROUP BY boardminutes.m_no';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);    
    }
    public function actionitemsdrilldown($m_no){
    $sql='SELECT boardindex.m_no as m_no, boardminutes.action_item as actionitem, count(*) AS count FROM boardminutes,boardindex WHERE boardminutes.m_no= 65 and boardminutes.m_no=boardindex.m_no  GROUP BY boardminutes.action_item';
     $dbOps = new DBOperations();
        $paramArray = array($m_no);
         $dbOps=new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray); 
    }
     public function votingsystem(){
    $sql='SELECT post.id as id, post.text as title ,count(*) AS count FROM rating_info,post WHERE rating_info.post_id=post.id GROUP BY rating_info.post_id ';
    $dbOps=new DBOperations();
    return $dbOps->fetchData($sql);    
    }
     public function votingsytemdrilldown($rating_action){
    $sql='SELECT  post.id as id,rating_info.rating_action as rating_action, count(*) AS count FROM post,rating_info WHERE rating_info.post_id=95 and rating_info.post_id=post.id  GROUP BY rating_info.rating_action';
   $dbOps = new DBOperations();
        $paramArray = array($rating_action);
        return $dbOps->fetchData($sql, 'i', $paramArray);   
    }
    public function detailsaboutChart($companyId){
        $sql='SELECT id,audit_chart_type_id,audit_chart_data_id FROM `audit_configurable_dashboard` ORDER BY id DESC LIMIT 1 ';
        $paramArray=array($companyId);
        $dbOps=new DBOperations();
        return $dbOps->fetchData($sql,$paramArray);
    }
    public function getPendingTaskForUser($projectId){
        $sql = 'SELECT t.task_name as taskName,t.project_id as projectId,t.id as taskId,t.assigned_to as assignedTo,u.last_name as userass ,t.due_date as dueDate,u.id as userId,u.last_name as userName,t.description as description FROM task t, user u WHERE t.assigned_to=u.id and status="Pending" and u.id=?';
        $paramArray = array();
        $paramArray[] = $projectId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);
    }
     public function getCompletedTaskForUser($projectId){
        $sql = 'SELECT t.task_name as taskName,t.project_id as projectId,t.id as taskId,t.assigned_to as assignedTo,u.last_name as userass ,t.due_date as dueDate,u.id as userId,u.last_name as userName,t.description as description FROM task t, user u WHERE t.assigned_to=u.id and status="Completed" and u.id=?';
        $paramArray = array();
        $paramArray[] = $projectId;        
        $dbOps = new DBOperations();
        return $dbOps->fetchData($sql, 'i', $paramArray);
    }
    public function auditselectpie(){
        $sql = 'SELECT a.status, count(*) AS count FROM audit a WHERE a.status is not null GROUP BY status';
          $dbOps=new DBOperations();
        return $dbOps->fetchData($sql);
    }
}
