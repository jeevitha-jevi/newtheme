<?php
    require_once __DIR__.'/../../php/user/userManager.php';

    $userManager = new UserManager();
    // 7 is auditee role
    $allAuditors = $userManager->getAllUsersByRole(7,$_SESSION['companyId']);
?>
     


           <select id="auditee" class="form-control">
               <option>...select...</option>                                                                             
         <?php foreach($allAuditors as $auditor){ ?>
    <option value="<?php echo $auditor['userId'] ?>"><?php echo htmlspecialchars($auditor['lastName']) ?></option>
    <?php } ?>
     </select>


 <script type="text/javascript">
         $(document).ready(function() {
  $('#auditee').multiselect();
});
       </script>
                 
