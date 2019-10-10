<?php require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/common/saveChat.php';
$manager = new ChatManager();
$userlist = $manager->getAllUsersForChat();
$loggedInUser=$_SESSION['user_id'];
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
    <script src="js/common/chatManagement.js"></script>


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">
    <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="metronic/theme/assets/layouts/layout6/css/layout.min.css" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css">
   <!--  <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css"> -->


    <script src="metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
       
        <script src="metronic/theme/assets/layouts/global/scripts/quick-sidebar.js" type="text/javascript"></script> 

    <style>
        #viewdata {
          margin-left: 235px;
          margin-right: 135px;
          margin-bottom: 40px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        td {
            height: 50px;
            vertical-align: middle;
        }

        i.fa-vibe {
            content: "";
            background-image: url('complaints.png');

            width: 50px;
            height: 50px;
            display: inline-block;
            background-position: center;
            background-size: cover;
        }
        label{
        font-weight: 600;
        }
        body{
          font-size: 14px;
        }
        body, h1, h2, h3, h4, h5, h6 {
          font-family: "Open Sans",sans-serif;
        }
        .hover{
          color:none;
        }
        .panel{
          background-color: #fff;
          border: 1px solid #32c5d2;
          margin-bottom: 20px;
          box-shadow: none!important;
          border-radius: 0!important;
          color: rgba(0,0,0,0.87);
          padding: 20px;
          width: 1150px;

        }
        .btn{
          border-radius: 0px !important;
          border: none !important;
        }
        .form-control{
              border-radius: 0px;
        }
        .label{
          font-size: bold;
        }
        .panel-heading{
          background-color: #32c5d2; color:#fff;
          width: 1150px;margin-left: -20px;margin-top: -21px;font-weight: 600
        }
        .modal-content{
          border-radius: 0px;
          border: none;
          width: 600px;
        }
        .modal-header{
          background-color: #3bc5d2;height: 60px;
                    color: #fff;
        }
        .split{
          width: 300px;padding-right: 15px
        }
        .split1{
          width: 290px;padding-left: 15px;padding-right: 15px
        }
        .split2{
          margin-left: 295px;margin-top: -69px;width: 290px;
        }
      .page-container {
    /* margin: 0; */
    padding: 20px 20px 0;
    position: relative;
    margin-top: 53px !important;
}

    </style>
</head>


<body class="with-side-menu-compact">

  

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../../php/policy/left.php';
        $userRole = $_SESSION['user_role'];
    ?>
    



   

  
   <body class="" style="background: #ecf0f4">
               <button type="button" class="quick-sidebar-toggler" title="Chat" data-toggle="collapse">
                    <span class="sr-only">Toggle Quick Sidebar</span>
                    <span style="font-size:20px;cursor:pointer">&#128172</span>
                </button>
               
            <!-- </div>
        </div> -->
        <!-- END CONTAINER -->
        <!-- BEGIN QUICK SIDEBAR -->
        <a href="javascript:;" class="page-quick-sidebar-toggler">
           
            <span style="font-size:15px;cursor:pointer" title="Close">&#10060</span>
        </a>
         <input type="hidden" class="form-control" id="loggedInUser" value="<?php echo $loggedInUser  ?>">
                                   
        <div class="page-quick-sidebar-wrapper" id="chatsidebar" data-close-on-body-click="false" >
            <div class="page-quick-sidebar" style="margin-top: 70px;">
                
                <div class="tab-content">
                    <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                        <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
                            <h3 class="list-heading">Chat</h3>
                            <ul class="media-list list-items">
                                <!-- <li class="media"> -->
                                   <!--  <div class="media-status">
                                        <span class="badge badge-success"></span>
                                    </div> -->
                                    <!-- <img class="media-object" src="metronic/theme/assets/layouts/layout/img/avatar3.jpg" alt="..."> -->
                                    
                                    <!-- <div class="media-body"> -->
                                    <!-- <input  type="button" > -->
                                    <!-- <p id="username"></p> -->
                                    <?php 
                                           
                                         for($i=0;$i<count($userlist);$i++) { 
                                            $userid = $userlist[$i]['id'];
                                            $username =  $userlist[$i]['last_name'];
                                            ?>
                                            <li class="media" onclick ="UsersForid(<?php echo $userid ?>)">
                                              <div class="media-body"  id="user<?php echo $userid ?>" value="<?php echo $userid;?>" ><?php echo "<h4>" . $username . "</h4>" ?>
                                                  <input type="hidden"  id="userid<?php echo $userid ?>" value="<?php echo $userid;?>" >
                                              </div></li>
                                            <?php
                                         }
                                    ?>

                                        <!-- <h4 class="media-heading">dfgdfxvxc</h4> -->
                                        <!-- <div class="media-heading-sub" ></div> -->
                                    <!-- </div> -->
                                <!-- </li> -->

                               <!--  <li class="media">
                                    <img class="media-object" src="metronic/theme/assets/layouts/layout/img/avatar1.jpg" alt="...">
                                    <div class="media-body">
                                        <h4 class="media-heading">Nick Larson</h4>
                                        <div class="media-heading-sub"> Art Director </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-status">
                                        <span class="badge badge-danger"></span>
                                    </div>
                                    <img class="media-object" src="metronic/theme/assets/layouts/layout/img/avatar4.jpg" alt="...">
                                    <div class="media-body">
                                        <h4 class="media-heading">Deon Hubert</h4>
                                        <div class="media-heading-sub"> CTO </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="media-object" src="metronic/theme/assets/layouts/layout/img/avatar2.jpg" alt="...">
                                    <div class="media-body">
                                        <h4 class="media-heading">Ella Wong</h4>
                                        <div class="media-heading-sub"> CEO </div>
                                    </div>
                                </li> -->
                            </ul>
                           
                          
                        </div>
                        <!-- <input type="hidden" class="form-control" id="userid" value="<?php echo $userid  ?>"> -->
      
                            <div class="page-quick-sidebar-item" id="chatid">

                            <div class="page-quick-sidebar-chat-user">

                                <div class="page-quick-sidebar-nav">
                                    <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                        <i class="icon-arrow-left"></i>Back</a>
                                </div>
                                 <div class="page-quick-sidebar-chat-user-messages"  id="" > 



                        <div id="chatTemplate"></div>



                        <div class="page-quick-sidebar-chat-user-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Type a message here..." id="usermessage">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn green" onclick ="saveuserChat()"  >
                                              <i class="fa fa-comments" aria-hidden="true"></i>
                                             </button>
                                        </div>
                                    </div>
                                </div>
                                   
                            </div>
                        </div>


        <!-- <script src="metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
       
        <script src="metronic/theme/assets/layouts/global/scripts/quick-sidebar.js" type="text/javascript"></script> -->

                      
                    </div>
                 
                
                </div>
         
        
        
      
     
        <script src="metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
       
        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>

        <!-- <script src="metronic/theme/assets/layouts/layout6/scripts/layout.min.js" type="text/javascript"></script> -->
        <script src="metronic/theme/assets/layouts/global/scripts/quick-sidebar.js" type="text/javascript"></script>

        </div></div></div></body>
       
    </body>




</html>
