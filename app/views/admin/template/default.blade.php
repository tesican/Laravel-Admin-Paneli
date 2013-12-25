<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Webdeders.com</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }} 
    {{ HTML::style('css/style.css') }} 
    <!-- Custom styles for this template -->
    {{ HTML::style('css/jumbotron-narrow.css') }} 
    <!-- Footer CSS -->
    {{ HTML::style('css/sticky-footer-navbar.css') }} 
    {{ HTML::script('js/ckeditor/ckeditor.js') }} 
    {{ HTML::script('http://code.jquery.com/jquery-1.10.1.min.js') }} 
    {{ HTML::script('js/bootstrap.js') }} 
    {{ HTML::script('js/modal.js') }} 
    <!-- bootstrap widget theme -->
    {{ HTML::style('js/trtable/css/theme.bootstrap.css') }} 
    <!-- tablesorter plugin -->
    {{ HTML::script('js/trtable/js/jquery.tablesorter.js') }} 
    <!-- tablesorter widget file - loaded after the plugin -->
    {{ HTML::script('js/trtable/js/jquery.tablesorter.widgets.js') }} 
    <!-- Tablesorter: optional -->
    {{ HTML::style('js/trtable/addons/pager/jquery.tablesorter.pager.css') }}
    {{ HTML::script('js/trtable/addons/pager/jquery.tablesorter.pager.js') }}
    <!-- Colorbox Plugin -->
    {{ HTML::script('js/colorbox/jquery.colorbox-min.js') }} 
    {{ HTML::style('js/colorbox/colorbox.css') }} 
    
    {{ HTML::script('js/main.js') }}
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>{{ HTML::script('js/ie8-responsive-file-warning.js') }}<![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li @if(@$activePage == "home")class="active" @endif >
               <a href="{{ URL::route("admin.home") }}"><i class="glyphicon glyphicon-th-large"></i> Anasayfa</a>
          </li>
          <li @if(@$activePage == "pages")class="active" @endif>
               <a href="{{ URL::to(DASHBOARD."/pages/index") }}"><i class="glyphicon glyphicon-list-alt"></i> Sayfalar</a>
          </li>
          <li @if(@$activePage == "galeries")class="active" @endif>
               <a href="{{ URL::to(DASHBOARD."/galeries/index") }}"><i class="glyphicon glyphicon-picture"></i> Galeriler</a>
          </li>
          <li @if(@$activePage == "users")class="active" @endif>
               <a href="{{ URL::to(DASHBOARD."/users/index") }}"><i class="glyphicon glyphicon-user"></i> Kullanıcılar</a>
          </li>
          <li @if(@$activePage == "settings")class="active" @endif>
               <a href="{{ URL::to(DASHBOARD."/settings") }}"><i class="glyphicon glyphicon-wrench"></i> Ayarlar</a>
          </li>
            <li><a href="{{ URL::route('admin.logout') }}"><i class="glyphicon glyphicon-off"></i> Çıkış</a></li>
        </ul>
      </div>
        @yield("content") 
    </div> <!-- /container -->
    <div id="footer">
        <div class="container">
            <p class="text-muted">Webdeders.com Laravel Kod Örneği - 2014</p>
        </div>
    </div>
    <div class="overlay">
        <div class="loading">{{ HTML::image("img/loading.gif") }}</div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- ALERT Modal -->
    <div class="modal fade" id="myAlert" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">KAPAT</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  </body>
</html>