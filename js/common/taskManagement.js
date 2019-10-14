$(document).ready(function () {      
var selector = '.todo-projects-container li';
$(selector).on('click', function(){     
    $(selector).removeClass('todo-active');
    $(this).addClass('todo-active');
});
});
function gettasklist(projectid){ 
    var projectid = {
        'projectId': $('#projectId'+projectid).val()
    }
     $.ajax({
        type: "POST",
        url: "/newtheme/php/common/task.php",
        data: projectid,
        success: function(data){                    
            $('#departmentDrop').html(data);
        }
    });
}
// function showProjectModal(){
//     $('#todo-project-modal').modal('show');
// }
function newTaskModal(){
    debugger
    // $('#taskname').val(" ");
    // $('#description').val(" ");
    // $('#projectname').val(" ");
    // $('#duedate').val(" ");
    // $('#assignedto').val(" ");
    // $('#action').val('create');
    // $('#taskId').val(" ");
    $('#todo-task-modal').modal('show');
}
function updateTask(taskId){
    debugger
    var desc=$('#description'+taskId).val();
    $('#taskname').val($('#taskName'+taskId).val());
    $('#description').val($('#description'+taskId).val());
    $('#projectname').val($('#projectTaskId'+taskId).val());
    $('#duedate').val($('#dueDate'+taskId).val());
    $('#assignedto').val($('#user'+taskId).val());
    $('#action').val('update');
    $('#taskId').val($('#taskId'+taskId).val());
    $('#todo-task-modal').modal('show');
}
function getAction(){
    $('#action').val('create');
}
function getModalDetailsFromModal() { 
    debugger
    var date= $('#duedate').val()
var duedate = date.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
    var taskDetails = {
        'project': $('#projectname').val(),
        'task': $('#taskname').val(),
        'description': $('#description').val(),
        'duedate': duedate,
        'assignedto': $('#assignedto').val(),
        'status': $('#status').val(),
        'action': $('#action').val(),
        'attachment': $('#file').val(),
        'loggedInUser': $('#loggedInUser').val()
    }
    return taskDetails;
}
function saveTask(){    
    debugger
    var taskDetails = getModalDetailsFromModal();
   if(taskDetails.action=='update'){
    taskDetails.taskId=$('#taskId').val();
    }
    $.ajax({
        type: "POST",
        url: "/newtheme/php/common/task.php",
        data: taskDetails
    }).done(function (data) {
        location.reload();
});
}
function saveProject(){
    debugger
    var projectDetails = {
        'action': $('#action').val(),
        'projectname': $('#project_name').val(),
        'projectDescription': $('#projectDescription').val(),
        'assignedto': $('#assignedto1').val()
    }
    $.ajax({
        type: "POST",
        url: "/newtheme/php/common/project.php",
        data: projectDetails
    }).done(function (data) {
           Swal.fire({
              title: "Project Created",
              text: "Your Project Has Been Created",
              type: "success",
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            });
        location.reload();
});
}




