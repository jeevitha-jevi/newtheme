<?php require_once __DIR__.'/../header.php';
require_once __DIR__.'/../../php/common/saveChat.php';
$loggedInUser=$_SESSION['user_id'];
$userid=$_POST['userId'];
$chatData=new StdClass();
$chatData->senderId=$loggedInUser;
$chatData->receiverId=$userid;
$manager = new ChatManager();
$chatHistorySent=$manager->getAllChatHistory($chatData);
// print_r($chatHistorySent);
error_log("inside chat template".print_r($chatHistorySent,true));

?>

<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">

    <!-- <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" /> -->
    <!-- <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script> -->
    <!-- <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>       -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />     -->
    <!-- <script src="js/common/chatManagement.js"></script> -->
    <!-- <script src="js/common/chatTemplate.js"></script> -->


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

    
  
</head>

  <!--  <body >
    <input type="hidden" class="form-control" id="userid" value="<?php echo $userid  ?>">
      
   <div class="page-quick-sidebar-item" id="chatid">

                            <div class="page-quick-sidebar-chat-user">

                                <div class="page-quick-sidebar-nav">
                                    <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                        <i class="icon-arrow-left"></i>Back</a>
                                </div> -->
                                            <!--        
                                            <div class="page-quick-sidebar-chat-user-messages"  id="userid<?php echo $userid;?>" >  -->
<body>                             <input type="hidden" class="form-control" id="userid" value="<?php echo $userid  ?>">
                                            <?php 
                                           for($i=0;$i<count($chatHistorySent);$i++) { 
                                             
                                           
                                            $message =  $chatHistorySent[$i]['message'];
                                            
                                            if($chatHistorySent[$i]['sender_id']==$loggedInUser && $chatHistorySent[$i]['receiver_id']==$chatData->receiverId)
                                            {
                                          ?>

                                            <div class="post out" id="senduser<?php echo $chatHistorySent[$i]['id'] ?> " >
                                        <!-- <img class="avatar" alt="" src="metronic/theme/assets/layouts/layout/img/avatar3.jpg" /> -->
                                        
                                            <div class="message" id="senduser">
                                            <span class="arrow"></span>
                                            <a href="javascript:;" class="name"></a>
                                            <span class="datetime"></span>
                                           
                                           
                                         <p style="float:right" class="body"><?php echo $message ?> </p><br><br>
                                        </div>
                                            </div>
                                       
                                       <?php }
                                       if($chatHistorySent[$i]['sender_id']==$chatData->receiverId && $chatHistorySent[$i]['receiver_id']==$loggedInUser)
                                            {
                                       ?>
                                
                              <div class="post in" id="receiveuser<?php echo $chatHistorySent[$i]['id'] ?>">
                                        <!-- <img class="avatar" alt="" src="metronic/theme/assets/layouts/layout/img/avatar2.jpg" /> -->
                                        <div class="message"  >
                                            <span class="arrow"></span>
                                            <a href="javascript:;" class="name"></a>
                                            <span class="datetime"></span>
                                           
                                           
                                         <p style="float:left" class="body"><?php echo $message ?> </p> <br><br>   
                                        </div>
                                     </div>
                                         <?php
                                         }
                                     }
                                    ?>

                        
                                         </body>
                                         </html>
                  
                                
                                
                               
 
                                           
                                       
                                <!-- <div class="page-quick-sidebar-chat-user-form">
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

        <script src="metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
       
        <script src="metronic/theme/assets/layouts/global/scripts/quick-sidebar.js" type="text/javascript"></script>
    </body>



</html> -->












