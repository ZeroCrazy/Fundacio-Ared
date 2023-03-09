<?php

	$page = "Servidor";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
	
	if($user['rank'] == ''. $rango_administrador .'') {} else { header("Location: $site"); }
	
	if (isset($_POST['guardarServidor'])) {
	  $sitename = Filter($_POST['sitename']);
	  $site = Filter($_POST['site']);
	  $reformas = Filter($_POST['reformas']);
	  $precio_rooms = Filter($_POST['precio_rooms']);
	  $precio_desayuno = Filter($_POST['precio_desayuno']);
	  $precio_cena = Filter($_POST['precio_cena']);
	  mysql_query("UPDATE cms_settings SET sitename='$sitename', site='$site', reformas='$reformas', precio_rooms='$precio_rooms', precio_desayuno='$precio_desayuno', precio_cena='$precio_cena' WHERE id='1'");
	  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Opciones del servidor modificados','". time() ."')");
	  $mensaje = '<script>sweetAlert("Perfecto!", "Los cambios han sido guardados", "success");</script>';
	  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/server_options.php#ok'>";
	}
	
	if (isset($_POST['guardarMantenimientoHabitaciones'])) {
	  $info = Filter($_POST['info']);
	  mysql_query("UPDATE rooms SET info='-$info' WHERE id='$_GET[id]'");
	  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha añadido habitación en mantenimiento','". time() ."')");
	  $mensaje = '<script>sweetAlert("Perfecto!", "Los cambios han sido guardados", "success");</script>';
	  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/server_options.php#ok'>";
	}
?>
<style>
.room_green {
  background: green;
  color: #fff;
  width: 53px;
  height: 40px;
  text-align: center;
  line-height: 39px;
  font-weight: bold;
  font-size: 25px;
  float: left;
  border: 1px solid rgba(0, 0, 0, 0.17);
}

.room_yellow {
  background: #ffeb3b;
  color: #222;
  width: 53px;
  height: 40px;
  text-align: center;
  line-height: 39px;
  font-weight: bold;
  font-size: 25px;
  float: left;
  border: 1px solid rgba(0, 0, 0, 0.17);
}

.room_orange {
  background: #e65100;
  color: #222;
  width: 62px;
  height: 40px;
  text-align: center;
  line-height: 39px;
  font-weight: bold;
  font-size: 25px;
  float: left;
  border: 1px solid rgba(0, 0, 0, 0.17);
}

.room_blue {
  background: #2196f3;
  color: #fff;
  width: 62px;
  height: 40px;
  text-align: center;
  line-height: 39px;
  font-weight: bold;
  font-size: 25px;
  float: left;
  border: 1px solid rgba(0, 0, 0, 0.17);
}
</style>
	<main>
	<div class="container">
	  <div class="row">
		<div class="col s12 m12">
          <div class="card white darken-1">
            <div class="card-content">
			  <blockquote>Hola, <?php echo $user['username']; ?>. Todos los cambios que hagas en el servidor serán guardados automáticamente en la base de datos.</blockquote>
              <form method="POST">
			  <div class="row">
				<div class="input-field col s12 m6">
				<div class="card-panel #e65100 orange darken-4 white-text"><b>Configuración servidor</b></div>
				<table class="responsive-table">
				<tbody>
				  <tr>
					<td><b>Nombre servidor:</b></td>
					<td><input type="text" name="sitename" value="<?php echo $sitename; ?>" class="validate" placeholder="Introduce el nombre del servidor"></td>
				  </tr>
				  <tr>
					<td><b>Dominio:</b></td>
					<td><input type="text" name="site" value="<?php echo $site; ?>" class="validate" placeholder="Introduce el dominio del servidor"></td>
				  </tr>
				  <tr>
					<td><b>Reformas web:</b></td>
					<td>
					 <select name="reformas">
					  <?php if($settings['reformas'] == '1') { ?>
						<option value="" disabled>Selecciona una opción</option>
						<option value="1" selected>Activado</option>
						<option value="0">Desactivar</option>
					  <?php } else { ?>
					    <option value="" disabled>Selecciona una opción</option>
						<option value="1">Activar</option>
						<option value="0" selected>Desactivado</option>
					  <?php } ?>
					 </select>
					</td>
				  </tr>
				</tbody>
			  </table>
				</div>
				<div class="input-field col s12 m6">
				<div class="card-panel #e65100 orange darken-4 white-text"><b>Configuración precio</b></div>
				<table class="responsive-table">
					<tbody>
					  <tr>
						<td><b>Precio por persona:</b></td>
						<td><input type="text" name="precio_rooms" value="<?php echo $precio_rooms; ?>" class="validate" placeholder="Introduce el coste de persona"></td>
					  </tr>
					  <tr>
						<td><b>Precio desayuno:</b></td>
						<td><input type="text" name="precio_desayuno" value="<?php echo $precio_desayuno; ?>" class="validate" placeholder="Introduce el coste de desayuno"></td>
					  </tr>
					  <tr>
						<td><b>Precio cena:</b></td>
						<td><input type="text" name="precio_cena" value="<?php echo $precio_cena; ?>" class="validate" placeholder="Introduce el coste de cena"></td>
					  </tr>
					</tbody>
				  </table>
				</div>
				<div class="input-field col s12 m12">
				  <button type="submit" name="guardarServidor" class="btn" style="width: 100%;">Guardar cambios servidor</button>
				</div>
			  </div>
			  </form>
			  <form method="POST">
				<div class="row">
				<div class="input-field col s12 m12">
				<div class="card-panel #e65100 orange darken-4 white-text"><b>Mantenimiento habitaciones</b></div>
				</div>
				<?php if($_GET['mantenimientohab'] == '') { ?>
				<div class="input-field col s12 m12"><a class="btn waves-effect waves-light modal-trigger" href="#ConsultRooms">Seleccionar habitación</a></div>
				<?php } else { ?>
				<div class="input-field col s12 m6">
				<table class="responsive-table">
					<tbody>
					  <tr>
						<td><b>Motivo averia:</b></td>
						<td><input type="text" name="info" class="validate" placeholder="Introduce el motivo"></td>
					  </tr>
					</tbody>
				  </table>
				</div>
				<div class="input-field col s12 m6"><x style="background: <?php echo $_GET['category']; ?>;color: #fff;font-weight: bold;padding: 5px 17px;border: 3px solid #00000040;border-radius: 3px;">Has seleccionado la habitación número <?php echo $_GET['mantenimientohab']; ?></x></div>
				<div class="input-field col s12 m12">
				  <button type="submit" name="guardarMantenimientoHabitaciones" class="btn" style="width: 100%;">Guardar cambios habitación</button>
				</div>
				<?php } ?>
				</form>
			  	  <div id="ConsultRooms" class="modal" style="width: 100%;    height: 100%;    max-height: 100%;    margin-top: -98px;">
					<div class="modal-content">
					  <h4>Mantenimiento &#187; Seleccionar habitación <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a></h4>
					  <div class="container">
						<div class="row">
						<div style="background: url(assets/images/grafico.png);width: 1565px;height: 997px;position: absolute;margin-top: -77px;">
							<?php $h_sql = mysql_query("SELECT * FROM rooms ORDER BY id"); while($h = mysql_fetch_assoc($h_sql)){ ?>
							<?php
							  $Var = mysql_query("SELECT * FROM alquiler WHERE dia_entrada='$_GET[dia]' AND mes_entrada='$_GET[mes]' AND ano_entrada='$_GET[ano]' ORDER BY id DESC");
							  $dxd = mysql_fetch_assoc($Var);
							?>
							
							<?php if($h['show'] == '1') { ?>
							<?php if($h['info'] == '') { ?><?php } else { ?>
							<div class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="<?php echo $h['info']; ?>" style="<?php echo $h['style']; ?>background: #860000;padding: 48px 23px 0px 23px;color: #fff;border-radius: 200px;font-weight: bold;line-height: 50px;font-size: 30px;">!</div>
							<?php } ?>
							<?php $asd_sql = mysql_query("SELECT * FROM alquiler WHERE dia_entrada='$_GET[dia]' AND mes_entrada='$_GET[mes]' AND ano_entrada='$_GET[ano]'"); while($d = mysql_fetch_assoc($asd_sql)){ ?>
							<?php if($h['name'] == ''. $d[room] .'') { ?><?php if($h['category'] == ''. $d[category] .'') { ?><a class="btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Ocupado hasta <?php echo $d['dia_salida']; ?> de <?php echo $d['mes_salida']; ?>, <?php echo $d['ano_salida']; ?> por <?php echo NombreCliente($d['cliente_id']); ?>" style="<?php echo $h['style']; ?>background: #2b2b2b;width: auto;padding: 28px 12px 37px 5px;line-height: 45px;">INFO</a><?php } ?><?php } ?>
							<a href="<?php echo $site; ?>/server_options.php?id=<?php echo $h['id']; ?>&mantenimientohab=<?php echo $h['name']; ?>&category=<?php echo $h['category']; ?><?php if($h['status'] == "1") { ?>&status=1<?php } ?>">
							 <div class="room_<?php echo $h['category']; ?>" style="<?php if($h['name'] == ''. $d[room] .'') { ?><?php if($h['category'] == ''. $d[category] .'') { ?>background: red;z-index:1;<?php } ?><?php } ?><?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
							</a>
							<?php } if(mysql_num_rows($asd_sql) == 0) {  ?>
							<a href="<?php echo $site; ?>/server_options.php?id=<?php echo $h['id']; ?>&mantenimientohab=<?php echo $h['name']; ?>&category=<?php echo $h['category']; ?><?php if($h['status'] == "1") { ?>&status=1<?php } ?>">
							 <div class="room_<?php echo $h['category']; ?>" style="<?php if($h['name'] == ''. $d[room] .'') { ?><?php if($h['category'] == ''. $d[category] .'') { ?>background: red;z-index:1;<?php } ?><?php } ?><?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
							</a>
							<?php } ?>
							<?php } ?>
							<?php } ?>
						</div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				<div class="row">
				<div class="input-field col s12 m12">
				<div class="card-panel #e65100 orange darken-4 white-text"><b>Habitaciones en mantenimiento</b></div>
				</div>
				<table class="striped">
				  <thead>
					<tr>
					  <td>#</td>
					  <td>Habitación</td>
					  <td>Motivo</td>
					  <td>Opciones</td>
					</tr>
				  </thead>
				  <tbody>
					<?php $cx_sql = mysql_query("SELECT * FROM rooms WHERE info>='-' ORDER BY id"); while($c = mysql_fetch_assoc($cx_sql)){ ?>
					<?php
					if (isset($_POST['eliminarhab_'. $c[id] .''])) {
					  mysql_query("UPDATE rooms SET info='' WHERE id='$c[id]'");
					  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha quitado mantenimiento en habitación','". time() ."')");
					  $mensaje = '<script>sweetAlert("Perfecto!", "Se ha eliminado el mantenimiento de la habitación '. $c[name] .' correctamente", "success");</script>';
					  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/server_options.php#ok'>";
					}
					?>
					<tr>
					  <td></td>
					  <td><?php echo $c['name']; ?></td>
					  <td><?php echo $c['info']; ?></td>
					  <td><form method="POST"><button type="submit" name="eliminarhab_<?php echo $c['id']; ?>" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">delete</i></button></form></td>
					</tr>
					<?php } ?>
				  </tbody>
				</table>
				</div>
            </div>
          </div>
		</div>
	  </div>
	</div>
	<?php echo $mensaje; ?>
	</main>
  
	<?php require 'templates/footer.php'; ?>