<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Webdeders.com Admin Paneli Giriş</title>
    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.css') }} 
    <!-- Custom styles for this template -->
    {{ HTML::style('css/signin.css') }} 
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
        {{ Form::open(array("url"=>URL::route("admin.doLogin"),"class" => "form-signin","role" => "form")) }}
        <h2 class="form-signin-heading">Lütfen oturum açın</h2>
        {{ Form::text("username",null,array("class" => "form-control", "placeholder" => "Email veya Kullanıcı Adı","required","autofocus")) }} 
        {{ Form::password("password",array("class" => "form-control", "placeholder" => "Şifre","required")) }} 
        <label class="checkbox">{{ Form::checkbox("rememberme") }} Beni Hatırla</label>
        {{ Form::button("Giriş Yap",array("class" => "btn btn-lg btn-primary btn-block","type" => "submit")) }} 
        {{ Form::close() }} 
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
