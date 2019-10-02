<div class="form-group" >

  <select id="storage" class="form-control" >
    <option></option>
      
      <?php
      error_log("all clause disposal".print_r($allClausesControls,true)); 
      foreach($allClausesControls as $clauses)
      {
          ?>
         
          
      <?php
          
     
       optionData($clauses);

      }
  

  ?>
  </select>
</div>