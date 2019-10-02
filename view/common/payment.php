<?php 
require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../helpers.php';
require_once __DIR__.'/../../php/user/userManager.php';
//session_start();

$manager=new helpers();
$usermanager=new UserManager();

$res=$manager->hasSubscription($_SESSION['company']);

?>
<!DOCTYPE html>
<html>
    <head lang="en">
	    <meta charset="UTF-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	    <meta http-equiv="x-ua-compatible" content="ie=edge">
	    <title>Fresh GRC Admin</title>
	    <base href="/freshgrc/">

	    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
	    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
	    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>    
	    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />      
        <!-- <script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script> --><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	    <!-- Bootstrap core CSS -->
	    <link href="assets/DataTables/Bootstrap-3.3.6/css/bootstrap.css" rel="stylesheet">
	    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	    <link href="assets/img/favicon.png" rel="icon" type="image/png">
	    <link href="assets/img/favicon.ico" rel="shortcut icon">

        <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/custom.css">

	</head>

	<body class="with-side-menu-compact">

	    <?php 
	        include '../siteHeader.php';
	        $currentMenu = 'auditorAdmin';
	        include '../common/leftMenu.php';
	    ?>
	    <body class="dataTables">
	       <div class="container">
			   <div class="panel" style="margin-top: 90px; margin-left: 65px; border-color: #32c5d2;">
		           <div class="panel-heading text-center" style="background-color: #32c5d2; color: #fff;">Billing</div>
		           <div class="panel-body">
		           <!-- Trial Users -->
		           <?php if($res==0){ ?>
		           <form action="view/common/upgrade.php" method="POST">
		    	        <div class="row">
		    		        <div class="col-md-12" style="margin-top: 25px;">
		    			        <div class="alert alert-danger">
							       <p><strong>Current-Plan :</strong>TRIAL PLAN</p>
							    </div>
		    		        </div>
		    	            <div class="col-md-12" >
		    		            <div class="row">
					         		<div class="col-md-9" style="margin-top: 25px;">
							        	<div class="form-group">
							         	  <label for="sel1">Select Modules</label>
								            <select class="form-control" value="" id="QTY" multiple   style="border-radius: 3px !important;" >
											    <option data-price="30">Audit</option>
											    <option data-price="30">Asset</option>
											    <option data-price="30">Compliance</option>
											    <option data-price="30">Risk</option>
											    <option data-price="30">Policy</option>
											    <option data-price="30">BCPM</option>
											    <option data-price="30">Incident</option>
											    <option data-price="30">Control</option>
											    <option data-price="30">WhistleBlower</option>
											</select>
								       </div>
							        </div>
							        <div class="col-md-3" style="margin-top: 25px;">
								        <div class="form-group">
								           <label for="sel1">Select Number Of Users</label> 
								           <input type="number" name="PPRICE" id="PPRICE" value="1"  >
						                </div>
							        </div>
						        </div>
						        <div class="row">
							        <div class="col-md-offset-4 col-md-4">
							          	<div class="well well-lg text-center" style="margin-top: 60px;">
							          	 <label for="sel1">Total:$</label>
							 	        	<input  id="TOTAL" name="TOTAL" />
								        	<input class="btn btn-primary" id="upgrade"  type="submit" style="margin-top: 30px;" value="upgrade" />
							 	        </div>
							        </div>
						        </div>
		    	            </div>
		    	        </div>
		    	    </form>
		    	    <?php } ?>
		    	<?php if($res!=0){ 

		    		$planDetails=$usermanager->getPlan($res);
		    	 ?>

		    				 <div class="row freshgrc-common-main-head">
        <h2 style="font-family: inherit">You have subscribed to <?php echo $planDetails[0]['name'] ?> pack  </h2>
      </div>
		    	<?php } ?>
		            </div>
		        </div>
	        </div>
	    </body>
	    <script type="text/javascript">
	    	$(document).ready(function() {
	    	
  $('#QTY').on('change', function() {
  $('#TOTAL').val(valueFUnction());
  });
  $('#PPRICE').on('change', function() {
  $('#TOTAL').val(valueFUnction());
  });
});

function valueFUnction(quan) {
	
  var $selection = $('#QTY').find(':selected');
  var quantity = $('#PPRICE').val();
  var total = 0;
  $selection.each(function() {
  total += $(this).data('price') * quantity;
  })
  return total;
}

/* document.getElementById("upgrade").onclick = function () {
        location.href = "/freshgrc/view/common/upgrade.php";
    };*/
	    </script>
	</body>
</html>


