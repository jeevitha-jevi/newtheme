<?php
    require_once __DIR__.'/../../php/common/dashboard.php';
    
    $metaData = new dashboard();
    $projectId = $_REQUEST['projectId'];
    $allTaskList = $metaData->getAllTask($projectId);

    function manage(){
      $metaData = new dashboard(); 

      switch ($_POST['action']){
        case 'create':
          $taskData = getDataFromRequest();            
          $metaData->createTask($taskData);
          break;
        case 'update':
          $taskData = getDataFromRequest();            
          $metaData->updateTask($taskData);
          break;        
        default :
          break;     	
      }            
      
    }

    function getDataFromRequest(){
      $taskData = new stdClass();
      $taskData->id = $_POST['id'];
      $taskData->project = $_POST['project'];
      $taskData->task = $_POST['task'];
      $taskData->description = $_POST['description'];
      $taskData->duedate = $_POST['duedate'];
      $taskData->assignee = $_POST['loggedInUser'];
      $taskData->assignedto =$_POST['assignedto'];      
      $taskData->attachment = $_POST['attachment']; 
      $taskData->status = $_POST['status']; 
      $taskData->taskId=$_POST['taskId']; 
      error_log("updateTask".print_r($taskData,true));     
      return $taskData;
    } 


    manage();
    
?>
<div class="col-md-7">
        <div class="todo-tasks-container">
          <div class="todo-head">
            <button class="btn btn-square btn-sm red todo-bold" data-toggle="modal" data-target="#todo-task-modal" onclick="newTaskModal()">New Task</button>
            <h3>
              <span class="todo-grey">Task            
          </div>
          <ul class="todo-tasks-content">
            <?php
             for ($i=0; $i <count($allTaskList) ; $i++) {           
            ?>
            <li class="todo-tasks-item">
              <h4 class="todo-inline">
                <a data-toggle="modal" href="#todo-task-modal" onclick="updateTask(<?php  echo $allTaskList[$i]["taskId"] ?>)"><?php echo $allTaskList[$i]["taskName"];?></a>
              </h4>
              <p class="todo-inline todo-float-r"><?php echo $allTaskList[$i]["userName"];?>,
                <span class="todo-red"><?php echo $allTaskList[$i]["dueDate"];?></span>
              </p>
              <input type="hidden" id="taskName<?php echo $allTaskList[$i]["taskId"] ?>" value="<?php  echo $allTaskList[$i]["taskName"] ?>">
              <input type="hidden" id="taskId<?php echo $allTaskList[$i]["taskId"] ?>" value="<?php  echo $allTaskList[$i]["taskId"] ?>">
              <input type="hidden" id="assignedTo<?php echo $allTaskList[$i]["taskId"] ?>" value="<?php  echo $allTaskList[$i]["assignedTo"] ?>">
              <input type="hidden" id="projectTaskId<?php echo $allTaskList[$i]["taskId"] ?>" value="<?php  echo $allTaskList[$i]["projectId"] ?>">
              <input type="hidden" id="dueDate<?php echo $allTaskList[$i]["taskId"] ?>" value="<?php  echo $allTaskList[$i]["dueDate"] ?>">
              <input type="hidden" id="user<?php echo $allTaskList[$i]["taskId"] ?>" value="<?php  echo $allTaskList[$i]["userId"] ?>">
              <input type="hidden" id="description<?php echo $allTaskList[$i]["taskId"] ?>" value="<?php  echo $allTaskList[$i]["description"] ?>">

            </li> 
            <?php           
             }
            ?> 
          </ul>
        </div>
      </div>
