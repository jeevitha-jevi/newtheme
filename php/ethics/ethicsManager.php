<?php
require_once __DIR__.'/../common/constants.php';
require_once __DIR__.'/../common/appConfig.php';
require_once __DIR__.'/../common/dbOperations.php';
class ethics
{
	 public function createemployee($employeedata){       
        $sql = 'INSERT INTO `ethics`(name,employeeID,department,PolicyId,location,date,Reason,main_heading,subheading,userFileName,status ) VALUES (?,?,?,?,?,?,?,?,?,?,?)';       
        $paramArray = array();
        $paramArray[] = $employeedata->name;
        $paramArray[] = $employeedata->employeeID;
        $paramArray[] = $employeedata->department;
        $paramArray[] = $employeedata->PolicyId;
        $paramArray[] = $employeedata->location;
        $paramArray[] = $employeedata->date;
        $paramArray[] = $employeedata->Reason;
        $paramArray[] = $employeedata->main_heading;
        $paramArray[] = $employeedata->subheading;
        $paramArray[] = $employeedata->userFileName;
        $paramArray[] = $employeedata->status;  
        error_log("con".print_r($paramArray,true));            
        $dbOps = new DBOperations();        
        return $dbOps->cudData($sql,'sssssssssss',$paramArray);

    }
	



	public function getAllemployeeList()
	{
		$sql="SELECT `id`,`name`,`department`,`PolicyId`,`status` FROM `ethics` where `status`='Clarification Required'";
		 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql); 
	}

public function getlocation($id)
{
	$sql='SELECT `name` FROM `bu_location` where `id`=?';
	  $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);	
}



public function getdepartment($id)
{
	$sql='SELECT `name` FROM `bu_deparment` where `id`=?';
	  $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);	
}

public function getReportListforEthics()
{
	$sql="SELECT `id`,`name`,`department`,`PolicyId`,`status` FROM `ethics` where `status`='Approved'";
		 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}



	public function getAllEmployeedata($id)
	{
	$sql='SELECT * FROM `ethics` where `id`=?';
	  $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);  
	}

	public function getAllclarifydata($id)
	{
	$sql='SELECT * FROM `ethics_clarification` where `clarification_id`=?';
	  $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 's', $paramArray);  
	}


public function getAllreviewdata($id)
	{
	$sql='SELECT * FROM `ethics_review` where `ethics_id`=?';
	  $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);  
	}
public function reviewerClarificationNeeded($employeedata)
	{
	$sql = 'UPDATE ethics SET status=? WHERE `id`=?';
	$dbOps = new DBOperations();  
	$paramArray = array( $employeedata->status,$employeedata->id);
	  

      return $dbOps->cudData($sql, 'ss', $paramArray);
	}
public function reviewerAccepted($employeedata)
	{
	$sql = 'UPDATE ethics SET status=? WHERE id=?';
	$dbOps = new DBOperations();  
	$paramArray = array($employeedata->status,$employeedata->id);
	  	  error_log("sucess".print_r($paramArray,true));

      return $dbOps->cudData($sql, 'ss', $paramArray);  
	}
public function reviewerReject($employeedata)
	{
	$sql = 'UPDATE ethics SET status=? WHERE id=?';
	$paramArray = array($employeedata->status,$employeedata->id);
	  $dbOps = new DBOperations();  
      return $dbOps->cudData($sql, 'ss', $paramArray);  
	}

public function createReviewertoethics($employeedata)
{
     $sql = 'INSERT INTO `ethics_review`(review_comment,ethics_id) VALUES (?,?)';       
        $paramArray = array();
        $paramArray[] = $employeedata->Comments;
        $paramArray[] = $employeedata->id;
        $dbOps = new DBOperations();  
      	  	  error_log("sucess".print_r($paramArray,true));

        return $dbOps->cudData($sql,'si',$paramArray);	
}


public function insertdataclarification($employeedata)
{
     $sql = 'INSERT INTO `ethics_clarification`(clarification_Id,clarification_reason,clarification_file) VALUES (?,?,?)';       
        $paramArray = array();
        $paramArray[] = $employeedata->id;
        $paramArray[] = $employeedata->clarification_reason;
        $paramArray[] = $employeedata->userFileName;
        $dbOps = new DBOperations();  
        return $dbOps->cudData($sql,'sss',$paramArray);	
}




public function approverAccepted($employeedata)
	{
	$sql = 'UPDATE ethics SET status=? WHERE id=?';
	$paramArray = array($employeedata->status,$employeedata->id);
	  $dbOps = new DBOperations();  
      return $dbOps->cudData($sql, 'ss', $paramArray);  
	}

// public function createapprover($employeedata)
// 	{
	
//      $sql = 'INSERT INTO `ethics_approver`(PolicyId,approver_comment,aprover_reason) VALUES (?,?,?)';       
//         $paramArray = array();
//         $paramArray[] = $employeedata->PolicyId;
//         $paramArray[] = $employeedata->Comments;
//         $paramArray[] = $employeedata->Reason;
//         $dbOps = new DBOperations();  
//         error_log("Clarification Required".print_r($paramArray,true));
      
//         return $dbOps->cudData($sql,'sss',$paramArray);	
// 	}




public function getalllistforreview()
{
	$sql="SELECT `id`,`name`,`department`,`PolicyId`,`status` FROM `ethics` where (`status`='Clarified' OR `status`='Initiated') ";
		 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}
public function getalllistforapprover()
{
	$sql="SELECT `id`,`name`,`department`,`PolicyId`,`status` FROM `ethics` where `status`='Reviewed'";
		 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}



public function getAllreviewcomments($id)
{
$sql ="SELECT * FROM `ethics_review` WHERE ethics_id=?";
  $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);
}


public function getalldataforethics()
{
	$sql="SELECT `id`,`name`,`department`,`PolicyId`,`status` FROM `ethics`";
		 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}



public function getChartdata()
{
	$sql="SELECT l.name,l.id,count(*) AS count FROM ethics as e,bu_location as l where e.location=l.id GROUP BY location";
 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}


public function getdatafordepartment($id)
{
$sql ="SELECT d.id as id,d.name as department_name,count(*) AS count FROM ethics as e,bu_location as l,bu_deparment as d where e.location=l.id and l.id=? and e.department=d.id GROUP BY department";
  $dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);
}
public function getemployeedata($id)
{
$sql ="SELECT e.employeeID FROM ethics as e,bu_location as l,bu_deparment as d where e.location=l.id and e.department=d.id and d.id=? GROUP BY department,employeeID";
$dbOps = new DBOperations();
        $paramArray = array($id);
        return $dbOps->fetchData($sql, 'i', $paramArray);
    }


public function getdepartmentformchart()
{
	$sql="SELECT d.name as department_name,e.employeeID, count(*) AS count FROM ethics as e,bu_deparment as d where e.department=d.id GROUP BY department,employeeID";
$dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}
public function ManagementReject()
{
	$sql="SELECT count(*) as count FROM `ethics` WHERE status='Management Rejected'";
 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}
public function Approved()
{
	$sql="SELECT count(*) as count FROM `ethics` WHERE status='Approved'";
 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}

public function Rejected()
{
	$sql="SELECT count(*) as count FROM `ethics` WHERE status='Rejected'";
 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}
public function REQUESTS()
{
	$sql="SELECT count(*) as count FROM `ethics`";
 $dbOps = new DBOperations();
        return $dbOps->fetchData($sql);	
}


}
?>