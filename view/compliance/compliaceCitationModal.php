<div class="form-group">
<?php
require_once __DIR__.'/../../php/compliance/complianceManager.php';
$id=1;
$manager=new ComplianceManager();
$getData=$manager->getsubclassdata($id);
?>



<table border="1px" width="100%" class="table">	
<?php
for($i=0;$i<count($getData[0]);$i++)
{?>

	<tr class="header"><th colspan="2">MAS Regulatory Policy <?php echo$i;?></th>
	</tr>
<tr>
<th>Live</th>
<td>
<?php
echo $getData[$i]['live']; ?>
</td></tr>

<tr><th>deprecated_by</th>
<td>
<?php
echo $getData[$i]['deprecated_by']; ?>
</td></tr>

<tr><th>deprecation_notes</th>
<td>
<?php
echo $getData[$i]['deprecation_notes'];
?>
</td></tr>

<tr><th>time_created</th>
<td>
<?php
echo $getData[$i]['time_created'];?>
</td></tr>


<tr><th>date_added</th>
<td><?php
echo $getData[$i]['date_added']?>
</td></tr>

<tr><th>time_updated</th>
<td><?php
echo $getData[$i]['time_updated']?>
</td></tr>

<tr><th>date_modified</th>
<td>
<?php
echo $getData[$i]['date_modified'];
?>
</td></tr>

<tr><th>language</th>
<td>
<?php
echo $getData[$i]['language'];
?>
</td></tr>

<tr><th>license_info</th>
<td>
<?php
echo $getData[$i]['license_info'];
?></td></tr>

<tr><th>sort_value</th>
<td><?php
echo $getData[$i]['sort_value'];
?></td></tr>

<tr><th>genealogy</th>
<td><?php
echo $getData[$i]['genealogy'];
?></td></tr>

<tr><th>sort_id</th>
<td><?php
echo $getData[$i]['sort_id'];
?>
</td></tr>

<tr><th>reference</th>
<td><?php
echo $getData[$i]['reference'];
?>
</td></tr>

<tr><th>guidance</th>
<td><?php
echo $getData[$i]['guidance'];
?>
</td></tr>

<tr><th>guidance_as_tagged</th>
<td><?php
echo $getData[$i]['guidance_as_tagged'];
?>
</td></tr>

<tr><th>is_audit_question</th>
<td><?php
echo $getData[$i]['is_audit_question'];
?>
</td></tr>

<tr><th>citation_id</th>
<td><?php
echo $getData[$i]['citation_id'];
?>
</td></tr>

<tr><th>audit_item</th>
<td><?php
echo $getData[$i]['audit_item'];
?>
</td></tr>

<tr><th>asset</th>
<td><?php
echo $getData[$i]['asset'];
?>
</td></tr>

<tr><th>compliance_document</th>
<td><?php
echo $getData[$i]['compliance_document'];
?>
</td></tr>

<tr><th>data_content</th>
<td><?php
echo $getData[$i]['data_content'];
?>
</td></tr>

<tr><th>organizational_function</th>
<td><?php
echo $getData[$i]['organizational_function'];
?>
</td></tr>

<tr><th>record_example</th>
<td><?php
echo $getData[$i]['record_example'];
?>
</td></tr>

<tr><th>metric</th>
<td><?php
echo $getData[$i]['metric'];
?>
</td></tr>

<tr><th>monitored_event</th>
<td><?php
echo $getData[$i]['monitored_event'];
?>
</td></tr>

<tr><th>organizational_task</th>
<td><?php
echo $getData[$i]['organizational_task'];
?>
</td></tr>

<tr><th>record_category</th>
<td><?php
echo $getData[$i]['record_category'];
?>
</td></tr>

<tr><th>configurable_item_with_settings</th>
<td><?php
echo $getData[$i]['configurable_item_with_settings'];
?>
</td></tr>

<tr><th>sentence</th>
<td><?php
echo $getData[$i]['sentence'];
?>
</td></tr>
<tr><th>parent</th>
<td>
	<?php
echo $getData[$i]['parent'];
?>
</td></tr>

<tr><th>check_digit</th>
<td><?php
echo $getData[$i]['check_digit'];
?>
</td></tr>

<tr><th>Ucf id</th>
<td>
	<?php
echo $getData[$i]['ucf_id'];?>
</td>
</tr>



<tr onclick=""><th colspan="2">Citation Control</th>

</tr>


<?php
}
?>
</table>

</div>
<script>
$(document).ready(function() {
  //Fixing jQuery Click Events for the iPad
  var ua = navigator.userAgent,
    event = (ua.match(/iPad/i)) ? "touchstart" : "click";
  if ($('.table').length > 0) {
    $('.table .header').on(event, function() {
      $(this).toggleClass("active", "").nextUntil('.header').css('display', function(i, v) {
        return this.style.display === 'table-row' ? 'none' : 'table-row';
      });
    });
  }
})
</script>