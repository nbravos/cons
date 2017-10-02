
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Constructora Aragon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="pages/favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="https://aragonltda.cl/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="https://aragonltda.cl/assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://aragonltda.cl/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="https://aragonltda.cl/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="https://aragonltda.cl/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="https://aragonltda.cl/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="https://aragonltda.cl/pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="https://aragonltda.cl/pages/css/pages.css" rel="stylesheet" type="text/css" />
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
   <body class="fixed-header error-page">
    <div class="container-xs-height full-height">
      <div class="row-xs-height">
        <div class="col-xs-height col-middle">
          <div class="error-container text-center">
            <h1>Reestablecer Contraseña </h1>

<form action="{{ action('RemindersController@postReset') }}" method="POST">
    <input type="hidden" name="token" value="{{  $token }}">
    <input type="email" name="email" placeholder="Correo">
	<br>
        <br>

    <input type="password" name="password" placeholder="Contraseña Nueva">
	<br>
        <br>

    <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña">
	<br>
        <br>

    <input type="submit" value="Reestablecer Contraseña">
</form>
            <div class="error-container-innner text-center">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pull-bottom sm-pull-bottom full-width">
      <div class="error-container">
        <div class="error-container-innner">
          <div class="m-b-30 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
            <div class="col-sm-3 no-padding">
              <!--<img alt="" class="m-t-5" data-src="assets/img/demo/pages_icon.png" data-src-retina="assets/img/demo/pages_icon_2x.png" height="60" src="assets/img/demo/pages_icon.png" width="60"> -->
            </div>
          </div>
        </div>
      </div>
    </div>
      </body>
    <!-- END PAGE CONTAINER -->
    <script src="https://aragonltda.cl/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="https://aragonltda.cl/assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="https://aragonltda.cl/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="https://aragonltda.cl/assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://aragonltda.cl/assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://aragonltda.cl/assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="https://aragonltda.cl/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="https://aragonltda.cl/assets/plugins/jquery-bez/jquery.bez.min.js"></script>
    <script src="https://aragonltda.cl/assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="https://aragonltda.cl/assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="https://aragonltda.cl/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="https://aragonltda.cl/assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="https://aragonltda.cl/assets/plugins/classie/classie.js"></script>
    <script src="https://aragonltda.cl/assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <script src="https://aragonltda.cl/pages/js/pages.min.js"></script>

</html>





