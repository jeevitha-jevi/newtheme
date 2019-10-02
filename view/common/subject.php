<?php
require_once __DIR__.'/../../php/common/dashboard.php';

$manager=new dashboard();
 $show=$manager->showall();
// echo json_encode($show);
?>

    <div class="form-group" >
    
    <button class="btn btn-default btn-block btn-sm">Risk Heat List</button>

<div>
<p id="demo" style="background:#FFFFFF; width:auto;height:40px; overflow:scroll;" class="collapse">
  <ol id="demo" name="RiskDropDown" style="background:#FFFFFF; width:auto;height:460px;overflow: scroll;">
             
    <?php foreach($show as $s){ ?>
    <li value="<?php echo $s['id'] ?>" style="margin-left: -10px;"><button type="button" class="btn btn-default btn-block" style="border:0px; text-align: left;"><?php echo $s['Risk'] ?></button></li>
    <?php } ?>
</ol>
</p>
 
</div>  
</div>