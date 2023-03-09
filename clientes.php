<?php

	$page = "Clientes";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
	
  if (isset($_POST['RegisterNewUser'])) {
  $nombre = Filter($_POST['nombre']);
  $apellidos = Filter($_POST['apellidos']);
  $domicilio_via = Filter($_POST['domicilio_via']);
  $domicilio_direccion = Filter($_POST['domicilio_direccion']);
  $domicilio_numbloque = Filter($_POST['domicilio_numbloque']);
  $domicilio_escalera = Filter($_POST['domicilio_escalera']);
  $domicilio_puerta = Filter($_POST['domicilio_puerta']);
  $domicilio_pais = Filter($_POST['domicilio_pais']);
  $domicilio_provincia = Filter($_POST['domicilio_provincia']);
  $domicilio_ciudad = Filter($_POST['domicilio_ciudad']);
  $domicilio_cp = Filter($_POST['domicilio_cp']);
  $telf_fijo = Filter($_POST['telf_fijo']);
  $telf_movil = Filter($_POST['telf_movil']);
  $dni = Filter($_POST['dni']);
  $email = Filter($_POST['email']);
  mysql_query("INSERT INTO clientes (nombre,apellidos,domicilio_via,domicilio_direccion,domicilio_numbloque,domicilio_escalera,domicilio_puerta,domicilio_pais,domicilio_provincia,domicilio_ciudad,domicilio_cp,telf_fijo,telf_movil,dni,email,added_client) VALUES ('$nombre','$apellidos','$domicilio_via','$domicilio_direccion','$domicilio_numbloque','$domicilio_escalera','$domicilio_puerta','$domicilio_pais','$domicilio_provincia','$domicilio_ciudad','$domicilio_cp','$telf_fijo','$telf_movil','$dni','$email','$user[username]')");
  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha creado un nuevo cliente','". time() ."')");
  $mensaje = '<script>sweetAlert("Perfecto!", "Cliente creado satisfactoriamente", "success");</script>';
  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/clientes.php#ok'>";
  }
  
  
?>

	<main>
	<div class="container">	
	  <div class="row">	
	  
	  
	  
	  
	  
				<?php if($_GET['edit'] == "$_GET[edit]") $c2_sql = mysql_query("SELECT * FROM clientes WHERE id='". $_GET[edit] ."'"); while($c2 = mysql_fetch_assoc($c2_sql)) { ?>
				<?php
				if (isset($_POST['borrarCliente_'. $c2[id] .''])) {
				  mysql_query("DELETE FROM clientes WHERE id='". $c2[id] ."'");
				  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha eliminado a un cliente ($c2[nombre] $c2[apellidos])','". time() ."')");
				  $mensaje = '<script>sweetAlert("Perfecto!", "Se ha eliminado a '. $c2[nombre] .' correctamente", "success");</script>';
				  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/clientes.php#deleted'>";
					}
					
				  if (isset($_POST['guardarCliente'])) {
				  $procedencia = Filter($_POST['procedencia']);
				  $nombre = Filter($_POST['nombre']);
				  $apellidos = Filter($_POST['apellidos']);
				  $domicilio_via = Filter($_POST['domicilio_via']);
				  $domicilio_direccion = Filter($_POST['domicilio_direccion']);
				  $domicilio_numbloque = Filter($_POST['domicilio_numbloque']);
				  $domicilio_escalera = Filter($_POST['domicilio_escalera']);
				  $domicilio_puerta = Filter($_POST['domicilio_puerta']);
				  $domicilio_pais = Filter($_POST['domicilio_pais']);
				  $domicilio_provincia = Filter($_POST['domicilio_provincia']);
				  $domicilio_ciudad = Filter($_POST['domicilio_ciudad']);
				  $domicilio_cp = Filter($_POST['domicilio_cp']);
				  $telf_fijo = Filter($_POST['telf_fijo']);
				  $telf_movil = Filter($_POST['telf_movil']);
				  $dni = Filter($_POST['dni']);
				  $email = Filter($_POST['email']);
				  mysql_query("UPDATE clientes SET procedencia='$procedencia', nombre='$nombre', apellidos='$apellidos', domicilio_via='$domicilio_via', domicilio_direccion='$domicilio_direccion', domicilio_numbloque='$domicilio_numbloque', domicilio_escalera='$domicilio_escalera', domicilio_puerta='$domicilio_puerta', domicilio_pais='$domicilio_pais', domicilio_provincia='$domicilio_provincia', domicilio_ciudad='$domicilio_ciudad', domicilio_cp='$domicilio_cp', telf_fijo='$telf_fijo', telf_movil='$telf_movil', dni='$dni', email='$email' WHERE id='$c2[id]'");
				  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha editado un cliente ($c2[nombre] $c2[apellidos])','". time() ."')");
				  $mensaje = '<script>sweetAlert("Perfecto!", "Los cambios han sido guardados", "success");</script>';
				  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/clientes.php#ok'>";
				  }  
				?>

	  
			<?php if($_GET['historial'] == "show") { ?>
			<div class="col s12 m12">
			<?php echo $mensaje; ?>
			<div style="background: #fff;    background: #fff;    position: absolute;    z-index: 10000;    width: 100%;    height: 900%;    top: -9px;    left: 0px;" class="card black-text">
			<div class="card-content black-text" style="position:absolute;z-index:10000;width: 100%;">
			<span class="card-title">Historial de <?php echo $c2['nombre']; ?> <?php echo $c2['apellidos']; ?> <a class="btn" href="javascript:window.history.back();">Volver atrás</a></span><br>
				<div class="row">
			  <?php $hh_sql = mysql_query("SELECT * FROM alquiler WHERE cliente_id='$c2[id]' ORDER BY id DESC"); while($h = mysql_fetch_assoc($hh_sql)) { ?>
<?php
  $Var = mysql_query("SELECT count(*) count FROM pago_cuenta WHERE cliente_id='$_GET[edit]' AND room='$h[room]' AND category='$h[category]'");
  $count_pagos_a_cuenta = mysql_fetch_assoc($Var);
  
$date1 = new DateTime("". $h[ano_entrada] ."-". $h[mes_entrada] ."-". $h[dia_entrada] ."");
$date2 = new DateTime("". $h[ano_salida] ."-". $h[mes_salida] ."-". $h[dia_salida] ."");
$interval = $date1->diff($date2);
?>
			    <style>td{padding: 20px;}</style>
				<div class="col s12 m12">
				<div style="background: #a65100;padding: 4px 14px;color: #fff;text-shadow: 0px 1px 0px #00000059;float: left;border-radius: 3px;margin: 10px 10px;"><?php echo $h['price_persona']; ?>€/persona</div>
				<div style="background: #e65100;padding: 4px 14px;color: #fff;text-shadow: 0px 1px 0px #00000059;float: left;border-radius: 3px;margin: 10px 10px;"><?php echo $h['price_desayuno']; ?>€/desayuno</div>
				<div style="background: #f65100;padding: 4px 14px;color: #fff;text-shadow: 0px 1px 0px #00000059;float: left;border-radius: 3px;margin: 10px 10px;"><?php echo $h['price_cena']; ?>€/cena</div>
				</div>
				<div class="col s12 m12">
				<table class="striped responsive-table">
				  <tbody>
					<tr>
					  <td><b>ENTRADA</b></td>
					  <td><b>SALIDA</b></td>
					  <td><b>Nº PERSONAS</b></td>
					  <td><b>HABITACIÓN ALQUILADA</b></td>
					  <td><b>DESAYUNO</b></td>
					  <td><b>CENA</b></td>
					  <td style="border-left: 1px solid;"><b>SUBTOTAL</b></td>
					</tr>
					<tr>
					  <td><?php echo $h['dia_entrada']; ?> de <?php echo getMonthPerDay($h['mes_entrada']); ?>, <?php echo $h['ano_entrada']; ?></td>
					  <td><?php echo $h['dia_salida']; ?> de <?php echo getMonthPerDay($h['mes_salida']); ?>, <?php echo $h['ano_salida']; ?></td>
					  <td><?php echo $h['num_personas']; ?></td>
					  <td><?php echo $h['room']; ?> <div style="float: left;margin-right: 5px;width: 20px;height: 20px;background: <?php echo $h['category']; ?>;"></div></td>
					  <td><?php if($h['desayuno'] == '1') { ?>Sí<?php } else { ?>No<?php } ?></td>
					  <td><?php if($h['cena'] == '1') { ?>Sí<?php } else { ?>No<?php } ?></td>
					<?php
					if($h['cena'] == '0'){ $cena = 0; } else { $cena = $h['price_cena']; }
					if($h['desayuno'] == '0'){ $desayuno = 0; } else { $desayuno = $h['price_desayuno']; }
					$persona = $h['price_persona'];
					$subtotal = $cena+$desayuno;
					$total2 = $h['price_persona']*$h['num_personas'];
					$total = $h['price_persona']*$h['num_personas']*$interval->days;
					//echo "TOTAL " . $subtotal*$h['num_habitaciones']*$interval->days . "€";
					?>
					  <td style="border-left: 1px solid;"><?php echo $subtotal+$total2*$interval->days . "€"; ?></td>
					</tr>
					<tr>
					<td>-</td>
					<td><?php echo $h['price_persona']*$h['num_personas']; ?> x <?php echo $interval->days; ?> = <?php echo $h['price_persona']*$h['num_personas']*$interval->days; ?></td>
					<td><?php echo $h['price_persona']; ?> x <?php echo $h['num_personas']; ?> = <?php echo $h['price_persona']*$h['num_personas']; ?>€</td>
					<td>-</td>
					<td><?php echo $h['price_desayuno']; ?>€</td>
					<td><?php echo $h['price_cena']; ?>€</td>
					<td style="border-left: 1px solid;"><b>TOTAL</b></td>
					</tr>
					<tr>
					<td><b>PAGOS A CUENTA:</b> <?php echo $count_pagos_a_cuenta['count']; ?></td>
					<td><b>CANTIDAD PAGADAS:</b> (<?php $p_sql = mysql_query("SELECT * FROM pago_cuenta WHERE cliente_id='$_GET[edit]' AND room='$h[room]' AND category='$h[category]' ORDER BY id DESC"); while($p = mysql_fetch_assoc($p_sql)) { ?><?php echo $p['cantidad']; ?>, <?php } ?>)</td>
					<td><b>TOTAL PAGADO:</b> <?php $result = mysql_query("SELECT SUM(cantidad) as total FROM pago_cuenta WHERE cliente_id='$_GET[edit]' AND room='$h[room]' AND category='$h[category]'");$row = mysql_fetch_array($result, MYSQL_ASSOC);echo $row["total"]; ?>€</td>
					<td></td>
					<td></td>
					<td></td>
					<td>
					<?php
					$result = mysql_query("SELECT SUM(cantidad) as total FROM pago_cuenta WHERE cliente_id='$_GET[edit]' AND room='$h[room]' AND category='$h[category]'");$row = mysql_fetch_array($result, MYSQL_ASSOC);
					echo $total-$row["total"];
					?>€ (<?php echo $total; ?>-<?php echo $row["total"]; ?>)
					</td>
					</tr>
				  </tbody>
				</table>				
				</div>
			  <?php } ?>
				</div>
			</div>
			</div>
			</div>
			<?php } ?>
			<div class="col s12 m12"><br>
			  <a class="waves-effect waves-light btn-large" href="<?php echo $site; ?>/pagar-a-cuenta.php?id=<?php echo $c2['id']; ?>" style="width: 100%;">PAGAR A CUENTA</a>
			</div>
			<form method="POST" class="col s12 m12">
				<div class="col s12 m12">
				  <div class="card">
					<div class="card-content">
					  <span class="card-title">Procedencia</span>
					  <p class="grey-text">Debes seleccionar de dónde proviene <?php echo $c2['nombre']; ?> <?php echo $c2['apellidos']; ?> (no es obligatorio).</p>
					  <?php if($c2['procedencia'] == '') { ?>
					  <select name="procedencia">
						<option value="" disabled selected>Seleccionar procedencia</option>
						<option value="Hospital Vall d'Hebron">Hospital Vall d'Hebron</option>
						<option value="Hospital Clínic">Hospital Clínic</option>
						<option value="ADDA">ADDA</option>
						<option value="Can Ruti">Can Ruti</option>
						<option value="Sant Joan de Deu">Sant Joan de Deu</option>
						<option value="Otras entidades">Otras entidades</option>
						<option value="Particulares">Particulares</option>
					  </select>
					  <?php } else { ?>
					  <select name="procedencia">
						<option value="<?php echo $c2['procedencia']; ?>" selected><?php echo $c2['procedencia']; ?></option>
						<option value="Hospital Vall d'Hebron">Hospital Vall d'Hebron</option>
						<option value="Hospital Clínic">Hospital Clínic</option>
						<option value="ADDA">ADDA</option>
						<option value="Can Ruti">Can Ruti</option>
						<option value="Sant Joan de Deu">Sant Joan de Deu</option>
						<option value="Otras entidades">Otras entidades</option>
						<option value="Particulares">Particulares</option>
					  </select>
					  <?php } ?>
					</div>
				  </div>
				</div>
				<div class="col s12 m12">
				<?php echo $mensaje; ?>
				 <div style="background: #fff;" class="card black-text">
				 <div class="card-content black-text">
				   <span class="card-title">Ficha de <?php if($c2['nombre'] == "") { echo '(?)'; } else { ?><?php echo $c2['nombre']; ?> <?php echo $c2['apellidos']; ?><?php } ?> <a style="font-size: 14px;" href="<?php echo $site; ?>/<?php echo $_SERVER['REQUEST_URI']; ?>&historial=show">(ver historial)</a></span>
					  <div class="row">
						  <div class="row">
							<div class="input-field col s12 m12">
							  <b>INFORMACIÓN PERSONAL</b><br><br>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="nombre" value="<?php echo $c2['nombre']; ?>" class="validate">
							  <label for="icon_prefix">Nombre</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="apellidos" value="<?php echo $c2['apellidos']; ?>" class="validate">
							  <label for="icon_prefix">Apellidos</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="dni" style="text-transform: uppercase;" value="<?php echo $c2['dni']; ?>" class="validate">
							  <label for="icon_prefix">DNI</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="telf_fijo" value="<?php echo $c2['telf_fijo']; ?>" class="validate">
							  <label for="icon_prefix">Teléfono fijo</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="telf_movil" value="<?php echo $c2['telf_movil']; ?>" class="validate">
							  <label for="icon_prefix">Teléfono móvil</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="email" value="<?php echo $c2['email']; ?>" class="validate">
							  <label for="icon_prefix">Correo electrónico</label>
							</div>
							<div class="input-field col s12 m12">
							  <b>UBICACIÓN</b><br><br>
							</div>
							<div class="input-field col s12 m4">
							<select name="domicilio_via">
							  <?php if($c2['domicilio_via'] == "") { ?><option value="" disabled selected>Seleccionar vía</option><?php } else { ?><option value="<?php echo $c2['domicilio_via']; ?>" selected><?php echo $c2['domicilio_via']; ?></option><?php } ?>
							  <optgroup label="Tipos de vía">
							  <option value="Avenida">Avenida</option>
							  <option value="Calle">Calle</option>
							  <option value="Glorieta">Glorieta</option>
							  </optgroup>
							</select>
							<label>Vía</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="domicilio_direccion" value="<?php echo $c2['domicilio_direccion']; ?>" class="validate">
							  <label for="icon_prefix">Calle</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="domicilio_numbloque" value="<?php echo $c2['domicilio_numbloque']; ?>" class="validate">
							  <label for="icon_prefix">Número de bloque</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="domicilio_escalera" value="<?php echo $c2['domicilio_escalera']; ?>" class="validate">
							  <label for="icon_prefix">Escalera</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="domicilio_puerta" value="<?php echo $c2['domicilio_puerta']; ?>" class="validate">
							  <label for="icon_prefix">Puerta</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="domicilio_pais" value="<?php echo $c2['domicilio_pais']; ?>" class="validate">
							  <label for="icon_prefix">País</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="domicilio_provincia" value="<?php echo $c2['domicilio_provincia']; ?>" class="validate">
							  <label for="icon_prefix">Provincia</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="domicilio_ciudad" value="<?php echo $c2['domicilio_ciudad']; ?>" class="validate">
							  <label for="icon_prefix">Ciudad</label>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="domicilio_cp" value="<?php echo $c2['domicilio_cp']; ?>" class="validate">
							  <label for="icon_prefix">Código postal</label>
							</div>
							<div class="input-field col s12 m12">
							<button type="submit" name="guardarCliente" style="width: 100%;background: #<?php echo $colordelservidor; ?>;" class="waves-effect waves-light btn-large white-text">Guardar cambios</button>
							  <button type="submit" name="borrarCliente_<?php echo $c2['id']; ?>" style="margin-top: 10px;width: 100%;" class="waves-effect waves-light btn-large white-text #b71c1c red darken-4">Borrar cliente</button>
							</div>
						  </div>
						</form>
					  </div>
				 </div>
				 </div>
				 </div>
	<?php } ?>
	  
  <div class="fixed-action-btn click-to-toggle">
    <a href="#RegisterNewUser" class="btn-floating btn-large #e65100 modal-trigger">
      <i class="material-icons">add</i>
    </a>
  </div>
	  
		<div class="col s12 m12">
		  <div class="card" style="background: transparent;box-shadow: none;text-align: center;">
            <div class="card-content grey-text">
			  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Introduce la búsqueda ..">
              
			  <ul id="myUL">
			  	<?php $c_sql = mysql_query("SELECT * FROM clientes ORDER BY id"); while($c = mysql_fetch_assoc($c_sql)){ ?>
			    <li class="responsive-table centered card card-content" style="padding: 1px;border-radius: 200px;border: 3px solid #e65100;">
			      <a href="?edit=<?php echo $c['id']; ?>"><?php if($c['nombre'] == "") { echo '(?)'; } else { ?><b><?php echo $c['nombre']; ?> <?php echo $c['apellidos']; ?></b><?php } ?></a>
			    </li>
			  	<?php } if(mysql_num_rows($c_sql) == 0) { ?>
				<div class="col s12 m12" style="margin-top: 40px;">
				  <div class="card #b71c1c red darken-4">
					<div class="card-content white-text">
					  <span class="card-title center">No tienes clientes</span>
					</div>
				  </div>
				</div>
				<?php } ?>
			  </ul>
            </div>
          </div>
		</div>
	  </div>
	</div>
	
	<div id="RegisterNewUser" class="modal bottom-sheet" style="max-height: 100% !important;">
    <div class="modal-content">
      <h4>Cliente &#187; Nueva ficha</h4>
	  <form method="POST">
      <div class="row">
		<!-- INFORMACIÓN PERSONAL -->
		<div class="input-field col s12 m12">
		<b>INFORMACIÓN PERSONAL</b>
		</div>
		<div class="input-field col s12 m4">
		 <input id="nombre" name="nombre" type="text" class="validate" required>
         <label for="nombre">Nombre</label>
		</div>
		<div class="input-field col s12 m4">
		 <input id="Apellidos" name="apellidos" type="text" class="validate" required>
         <label for="Apellidos">Apellidos</label>
		</div>
		<div class="input-field col s12 m4">
		 <input id="dni" name="dni" type="text" class="validate" required>
         <label for="dni">DNI</label>
		</div>
		<div class="input-field col s12 m4">
		 <input id="telf_fijo" name="telf_fijo" type="text" class="validate">
         <label for="telf_fijo">Teléfono fijo</label>
		</div>
		<div class="input-field col s12 m4">
		 <input id="telf_movil" name="telf_movil" type="text" class="validate">
         <label for="telf_movil">Teléfono móvil</label>
		</div>
		<div class="input-field col s12 m4">
		 <input id="email" name="email" type="text" class="validate">
         <label for="email">Correo electrónico</label>
		</div>
		
		<!-- UBICACIÓN CLIENTE -->
		<div class="input-field col s12 m12">
		<b>UBICACIÓN</b>
		</div>
		<div class="input-field col s12 m4">
		<select name="domicilio_via">
		  <option value="" disabled selected>Seleccionar vía</option>
		  <optgroup label="Tipos de vía">
		  <option value="Avenida">Avenida</option>
		  <option value="Calle">Calle</option>
		  <option value="Glorieta">Glorieta</option>
		  </optgroup>
		</select>
		<label>Vía</label>
		</div>
		<div class="input-field col s12 m4">
		  <input id="icon_prefix" type="text" name="domicilio_direccion" class="validate">
		  <label for="icon_prefix">Calle</label>
		</div>
		<div class="input-field col s12 m4">
		  <input id="icon_prefix" type="text" name="domicilio_numbloque" class="validate">
		  <label for="icon_prefix">Número de bloque</label>
		</div>
		<div class="input-field col s12 m4">
		  <input id="icon_prefix" type="text" name="domicilio_escalera" class="validate">
		  <label for="icon_prefix">Escalera</label>
		</div>
		<div class="input-field col s12 m4">
		  <input id="icon_prefix" type="text" name="domicilio_puerta" class="validate">
		  <label for="icon_prefix">Puerta</label>
		</div>
		<div class="input-field col s12 m4">
		  <input id="icon_prefix" type="text" name="domicilio_pais" class="validate">
		  <label for="icon_prefix">País</label>
		</div>
		<div class="input-field col s12 m4">
		  <input id="icon_prefix" type="text" name="domicilio_provincia" class="validate">
		  <label for="icon_prefix">Provincia</label>
		</div>
		<div class="input-field col s12 m4">
		  <input id="icon_prefix" type="text" name="domicilio_ciudad" class="validate">
		  <label for="icon_prefix">Ciudad</label>
		</div>
		<div class="input-field col s12 m4">
		  <input id="icon_prefix" type="text" name="domicilio_cp" class="validate">
		  <label for="icon_prefix">Código postal</label>
		</div>
		<div class="input-field col s12 m12">
		<button type="submit" name="RegisterNewUser" class="waves-effect waves-light btn-large modal-trigger" style="width: 100%;">Finalizar</button>
	    </div>
		</form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">CANCELAR</a>
    </div>
	</div>
	</div>
	</main>
	<?php require 'templates/footer.php'; ?>