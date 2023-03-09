<?php 
$activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
  <!DOCTYPE html>
  <html>
    <head>
	  <title><?php echo $sitename; ?>: <?php echo $page; ?></title>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <link rel="shortcut icon" href="<?php echo $site . "/" . $cdn; ?>/images/favicon.ico" type="image/x-icon"/>
      <link type="text/css" rel="stylesheet" href="<?php echo $site . "/" . $cdn; ?>/css/style.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?php echo $site . "/" . $cdn; ?>/css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?php echo $site . "/" . $cdn; ?>/css/sweetalert.css"/>
	  <script type="text/javascript" src="<?php echo $site . "/" . $cdn; ?>/js/sweetalert.min.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
	<div class="nav-background">
	<h1 class="text">We Are <?php echo $sitename; ?></h1>
	</div>
	<div class="nav-background-sub"></div>
	<header>
	  <nav>
		<div class="nav-wrapper">
		  <a href="#!" data-activates="mobile-demo" class="brand-logo button-collapse">Administración</a>
		  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
		  <ul class="right hide-on-med-and-down">
			<li class="<?= ($activePage == 'index') ? 'active':''; ?>"><a href="<?php echo $site; ?>/index.php?dia=<?php echo date('j'); ?>&mes=<?php echo date('m'); ?>&ano=<?php echo date('Y'); ?>">Inicio</a></li>
			<li class="<?= ($activePage == 'calendario') ? 'active':''; ?>"><a href="<?php echo $site; ?>/calendario.php">Calendario</a></li>
			<li class="<?= ($activePage == 'clientes') ? 'active':''; ?>"><a href="<?php echo $site; ?>/clientes.php">Clientes</a></li>
			<li class="<?= ($activePage == 'habitaciones') ? 'active':''; ?><?= ($activePage == 'rooms') ? 'active':''; ?>"><a href="<?php echo $site; ?>/habitaciones.php">Habitaciones</a></li>
		  </ul>
		</div>
	  </nav>
	</header>
  
    <ul id="slide-out" class="side-nav fixed">
  	  <li>
	  <div class="user-view">
        <div class="background">
          <img src="<?php echo $site . "/" . $cdn; ?>/images/profile_wp.jpg">
        </div>
        <img class="circle" src="<?php echo $site . "/" . $cdn; ?>/images/profile.png" style="background: #fff;border: 1px solid #fff;">
        <span class="white-text name"><?php echo $user['username']; ?></span>
        <span class="white-text email"><?php echo RankName($user['rank']); ?></span>
      </div>
	  </li>
      <li><a class="subheader">MENU PRINCIPAL</a></li>
	  <li class="<?= ($activePage == 'index') ? 'active':''; ?>"><a href="<?php echo $site; ?>/index.php?dia=<?php echo date('j'); ?>&mes=<?php echo date('m'); ?>&ano=<?php echo date('Y'); ?>">Inicio</a></li>
	  <li class="<?= ($activePage == 'calendario') ? 'active':''; ?>"><a href="<?php echo $site; ?>/calendario.php">Calendario</a></li>
	  <li class="<?= ($activePage == 'clientes') ? 'active':''; ?>"><a href="<?php echo $site; ?>/clientes.php">Clientes</a></li>
	  <li class="<?= ($activePage == 'habitaciones') ? 'active':''; ?><?= ($activePage == 'rooms') ? 'active':''; ?>"><a href="<?php echo $site; ?>/habitaciones.php">Habitaciones</a></li>
	  
	  <?php if($user['rank'] == ''. $rango_administrador .'') { ?>
	  <li><a class="subheader">Administración</a></li>
	  <li class="<?= ($activePage == 'users') ? 'active':''; ?>"><a href="<?php echo $site; ?>/users.php">Usuarios</a></li>
	  <li class="<?= ($activePage == 'historial') ? 'active':''; ?>"><a href="<?php echo $site; ?>/historial.php">Historial</a></li>
	  <li class="<?= ($activePage == 'server_options') ? 'active':''; ?>"><a href="<?php echo $site; ?>/server_options.php">Opciones</a></li>
	  <li class="<?= ($activePage == 'updates') ? 'active':''; ?>"><a href="<?php echo $site; ?>/updates.php">Actualizaciones</a></li>
	  <?php } ?>
	  <li style="background: #b71c1c;"><a style="color: #fff;font-weight: 400;" href="<?php echo $site; ?>/logout.php">Cerrar sesión</a></li>
    </ul>
	<br><br><br><br><br><br><br><br><br><br><br>