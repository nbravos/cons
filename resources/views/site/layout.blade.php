
<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Aprendiendo Laravel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    {{ HTML::style('assets3/html/assets/css/bootstrap.min.css', array('media' => 'screen')) }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      {{ HTML::script('assets3/html/assets/js/html5shiv.js') }}
      {{ HTML::script('assets3/html/assets/js/respond.min.js') }}
    <![endif]-->
  </head>
{{ HTML::script('assets3/html/assets/js/admin.js') }}
  <body>
    <div id="wrap">
      <div class="container">
        @yield('content')
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script('assets3/html/assets/js/bootstrap.min.js') }}
  </body>
</html>


