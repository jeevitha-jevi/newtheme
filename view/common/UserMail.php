<?php require_once __DIR__.'/../header.php';?>
<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fresh GRC Admin</title>
    <base href="/freshgrc/">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="metronic/theme/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="metronic/theme/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css">
        <link href="metronic/theme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css">
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="metronic/theme/assets/apps/css/inbox.min.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="metronic/theme/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css">
        <link href="metronic/theme/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color">
        <link href="metronic/theme/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/jquery-ui-1.11.4/jquery-ui.js"></script>      
    <link rel="stylesheet" type="text/css" href="assets/jquery-ui-1.11.4/jquery-ui.css" />    
    <!-- <script src="js/audit/auditManagement.js"></script> -->


    <link href="assets/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="assets/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="assets/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="assets/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="assets/img/favicon.png" rel="icon" type="image/png">
    <link href="assets/img/favicon.ico" rel="shortcut icon">



    <!-- <link rel="stylesheet" href="assets/css/lib/font-awesome/font-awesome.min.css"> -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <style>
        #viewdata {
          margin-left: 235px;
          margin-top: 100px;
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
        
    </style>
</head>


<body class="with-side-menu-compact">

    <?php 
        include '../siteHeader.php';
        $currentMenu = 'auditorAdmin';
        include '../common/leftMenu.php';
        $userRole = $_SESSION['user_role'];
    ?>

</body>
      <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo wysihtml5-supported" style="">
  
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                  
                        <!-- BEGIN PAGE TITLE -->
                       <!--  <div class="page-title">
                            <h1>Inbox
                                <small>user inbox</small>
                            </h1>
                        </div> -->
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->
                      
                        <!-- END PAGE TOOLBAR -->
                   
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                   <!--  <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Apps</span>
                        </li>
                    </ul> -->
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="inbox">
                        <div class="row panel" style="margin-top: 20px;">
                            <div class="col-md-2">
                                <div class="inbox-sidebar">
                                    <a href="javascript:;" data-title="Compose" class="btn red compose-btn btn-block" id="compose" >
                                        <i class="fa fa-edit"></i> Compose </a>
                                    <ul class="inbox-nav">
                                        <li class="active">
                                            <a href="javascript:;" data-type="inbox" data-title="Inbox"> Inbox
                                                <!-- <span class="badge badge-success">3</span> -->
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="javascript:;" data-type="important" data-title="Inbox"> Important </a>
                                        </li>
                                        <li class="">
                                            <a href="javascript:;" data-type="sent" data-title="Sent"> Sent </a>
                                        </li>
                                        <li class="">
                                            <a href="javascript:;" data-type="draft" data-title="Draft"> Draft
                                                <!-- <span class="badge badge-danger">8</span> -->
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:;" class="sbold uppercase" data-title="Trash"> Trash
                                                <!-- <span class="badge badge-info">23</span> -->
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="inbox" data-title="Promotions"> Promotions
                                                <!-- <span class="badge badge-warning">2</span> -->
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-type="inbox" data-title="News"> News </a>
                                        </li>
                                    </ul>
                                  
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="inbox-body" style="height: 301px;" >
                                    <div class="inbox-header">
                                        <h1 class="pull-left">Inbox</h1>
                                        <form class="form-inline pull-right" action="index.html">
                                            <div class="input-group input-medium">
                                                <input type="text" class="form-control" placeholder="Password">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn green">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="inbox-content" style=""><table class="table table-striped table-advance table-hover" id="id1" style="border-radius: 4px;
    border: 1px solid #e7ecf1;">
    <thead>
        <tr>
            <th colspan="3">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="mail-group-checkbox">
                    <span></span>
                </label>
                <div class="btn-group input-actions">
                    <a class="btn btn-sm blue btn-outline dropdown-toggle sbold" href="javascript:;" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-pencil"></i> Mark as Read </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-ban"></i> Spam </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-trash-o"></i> Delete </a>
                        </li>
                    </ul>
                </div>
            </th>
            <th class="pagination-control" colspan="3">
                <span class="pagination-info"> 1-30 of 789 </span>
                <a class="btn btn-sm blue btn-outline">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="btn btn-sm blue btn-outline">
                    <i class="fa fa-angle-right"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="unread" data-messageid="1">
            <td class="inbox-small-cells">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="mail-checkbox" value="1">
                    <span></span>
                </label>
            </td>
            <td class="inbox-small-cells">
                <i class="fa fa-star"></i>
            </td>
            <td class="view-message hidden-xs"> Prasanna venkadesh</td>
            <td class="view-message "> New server for datacenter needed </td>
            <td class="view-message inbox-small-cells">
                <i class="fa fa-paperclip"></i>
            </td>
            <td class="view-message text-right">Jan 3</td>
        </tr>
        <tr class="unread" data-messageid="2">
            <td class="inbox-small-cells">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="mail-checkbox" value="1">
                    <span></span>
                </label>
            </td>
            <td class="inbox-small-cells">
                <i class="fa fa-star"></i>
            </td>
            <td class="view-message hidden-xs"> Gokul Kandhasamy </td>
            <td class="view-message"> Please help us on customization of new secure server </td>
            <td class="view-message inbox-small-cells"> </td>
            <td class="view-message text-right"> March 17 </td>
        </tr>
        <tr data-messageid="3">
            <td class="inbox-small-cells">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="mail-checkbox" value="1">
                    <span></span>
                </label>
            </td>
            <td class="inbox-small-cells">
                <i class="fa fa-star"></i>
            </td>
            <td class="view-message hidden-xs"> Akash Ramanathan </td>
            <td class="view-message"> Lorem ipsum dolor sit amet </td>
            <td class="view-message inbox-small-cells"> </td>
            <td class="view-message text-right"> March 17 </td>
        </tr>
     </tbody>
</table>

</div>


    <div class="col-md-10" >
                                <div class="inbox-body" id="id" style="display: none;    width: 132%;margin-left: -36px;margin-top: -182px !important;">
                                    <div class="inbox-header">
                                        <h1 class="pull-left">Compose</h1>
                                        <form class="form-inline pull-right" >
                                            <div class="input-group input-medium">
                                                <input type="text" class="form-control" placeholder="Password">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn green">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="inbox-content" style=""><form class="inbox-compose form-horizontal" id="fileupload" action="#" method="POST" enctype="multipart/form-data">
    <div class="inbox-compose-btn">
        <button class="btn green">
            <i class="fa fa-check"></i>Send</button>
        <button class="btn default inbox-discard-btn">Discard</button>
        <button class="btn default">Draft</button>
    </div>
    <div class="inbox-form-group mail-to">
        <label class="control-label">To:</label>
        <div class="controls controls-to">
            <input type="text" class="form-control" name="to">
            <span class="inbox-cc-bcc">
                <span class="inbox-cc"> Cc </span>
                <span class="inbox-bcc"> Bcc </span>
            </span>
        </div>
    </div>
    <div class="inbox-form-group input-cc display-hide">
        <a href="javascript:;" class="close"> </a>
        <label class="control-label">Cc:</label>
        <div class="controls controls-cc">
            <input type="text" name="cc" class="form-control"> </div>
    </div>
    <div class="inbox-form-group input-bcc display-hide">
        <a href="javascript:;" class="close"> </a>
        <label class="control-label">Bcc:</label>
        <div class="controls controls-bcc">
            <input type="text" name="bcc" class="form-control"> </div>
    </div>
    <div class="inbox-form-group">
        <label class="control-label">Subject:</label>
        <div class="controls">
            <input type="text" class="form-control" name="subject"> </div>
    </div>
    <div class="inbox-form-group">
        <ul class="wysihtml5-toolbar" style=""><li class="dropdown"><a class="btn default dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-font"></i>&nbsp;<span class="current-font">Normal text</span>&nbsp;<b class="caret"></b></a><ul class="dropdown-menu"><li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="div" tabindex="-1" href="javascript:;" unselectable="on">Normal text</a></li><li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" tabindex="-1" href="javascript:;" unselectable="on">Heading 1</a></li><li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" tabindex="-1" href="javascript:;" unselectable="on">Heading 2</a></li><li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" tabindex="-1" href="javascript:;" unselectable="on">Heading 3</a></li><li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" href="javascript:;" unselectable="on">Heading 4</a></li><li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" href="javascript:;" unselectable="on">Heading 5</a></li><li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6" href="javascript:;" unselectable="on">Heading 6</a></li></ul></li><li><div class="btn-group"><a class="btn default" data-wysihtml5-command="bold" title="CTRL+B" tabindex="-1" href="javascript:;" unselectable="on">Bold</a><a class="btn default" data-wysihtml5-command="italic" title="CTRL+I" tabindex="-1" href="javascript:;" unselectable="on">Italic</a><a class="btn default" data-wysihtml5-command="underline" title="CTRL+U" tabindex="-1" href="javascript:;" unselectable="on">Underline</a></div></li><li><div class="btn-group"><a class="btn default" data-wysihtml5-command="insertUnorderedList" title="Unordered list" tabindex="-1" href="javascript:;" unselectable="on"><i class="fa fa-list"></i></a><a class="btn default" data-wysihtml5-command="insertOrderedList" title="Ordered list" tabindex="-1" href="javascript:;" unselectable="on"><i class="fa fa-th-list"></i></a><a class="btn default" data-wysihtml5-command="Outdent" title="Outdent" tabindex="-1" href="javascript:;" unselectable="on"><i class="fa fa-outdent"></i></a><a class="btn default" data-wysihtml5-command="Indent" title="Indent" tabindex="-1" href="javascript:;" unselectable="on"><i class="fa fa-indent"></i></a></div></li><li><div class="btn-group"><a class="btn default" data-wysihtml5-action="change_view" title="Edit HTML" tabindex="-1" href="javascript:;" unselectable="on"><i class="fa fa-pencil"></i></a></div></li><li><div class="bootstrap-wysihtml5-insert-link-modal modal fade"><div class="modal-dialog"> <div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h3>Insert link</h3></div><div class="modal-body"><input value="http://" class="bootstrap-wysihtml5-insert-link-url form-control input-xlarge"><label style="margin-top:5px;"> <input type="checkbox" class="bootstrap-wysihtml5-insert-link-target" checked="">Open link in new window</label></div><div class="modal-footer"><a href="#" class="btn default" data-dismiss="modal">Cancel</a><a href="#" class="btn btn-primary" data-dismiss="modal">Insert link</a></div></div></div></div><a class="btn default" data-wysihtml5-command="createLink" title="Insert link" tabindex="-1" href="javascript:;" unselectable="on"><i class="fa fa-share"></i></a></li><li><div class="bootstrap-wysihtml5-insert-image-modal modal fade"><div class="modal-dialog"> <div class="modal-content"><div class="modal-header"><a class="close" data-dismiss="modal">×</a><h3>Insert image</h3></div><div class="modal-body"><input value="http://" class="bootstrap-wysihtml5-insert-image-url form-control input-xlarge"></div><div class="modal-footer"><a href="#" class="btn default" data-dismiss="modal">Cancel</a><a href="#" class="btn btn-primary" data-dismiss="modal">Insert image</a></div></div></div></div><a class="btn default" data-wysihtml5-command="insertImage" title="Insert image" tabindex="-1" href="javascript:;" unselectable="on"><i class="fa fa-picture-o"></i></a></li></ul><textarea class="inbox-editor inbox-wysihtml5 form-control" name="message" rows="12" style="display: none;"></textarea><input type="hidden" name="_wysihtml5_mode" value="1"><iframe class="wysihtml5-sandbox" security="restricted" allowtransparency="true" frameborder="0" width="0" height="0" marginwidth="0" marginheight="0" style="display: block; background-color: rgb(255, 255, 255); border-collapse: separate; border-color: rgb(194, 202, 216); border-style: solid; border-width: 1px; clear: none; float: none; margin: 0px; outline: rgb(85, 85, 85) none 0px; outline-offset: 0px; padding: 6px 12px; position: static; z-index: auto; vertical-align: baseline; text-align: start; box-sizing: border-box; box-shadow: none; border-radius: 4px; width: 977.156px; height: 242px; top: auto; left: auto; right: auto; bottom: auto;"></iframe>
    </div>
    <div class="inbox-compose-attachment">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <span class="btn green btn-outline fileinput-button">
            <i class="fa fa-plus"></i>
            <span> Add files... </span>
            <input type="file" name="files[]" multiple=""> </span>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped margin-top-10">
            <tbody class="files"> </tbody>
        </table>
    </div>
    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td class="name" width="30%">
                <span>{%=file.name%}</span>
            </td>
            <td class="size" width="40%">
                <span>{%=o.formatFileSize(file.size)%}</span>
            </td> {% if (file.error) { %}
            <td class="error" width="20%" colspan="2">
                <span class="label label-danger">Error</span> {%=file.error%}</td> {% } else if (o.files.valid && !i) { %}
            <td>
                <p class="size">{%=o.formatFileSize(file.size)%}</p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
            </td> {% } else { %}
            <td colspan="2"></td> {% } %}
            <td class="cancel" width="10%" align="right">{% if (!i) { %}
                <button class="btn btn-sm red cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button> {% } %}</td>
        </tr> {% } %} </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade"> {% if (file.error) { %}
            <td class="name" width="30%">
                <span>{%=file.name%}</span>
            </td>
            <td class="size" width="40%">
                <span>{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td class="error" width="30%" colspan="2">
                <span class="label label-danger">Error</span> {%=file.error%}</td> {% } else { %}
            <td class="name" width="30%">
                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size" width="40%">
                <span>{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td colspan="2"></td> {% } %}
            <td class="delete" width="10%" align="right">
                <button class="btn default btn-sm" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}" {% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                    <i class="fa fa-times"></i>
                </button>
            </td>
        </tr> {% } %} </script>
    <div class="inbox-compose-btn">
        <button class="btn green">
            <i class="fa fa-check"></i>Send</button>
        <button class="btn default">Discard</button>
        <button class="btn default">Draft</button>
    </div>
<!-- <span class="alert alert-error">Upload server currently unavailable - Thu Jan 04 2018 10:47:15 GMT+0530 (IST)</span></form></div> -->
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
         
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="metronic/theme/assets/global/plugins/respond.min.js"></script>
<script src="metronic/theme/assets/global/plugins/excanvas.min.js"></script> 
<script src="metronic/theme/assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <!-- <script async="" src="//www.googletagmanager.com/gtm.js?id=GTM-W276BJ"></script><script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script> -->
        <script src="metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="metronic/theme/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
        <script src="metronic/theme/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="metronic/theme/assets/global/scripts/app.min.js" type="text/javascript"></script>
       
       
 <script type="text/javascript">
   $(document).ready(function(){
    $("#compose").click(function(){
      $("#id").toggle();
       
        
    });
});
   
 </script>        
</body>



