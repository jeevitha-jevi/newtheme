<?php require_once __DIR__.'/../header.php';
      require_once __DIR__.'/../../php/compliance/complianceManager.php'; 
      $manager=new complianceManager();
      $uploadedFiles=$manager->getAllUploadedFiles($_SESSION['company']);
      error_log("all uploaded Files".print_r($uploadedFiles,true));
      $delim="_";
      ?>
 <head lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ComplianceTemplate</title>
  <base href="/freshgrc/">  
  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
   <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
  <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" /> 
  <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
  <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" /> 
  <link href="metronic/theme/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />  
  <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
  <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
  <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" /> 
  <link rel="shortcut icon" href="favicon.ico" />
  <!-- <script src="js/common/userProfile.js"></script>  -->
  <script type="text/javascript" src="js/compliance/importLibrary.js"></script>
  </head> 
  <body >
    <?php
      include '../siteHeader.php'; 
      include '../../php/policy/left.php';
      // include '../common/leftMenu.php';
      $currentMenu = 'auditorAdmin';      
      $userRole = $_SESSION['user_role'];
    ?>  
  </body>
  <body>
    <div class="page-content-wrapper">      
      <div class="page-content">                                 
    
<div class="profile-content">
              <div class="row">
                <div class="col-md-12">                     
                  <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                      <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Library</span>
                      </div>
                      <ul class="nav nav-tabs">
                        <li>
                          <a href="#tab_1_1" data-toggle="tab">Download</a>
                        </li>
                        <li>
                          <a href="#tab_1_2" data-toggle="tab">Template</a>
                        </li>                                                                          
                      </ul>
                    </div>
                    <div class="portlet-body">
                      <div class="tab-content">                         
                        <div class="tab-pane" id="tab_1_1">
                          <form role="form" action="#">
                            <div class="form-group">
                              <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $_SESSION['user_id'] ?>"> 
                              <input type="hidden" name="action" id="action">                                         
                            </div>
                            <table class="table">
                              <thead>
                                <tr>
                                  <td>
                                   <b>File
                                  </td>
                                  <td>
                                    <b>Action
                                  </td>
                                </tr>
                              </thead>
                              <tbody>
                                <?php for($i=0;$i<count($uploadedFiles);$i++){ ?>
                                <tr>
                                  <td><?php echo $uploadedFiles[$i]['imported_file_name'] ?></td>
                                  <td><a href="/freshgrc/uploadedFiles/compliance/success/<?php echo $uploadedFiles[$i]['id'].$delim.$uploadedFiles[$i]['imported_file_name']?>" download>Download</a></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </form>
                        </div>                            
                        <div class="tab-pane active" id="tab_1_2">                          
                           <form action="#" role="form" style="margin:5px;">
                            <div class="form-group">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="uploadedFiles/auditeeFiles/template.jpg" onclick="window.location.href='assets/template.xlsx'" alt="avatar" id="" style="width: 200px;height: 150px;" /> </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div> 
                                <label for="complianceCsv" aria-hidden="true">
                                <i class="btn btn-danger btn-block fa fa-file-excel-o">  Import Library</i>
                                <input type="file" style="display:none" onchange= "importCsv()" id="complianceCsv"/>
                                </label>                                 
                                </div>
                              </div>
                               
                              
                              <div class="clearfix margin-top-10">
                                <span class="label label-danger">NOTE! </span>
                                <span>Please Click the excel image to download template and please upload the filled library in csv format</span>
                              </div>
                            </div>                            
                          </form>
                        </div>                                          
                      </div>
                    </div>
                  </div>                     
                </div>
              </div>
            </div>
      </body>