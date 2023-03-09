<?php

	$page = "Pagar a cuenta";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
  
  $Var = mysql_query("SELECT * FROM clientes WHERE id='$_GET[id]'");
  $u = mysql_fetch_assoc($Var);
  
  $Var = mysql_query("SELECT * FROM pago_cuenta WHERE cliente_id='$_GET[id]'");
  $pago = mysql_fetch_assoc($Var);
  
  $Var = mysql_query("SELECT * FROM alquiler WHERE cliente_id='$_GET[id]' ORDER BY id DESC LIMIT 1");
  $lr = mysql_fetch_assoc($Var);
  
  $Var = mysql_query("SELECT count(*) count FROM pago_cuenta WHERE cliente_id='$_GET[id]'");
  $count_pagos_a_cuenta = mysql_fetch_assoc($Var);
  
	if (isset($_POST['guardarPagoCuenta'])) {
	  $cantidad = Filter($_POST['cantidad']);
	  mysql_query("INSERT INTO pago_cuenta (cliente_id,cantidad,room,category,date) VALUES ('$u[id]','$cantidad','$lr[room]','$lr[category]','". time() ."')");
	  $mensaje = '<script>sweetAlert("Perfecto!", "Se han añadido '. $cantidad .'€ pago a cuenta de '. $u[nombre] .' satisfactoriamente.", "success");</script>';
	  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/$_SERVER[REQUEST_URI]#ok'>";
	}  
?>
<?php echo $mensaje; ?>
	<main>
	<div class="container">
      <div class="row">
        <div class="col s12 m12">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Pago a cuenta &#187; <?php echo $u['nombre']; ?> <?php echo $u['apellidos']; ?></span>
              <b>¿Que es pago a cuenta?</b> Pago a cuenta es un sistema diseñado para los clientes por si desean pagar el alquiler de la habitación antes de tiempo con cierta cantidad no superando el tiempo límite.
			  <br>
			  <div class="row">
			   <form method="POST">
			   <br>
			    <table>
				  <tbody>
				    <tr>
					 <td style="float: left;background: #ffffff61;padding: 6px 14px;margin-bottom: 12px;">Cantidad a pagar</td>
					 <td style="float: left;padding: 0px 8px;margin-top: -4px;"><input style="margin: 0;background: #ffffff7a;border-radius: 3px;padding: 0px;border: none;text-align: center;font-weight: bold;font-size: 22px;" type="number" step="any" min="0" value="0" name="cantidad" class="validate" placeholder="Introducir cantidad a pagar" required></td>
					</tr>
					<tr>
					 <td style="float: left;background: #ffffff61;padding: 6px 35px;margin-top: 9px;">Habitación</td>
					 <td style="float: left;"><x style="background: <?php echo $lr['category']; ?>;color: #fff;font-weight: bold;padding: 7px 54px;border: 3px solid #00000040;border-radius: 3px;">Habitación número <?php echo $lr['room']; ?></x></td>
					</tr>
					<tr>
					 <td><button type="submit" name="guardarPagoCuenta" class="btn">Pagar</button></td>
					</tr>
				  </tbody>
				</table>
				<!--div class="input-field col s12 m2">
				  Cantidad a pagar:
				</div>
				<div class="input-field col s12 m3">
				  Habitación:<br>
				  <x style="background: <?php echo $lr['category']; ?>;color: #fff;font-weight: bold;padding: 2px 17px;border: 3px solid #00000040;border-radius: 3px;">Número <?php echo $lr['room']; ?></x>
				</div>
				<div class="input-field col s12 m4">
				  <button type="submit" name="guardarPagoCuenta" class="btn">Pagar</button>
				</div-->
			   </form>
			  </div>
			  <br><br>
			  <?php $hh_sql = mysql_query("SELECT * FROM alquiler WHERE cliente_id='$u[id]' ORDER BY id DESC LIMIT 1"); while($h = mysql_fetch_assoc($hh_sql)) { ?>
				<?php
				$date1 = new DateTime("". $h[ano_entrada] ."-". $h[mes_entrada] ."-". $h[dia_entrada] ."");
				$date2 = new DateTime("". $h[ano_salida] ."-". $h[mes_salida] ."-". $h[dia_salida] ."");
				$interval = $date1->diff($date2);
				?>
				<hr>
				El cliente se va a quedar <x style="border-bottom: 1px dashed;"><?php echo $interval->days; ?> días</x> desde el <?php echo $h['dia_entrada']; ?> de <?php echo getMonthPerDay($h['mes_entrada']); ?> del <?php echo $h['ano_entrada']; ?> hasta el <?php echo $h['dia_salida']; ?> de <?php echo getMonthPerDay($h['mes_salida']); ?> del <?php echo $h['ano_salida']; ?>.<br>
				El precio por persona es <?php echo $h['price_persona']; ?>€ y se hospeda <?php echo $h['num_personas']; ?> personas <b>TOTAL: <?php echo $h['price_persona']*$h['num_personas']*$interval->days; ?>€</b><br>
				<b>Pagos realizados:</b> <?php echo $count_pagos_a_cuenta['count']; ?><br>
				<?php $total = $h['price_persona']*$h['num_personas']*$interval->days; ?>
				Debe un total de: 
				<?php
				$result = mysql_query("SELECT SUM(cantidad) as total FROM pago_cuenta WHERE cliente_id=$u[id]");
				$row = mysql_fetch_array($result, MYSQL_ASSOC);
				echo $total-$row["total"];
				?>€
				(<?php echo $total; ?>€-<?php echo $row["total"]; ?>€)
				
				<table class="responsive-table bordered">
				  <thead>
					<tr>
					  <td>#</td>
					  <td>Cantidad pagada</td>
					  <td>Habitación</td>
					  <td>Fecha</td>
					</tr>
				  </thead>
				  <tbody>
				  <?php $p_sql = mysql_query("SELECT * FROM pago_cuenta WHERE cliente_id='$u[id]' ORDER BY id DESC"); while($p = mysql_fetch_assoc($p_sql)) { ?>
					<tr>
					  <td><?php echo $p['id']; ?></td>
					  <td><?php echo $p['cantidad']; ?> €</td>
					  <td><x style="background: <?php echo $p['category']; ?>;color: #fff;font-weight: bold;padding: 7px 54px;border: 3px solid #00000040;border-radius: 3px;"><?php echo $p['room']; ?></x></td>
					  <td><?php echo date("d/m/y", $p['date']); ?></td>
					</tr>
				  <?php } ?>
				  </tbody>
				</table>
			  <?php } ?>
            </div>
          </div>
        </div>
      </div>
	</div>
	</main>
  
	<?php require 'templates/footer.php'; ?>