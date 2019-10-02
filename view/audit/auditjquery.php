<?php
require_once "../../php/common/config.php";
require_once 'functions/boardfunctions.php';
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>

  <head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Meeting</title>
    <base href="/freshgrc/">


    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />

    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <!-- metronic link for multiselect -->
    <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="metronic/theme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <!-- end -->
<!-- script link  multi select-->
        <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
         <script src="metronic/theme/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">

  </head>
  <style type="text/css">
  .page-sidebar{
         margin-top: 3%;
      }
      .page-container {
    margin: 0;
    padding: 20px 20px 0;
    position: relative;
}
.page-sidebar.navbar-collapse {
    max-height: none!important;
    position: fixed;
}
.panel-primary {
    border-color: #32c5d2;
  /*margin-top: 20px;*/
    width: 90%;
    margin:auto;
    background-color: #32c5d2;
    margin: 50px 0px 0px 150px;
}
.panel-success
{
background-color: #32c5d2; 
color:white; 
}
.button
{
  margin-left: 46%;
  color:white;
  background-color:#32c5d2;
  border:none; 
  margin-top: 8px;
  border-radius: 24px;
  height:35px;
  width: 95px;
}
label
{
  font-family: "Open Sans",sans-serif;
  font-size: 14px;
  font-weight: 500px;
}
.form-group {
    margin-bottom: 18px;
}
/*#Single_Loss_Expectancy_Before_Safeguard,#Anualized_Loss_Expection_Before_Safeguard,#Single_Loss_Expectancy_After_Safeguard,#Anualized_Loss_Expection_After_Safeguard 
*/{
  border:none;
  /*cursor:text;*/
}
.modal-footer
{
  margin-top: 20px;
}
</style>
<body>

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'riskAdmin';
        ?>
        <div style="margin-top: 40px !important;">
        <?php 
        include 'boardleft.php';
        
        ?>

      </div>
      <?php
      $userRole = $_SESSION['user_role'];
    ?>   

  <body class="dataTables">
    <div class="container" style="width: 90%; margin-left: 110px;">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary" style="border-color:#32c5d2;">
            <div class="panel-heading"  style="background-color: #32c5d2;font-size: 18px !important;">TERMS OF REFERENCE</div>
              <div class="panel-body">
              <div class="clearfix"></div>   
              <?php
              if($_POST)
              {
                boardschedule();
              }
              ?>       
                <form action="" method=POST>
                 <div class="row">
                             <!-- <div class="col-md-12" > -->
                              <div class="col-md-6">
                            <div class="form-group" >
                                <label>Meeting Title</label><br>
                                <input type="text" name="title" class="form-control" style="border: 1px solid #32c5d2;" id="title" value="<?php echo $_POST['title']; ?>">
                            </div>          
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label><br>
                                <input type="date" name="date" class="form-control" style="border: 1px solid #32c5d2;" id="date" value="<?php echo $_POST['date']; ?>">
                            </div>          
                            </div>  
                             </div>
                
                 <div class="row">
                <div class="col-md-6">
                  <label>Purpose</label>
                <textarea type="text" class="form-control" style="border: 1px solid #32c5d2;" id="purpose" name="purpose"><?php echo $_POST['purpose']; ?></textarea>
              </div>
        
              <div class="col-md-6">
                  <label>Responsibilities</label>
                <textarea type="text" class="form-control" style="border: 1px solid #32c5d2;" id="responsibities" name="responsibities"><?php echo $_POST['responsibities']; ?></textarea>
              </div>
            
              <div class="col-md-12">
                  <label>Output</label>
                <textarea type="text" class="form-control" style="border: 1px solid #32c5d2;" id="output" name="output"><?php echo $_POST['output'];?></textarea>
              </div>
            </div>
            
            <div class="row">
             <div class="col-md-6">
                          <div class="form-group" id="user">
                            <div class="form-group">
        <label for="multi-append" class="control-label" style="font-size: 13px;;">Members</label>
                            <?php include '../common/boarduserdropdown.php';?>

                          </div>
                        </div>
                        </div>
             <div class="col-md-6">
                          <div class="form-group" id="admin">
                            <?php include '../common/boardadmindropdown.php';?>
                          </div>
                        </div>
                      </div>
              <div class="row" style="margin-top: 10px;">
                   <div class="col-md-12">
                    <div class="form-group" style="margin-top: 1%;">
                      <?php include '../common/boardfrequencydropdown.php';?>
                  </div>
                   </div>  
                 </div>
              
                    <div>
                    <button type="submit" id="submit" name="submit" data-dismiss="modal" class="btn btn-primary">Schedule</button>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</body>
</html>