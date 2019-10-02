<?php
    require_once __DIR__.'/../../php/common/metaData.php';

    $metaData = new MetaData();
    $allCompanies = $metaData->getAllCompanies();
?>
   
<html>
 
    <div class="form-group">
       <label for="single-append-radio">Company</label>
          <div class="input-group select2-bootstrap-prepend">
               <span class="input-group-addon"></span>
                     
                       <select id="company" class="form-control " onchange="getLocation()" >
                         <option></option>
                                               
        <?php foreach($allCompanies as $company){ ?>
    <option value="<?php echo $company['id'] ?>"><?php echo $company['name'] ?></option>
    <?php } ?>
                                               
                                               
  </select>
    </div>
      </div>
        
     

       
    </body>
    </html>
