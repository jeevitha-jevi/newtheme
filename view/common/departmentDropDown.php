<?php
require_once '../../php/company/companyDepartmentManager.php';
$manager = new CompnayDepartmentManager();
$allDepartments=$manager->getAllCompaniesDepartment();

?>
      
 <div class="input-group select2-bootstrap-append">
  <select id="department" class="form-control selecte2-selection arrow">
      <option>...select...</option>          
<?php foreach($allDepartments as $department){
                          
                ?>
                <option value="<?php echo $department['id'] ?>"><?php echo $department['name'] ?></option>

                <?php  } ?>
              </select>

             
            </div>
      
       <script type="text/javascript">
         $(document).ready(function() {
  $('#department').multiselect();
});
       </script>
