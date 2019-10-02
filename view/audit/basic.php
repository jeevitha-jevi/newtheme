<?php 
require_once __DIR__.'/../../php/audit/auditManager.php';
$manager=new AuditManager();
$kickofftable=$manager->kickoff();

?>
<!DOCTYPE html>

<html lang="en" >

    <head><!--begin::Base Path (base relative path for assets of this page) -->
<base href="/metronics/"><!--end::Base Path -->
        <meta charset="utf-8"/>

        <title>Metronic | Basic Examples</title>
        <meta name="description" content="Basic datatables examples">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">        <!--end::Fonts -->

                    <!--begin::Page Vendors Styles(used by this page) -->
                            <link href="./assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
                        <!--end::Page Vendors Styles -->
        
        
        <!--begin:: Global Mandatory Vendors -->
<link href="./assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->

<link href="./assets/vendors/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/custom/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/custom/vendors/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/custom/vendors/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
<link href="./assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Styles(used by all pages) -->
                    
                    <link href="./assets/css/demo12/style.bundle.css" rel="stylesheet" type="text/css" />
                <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->
                <!--end::Layout Skins -->

        <link rel="shortcut icon" href="./assets/media/logos/favicon.ico" />
    </head>
    <!-- end::Head -->

    <!-- begin::Body -->
    <body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading"  >

       
    	<!-- begin:: Page -->
	
<!-- begin:: Header Mobile -->

<!-- end:: Header Mobile -->
	
<!-- end:: Aside -->			
			
<!-- end: Header Menu -->		<!-- begin:: Header Topbar -->
<div class="kt-header__topbar">

    
  
<!--end: Notifications --><!--begin: Quick Actions -->
    
    <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
            <span class="kt-header__topbar-icon">
                                    <i class="flaticon2-gear"></i>
                            </span>
        </div>
       
        </div>
    </div>

	
</div>
<!-- end:: Header Topbar --></div>
<!-- end:: Header -->

				<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
											
<!-- begin:: Subheader -->

<!-- end:: Subheader -->
					
					<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	

<div class="kt-portlet kt-portlet--mobile">
	<div class="kt-portlet__head kt-portlet__head--lg">
	
		<div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
	
</div>		</div>
	</div>

	<div class="kt-portlet__body">
		<!--begin: Datatable -->
		<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
									<thead>
			  						<tr>
				  									<th>Audit ID</th>
				  									<th>Create Date</th>
				  									<th>Title</th>
				  									<th>Compliance Name</th>
				  									<th>Start Date</th>
				  									<th>End Date</th>
				  									<th>Audit Status</th>
				  									<th>Action</th>
				  							
				  						</tr>
						</thead>
						<tbody>
							<?php  
							foreach($kickofftable as $kickoff)
							{ ?>
							<tr>
								<td><?php echo $kickoff['id']; ?></td>
								<td><?php echo $kickoff['create_date'];?></td>
								<td><?php echo $kickoff['auditTitle'];?></td>
								<td><?php echo $kickoff['compliance'];?></td>
								<td><?php echo $kickoff['start_date'];?></td>
								<td><?php echo $kickoff['end_date'];?></td>
								<td><?php echo $kickoff['status'];?></td>
								<td><a class="btn btn-primary" href="/metronics/view/audit/auditDoPage.php?AuditID=<?php echo $kickoff['id']; ?>">Kickoff</a></th>

							</tr>
						S
						<?php } ?>
						</tbody>
			
								
			
					</table>
		<!--end: Datatable -->
	</div>
</div>	</div>
<!-- end:: Content -->				</div>

					</div>
		</div>
	</div> 
        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {"colors":{"state":{"brand":"#2c77f4","light":"#ffffff","dark":"#282a3c","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};
        </script>
        <!-- end::Global Config -->

    	<!--begin:: Global Mandatory Vendors -->
<script src="./assets/vendors/general/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="./assets/vendors/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="./assets/vendors/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
<script src="./assets/vendors/general/moment/min/moment.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="./assets/vendors/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
<script src="./assets/vendors/general/wnumb/wNumb.js" type="text/javascript"></script>
<script src="./assets/js/demo12/scripts.bundle.js" type="text/javascript"></script>
<script src="./assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
 <script src="./assets/js/demo12/pages/crud/datatables/basic/basic.js" type="text/javascript"></script>
                        <!--end::Page Scripts -->
            </body>
    <!-- end::Body -->
</html>
