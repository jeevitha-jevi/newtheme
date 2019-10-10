
<?php
require_once '../../php/common/dashboard.php';


$manager = new dashboard();
$allProjects = $manager->getAllProjectForTask();


?>

 <!-- <label for="projectname">Project Name</label> -->
    <select id="projectname" name="projectnameDropDown" class="form-control">
    <option>--Select Project--</option>    
    <?php foreach($allProjects as $projects){ ?>
    <option value="<?php echo $projects['id'] ?>"><?php echo $projects['project_name'] ?></option>
    <?php } ?>
</select>


		