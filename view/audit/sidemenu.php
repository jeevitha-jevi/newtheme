<!DOCTYPE html>
<html>
<head>
	<title> Side Menu</title>
	<base href="/newtheme/">
</head>
<body>

	<div class="kt-grid kt-grid--hor kt-grid--root" >
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<!-- begin:: Aside -->
				<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- begin:: Aside -->
					<div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<?php if($_SESSION['user_role']=='auditor') {?>
							<a href="view/audit/auditDashboard.php">
								<img src=" ./assets/media/logos/fixnix.png" alt="" width="100px" height="100px" />
							</a>
						<?php } ?>
						<?php if($_SESSION['user_role']=='auditee') {?>
							<a href="view/audit/auditDashboard.php">
								<img src=" ./assets/media/logos/fixnix.png" alt="" width="100px" height="100px" />
							</a>
						<?php } ?>
							<?php if($_SESSION['user_role']=='super_admin') {?>
							<a href="view/common/overview.php">
								<img src=" ./assets/media/logos/fixnix.png" alt="" width="100px" height="100px" />
							</a>
						<?php } ?>
						</div>
					</div>

					<!-- end:: Aside -->

					<!-- begin:: Aside Menu -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">

						<div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
							<?php if($_SESSION['user_role']=='auditor'){?>
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-gear"></i><span class="kt-menu__link-text">Audit</span></a></li>
								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/plan.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Plan</span></a>
								</li>
								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditCreateAdmin.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Kickoff</span></a>
								</li>

								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditPerformAdmin.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-drop"></i><span class="kt-menu__link-text">Review</span></a></li>

								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditPublished.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-analytics-2"></i><span class="kt-menu__link-text"> Reports</span></a></li>
						
						
							</ul> 
						<?php } ?>
							<?php 
							if($_SESSION['user_role']=='auditee') { ?>
{
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-gear"></i><span class="kt-menu__link-text">Audit</span></a></li>
								
								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditPrepareAdmin.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Respond</span></a>
								</li>

								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditReturnAdmin.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-drop"></i><span class="kt-menu__link-text">Followup</span></a></li>

								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditPublished.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-analytics-2"></i><span class="kt-menu__link-text"> Reports</span></a></li>
						
						
							</ul>
						<?php } ?>
						<?php 
							if($_SESSION['user_role']=='super_admin') { ?>
{
							<ul class="kt-menu__nav ">
								
								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Regulatory Engine</span></a>
								</li>
								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Audit</span></a>
								</li>

								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-drop"></i><span class="kt-menu__link-text">Risk</span></a></li>

								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-analytics-2"></i><span class="kt-menu__link-text"> Compliance</span></a></li>
						
					           	<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Policy</span></a></li>
					           		<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-protected"></i><span class="kt-menu__link-text">Asset</span></a>
								</li>
									<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-mail-1"></i><span class="kt-menu__link-text">Incident</span></a>
								</li>
								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Disaster</span></a>
								</li>
								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Bcpm</span></a>
								</li>
								<li class="kt-menu__item " aria-haspopup="true"><a href="view/audit/auditDashboard.php" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-graph"></i><span class="kt-menu__link-text">Board</span></a>
								</li>
							</ul>
						<?php } ?>
						</div>


</body>
</html>
		