<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Pages - Admin Dashboard UI Kit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN Vendor CSS-->
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- BEGIN Pages CSS-->
    <link href="pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
        <link href="pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
    }
    </script>
  </head>
  <body class="fixed-header">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar" data-pages="sidebar">
      <div id="appMenu" class="sidebar-overlay-slide from-top">
      </div>
      <!-- BEGIN SIDEBAR HEADER -->
      <div class="sidebar-header">
        <img src="assets/img/logo_white.png" alt="logo" class="brand" data-src="assets/img/logo_white.png" data-src-retina="assets/img/logo_white_2x.png" width="78" height="22">
        <div class="sidebar-header-controls">
          <button data-pages-toggle="#appMenu" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" type="button"><i class="fa fa-angle-down fs-16"></i>
          </button>
          <button data-toggle-pin="sidebar" class="btn btn-link visible-lg-inline" type="button"><i class="fa fs-12"></i>
          </button>
        </div>
      </div>
      <!-- END SIDEBAR HEADER -->
      <!-- BEGIN SIDEBAR MENU -->
      <div class="sidebar-menu">
        <ul class="menu-items">
          <li class="m-t-30">
            <a href="#" class="detailed">
              <span class="title">Page 1</span>
              <span class="details">234 notifications</span>
            </a>
            <span class="icon-thumbnail "><i class="pg-mail"></i></span>
          </li>
          <li class="">
            <a href="#">
              <span class="title">Page 2</span>
            </a>
            <span class="icon-thumbnail "><i class="pg-social"></i></span>
          </li>
          <li class="">
            <a href="javascript:;">
              <span class="title">Page 3</span>
              <span class=" arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-grid"></i></span>
            <ul class="sub-menu">
              <li class="">
                <a href="#">Sub Page 1</a>
                <span class="icon-thumbnail">sp</span>
              </li>
              <li class="">
                <a href="#">Sub Page 2</a>
                <span class="icon-thumbnail">sp</span>
              </li>
              <li class="">
                <a href="#">Sub Page 3</a>
                <span class="icon-thumbnail">sp</span>
              </li>
            </ul>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
      <!-- START PAGE HEADER WRAPPER -->
      <!-- START HEADER -->
      <div class="header ">
        <!-- START MOBILE CONTROLS -->
        <div class="container-fluid relative">
          <!-- LEFT SIDE -->
          <div class="pull-left full-height visible-sm visible-xs">
          </div>
          <div class="pull-center hidden-md hidden-lg">
            <div class="header-inner">
              <div class="brand inline">
                <img src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png" data-src-retina="assets/img/logo_2x.png" width="78" height="22">
              </div>
            </div>
          </div>
          <!-- RIGHT SIDE -->
          <div class="pull-right full-height visible-sm visible-xs">
            <!-- START ACTION BAR -->
            <div class="header-inner">
              <a href="#" class="btn-link visible-sm-inline-block visible-xs-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
                <span class="icon-set menu-hambuger-plus"></span>
              </a>
            </div>
            <!-- END ACTION BAR -->
          </div>
        </div>
        <!-- END MOBILE CONTROLS -->
        <div class=" pull-left sm-table hidden-xs hidden-sm">
          <div class="header-inner">
            <div class="brand inline">
              <img src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png" data-src-retina="assets/img/logo_2x.png" width="78" height="22">
            </div>

            <!-- END NOTIFICATIONS LIST -->
            </div>
        </div>
        <div class=" pull-right">
          <!-- START User Info-->
          <div class="visible-lg visible-md m-t-10">
            <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
              <span class="semi-bold">Usuario</span> <span class="text-master">Usuario</span>
            </div>
          </div>
          <!-- END User Info-->
        </div>
      </div>
      <!-- END HEADER -->
      <!-- END PAGE HEADER WRAPPER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
          <!-- START JUMBOTRON -->
          <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
              <div class="inner">
                <!-- START BREADCRUMB -->
                <ol class="breadcrumb">
                  <li>
                    <p>Pages</p>
                  </li>
                  <li><a href="#" class="active">Barebone template</a>
                  </li>
                </ol>
                <!-- END BREADCRUMB -->
              </div>
            </div>
          </div>
          <!-- END JUMBOTRON -->
          <!-- START CONTAINER FLUID -->
          <div class="container-fluid container-fixed-lg">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <!-- END PLACE PAGE CONTENT HERE -->
          </div>
          <!-- END CONTAINER FLUID -->
        </div>
        <!-- END PAGE CONTENT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    <!--START QUICKVIEW -->
    <div id="quickview" class="quickview-wrapper" data-pages="quickview">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        <li class="">
          <a href="#quickview-notes" data-toggle="tab">Notes</a>
        </li>
        <li>
          <a href="#quickview-alerts" data-toggle="tab">Alerts</a>
        </li>
        <li class="active">
          <a href="#quickview-chat" data-toggle="tab">Chat</a>
        </li>
      </ul>
      <a class="btn-link quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview"><i class="pg-close"></i></a>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- BEGIN Notes !-->
        <div class="tab-pane fade  in no-padding" id="quickview-notes">
          <div class="view-port clearfix quickview-notes" id="note-views">
            <!-- BEGIN Note List !-->
            <div class="view list" id="quick-note-list">
              <div class="toolbar clearfix">
                <ul class="pull-right ">
                  <li>
                    <a href="#" class="delete-note-link"><i class="fa fa-trash-o"></i></a>
                  </li>
                  <li>
                    <a href="#" class="new-note-link" data-navigate="view" data-view-port="#note-views" data-view-animation="push"><i class="fa fa-plus"></i></a>
                  </li>
                </ul>
                <button class="btn-remove-notes btn btn-xs btn-block" style="display:none"><i class="fa fa-times"></i> Delete</button>
              </div>
              <ul>
                <!-- BEGIN Note Item !-->
                <li data-noteid="1" data-navigate="view" data-view-port="#note-views" data-view-animation="push">
                  <div class="left">
                    <!-- BEGIN Note Action !-->
                    <div class="checkbox check-warning no-margin">
                      <input id="qncheckbox1" type="checkbox" value="1">
                      <label for="qncheckbox1"></label>
                    </div>
                    <!-- END Note Action !-->
                    <!-- BEGIN Note Preview Text !-->
                    <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                    <!-- BEGIN Note Preview Text !-->
                  </div>
                  <!-- BEGIN Note Details !-->
                  <div class="right pull-right">
                    <!-- BEGIN Note Date !-->
                    <span class="date">12/12/14</span>
                    <a href="#"><i class="fa fa-chevron-right"></i></a>
                    <!-- END Note Date !-->
                  </div>
                  <!-- END Note Details !-->
                </li>
                <!-- END Note List !-->
              </ul>
            </div>
            <!-- END Note List !-->
            <div class="view note" id="quick-note">
              <div>
                <ul class="toolbar">
                  <li><a href="#" class="close-note-link"><i class="pg-arrow_left"></i></a>
                  </li>
                  <li><a href="#" data-action="Bold"><i class="fa fa-bold"></i></a>
                  </li>
                  <li><a href="#" data-action="Italic"><i class="fa fa-italic"></i></a>
                  </li>
                  <li><a href="#" class=""><i class="fa fa-link"></i></a>
                  </li>
                </ul>
                <div class="body">
                  <div>
                    <div class="top">
                      <span>21st april 2014 2:13am</span>
                    </div>
                    <div class="content">
                      <div class="quick-note-editor full-width full-height js-input" contenteditable="true"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Notes !-->
      </div>
    </div>
    <!-- END QUICKVIEW-->

    
    <!-- BEGIN VENDOR JS -->
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-bez/jquery.bez.min.js"></script>
    <script src="assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="assets/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="pages/js/pages.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
  </body>
</html>
