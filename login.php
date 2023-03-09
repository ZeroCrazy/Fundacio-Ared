<?php

	$page = "Administración";

	require 'inc/core.php';
	if (isset($_POST['iniciarSesion'])) {
	  $username = Filter($_POST['username']);
	  $password = Filter($_POST['password']);
	  $user_verify = mysql_query("SELECT * FROM admins WHERE username='$username' && password='$password' LIMIT 1");
	  $user_fetch = mysql_fetch_assoc($user_verify);
	  if (mysql_num_rows($user_verify) == 0) {
	  $errorxd = '1';
	  $mensaje = '
	  <br>
	  <div class="alert alert-danger text-center" role="alert">
		Usuario o contraseña incorrecto
	  </div>
	  ';
	  }else{
	  $ban_check = mysql_query("SELECT * FROM bans WHERE value='$user_fetch[username]'");
	  if(mysql_num_rows($ban_check) == 1){
	  $ban = mysql_fetch_assoc($ban_check);
	  $banmsg = '<div class="message" style="background-color: #de4343;border-color: #c43d3d;">
		<i class="fa fa-times-circle" style="display:inline-block;"></i><p style="display:inline-block;margin-left:10px">Esta cuenta ha sido desactivada permanentemente.</p>
	</div>';
	  }else{
	  $_SESSION['id'] = $user_fetch['id'];
	  mysql_query("UPDATE admins SET ip='$ip', so='$SO' WHERE id='$user_fetch[id]'");
	  $mensaje = '
	  <br>
	  <div class="alert alert-success text-center" role="alert">
		Iniciando sesión...
	  </div>
	  <script>
	  function redireccionarPagina() {
	    window.location = "'. $site .'/#ok";
	  }
	  setTimeout("redireccionarPagina()", 2000);
	  </script>
	  ';
	}}}
	$dia=date('j');$mes=date('m');$ano=date('Y');
	if (isset($_SESSION['id'])) {
		header("Location: ". $site ."/index.php?dia=". $dia ."&mes=". $mes ."&ano=". $ano ."");
	} else {

	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo $site . "/" . $cdn; ?>/images/favicon.ico" type="image/x-icon"/>
    <title><?php echo $sitename; ?>: <?php echo $page; ?></title>
    <link href="<?php echo $site . "/" . $cdn; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $site . "/" . $cdn; ?>/css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form method="POST" class="form-signin">
        <img src="<?php echo $site . "/" . $cdn; ?>/images/logo.png">
		<br>
		<?php echo $mensaje; ?>
		<!-- MENSAJE OK --
		<br>
		<div class="alert alert-success text-center" role="alert">
		  Iniciando sesión...
		</div>
		-->
		<br>
        <h2 class="form-signin-heading text-center">Administración</h2>
        <label for="inputEmail" class="sr-only">Usuario</label>
        <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contraseña" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Recordar
          </label>
        </div>
        <button class="btn btn-lg btn btn-block" style="background: #ec6425;color: #fff;" type="submit" name="iniciarSesion">Iniciar sesión</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo $site . "/" . $cdn; ?>/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
