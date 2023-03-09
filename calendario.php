<?php

	$page = "Calendario";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
?>
	<br>
	<main>
	<div class="container">
	  <div class="row">
	   <?php $c_sql = mysql_query("SELECT * FROM alquiler ORDER BY id DESC"); while($c = mysql_fetch_assoc($c_sql)){ ?>
	    <?php if($c['id'] == '0') { ?><?php } else { ?>
		<div class="col s12 m4">
			<div class="card-panel" style="padding: 0px;">
			  <span class="black-text">
			    <div style="text-align: center;padding: 10px 0px;background: #1975d2;color: #fff;">
				  Entrada <b class="white-text text-darken-2"><?php echo $c['dia_entrada']; ?> de <?php echo getMonthPerDay($c['mes_entrada']); ?> del <?php echo $c['ano_entrada']; ?></b><br>
				  Salida <b class="white-text text-darken-2"><?php echo $c['dia_salida']; ?> de <?php echo getMonthPerDay($c['mes_salida']); ?> del <?php echo $c['ano_salida']; ?></b>
				<?php
				$date1 = new DateTime("". $c[ano_entrada] ."-". $c[mes_entrada] ."-". $c[dia_entrada] ."");
				$date2 = new DateTime("". $c[ano_salida] ."-". $c[mes_salida] ."-". $c[dia_salida] ."");
				$interval = $date1->diff($date2);

				//echo "<br><br>Diferencia entre las dos fechas:<br> " . $interval->y . " años, " . $interval->m." meses, ".$interval->d." dias "; 
				echo "<br>(" . $interval->days . " días)";
				?>
				</div>
				<div style="text-align: center;padding: 6px 0px;background: <?php echo $c['category']; ?>;color: #fff;border: 2px solid rgba(0, 0, 0, 0.12);">
				  <b class="white-text text-darken-2">Habitación <?php echo $c['room']; ?></b>
				</div>
				<div style="padding: 24px;">
				<style>td{padding: 2px 4px;}</style>
				<table class="striped responsive-table" style="border: 3px solid #f3f3f2;">
				  <tbody>
					<tr>
					  <td><b>Cliente:</b></td>
					  <td><a style="color: #464646;border-bottom: 1px dashed;" href="<?php echo $site; ?>/clientes.php?edit=<?php echo $c['cliente_id']; ?>"><?php echo NombreCliente($c['cliente_id']); ?></a></td>
					</tr>
					<tr>
					  <td><b>Nº de personas:</b></td>
					  <td><?php echo $c['num_personas']; ?></td>
					</tr>
					<tr>
					  <td><b>Desayuno:</b></td>
					  <td><?php if($c['desayuno'] == '1') { ?>Sí<?php } else { ?>No<?php } ?></td>
					</tr>
					<tr>
					  <td><b>Cena:</b></td>
					  <td><?php if($c['cena'] == '1') { ?>Sí<?php } else { ?>No<?php } ?></td>
					</tr>
					<tr>
					  <td><b>Forma de pago:</b></td>
					  <td><?php if($c['payment'] == 'efectivo') { ?>Efectivo<?php } else { ?>Transferencia<?php } ?></td>
					</tr>
				  </tbody>
				</table>
				</div>
				<?php
				  if($c['cena'] == '0'){ $cena = 0; } else { $cena = $c['price_cena']; }
				  if($c['desayuno'] == '0'){ $desayuno = 0; } else { $desayuno = $c['price_desayuno']; }
				  $habitacion = $c['price_habitacion'];
				  $subtotal = $cena+$habitacion+$desayuno;
				  //echo "TOTAL " . $subtotal*$c['num_habitaciones']*$interval->days . "€";
				?>
				<a href="<?php echo $site; ?>/clientes.php?edit=<?php echo $c['cliente_id']; ?>&historial=show">  
				  <div style="text-align: center;padding: 4px 0px;background: #e65100;color: #fff;border: 3px solid rgba(0, 0, 0, 0.12);">
				    <b class="white-text text-darken-2">Ver factura</b>
				  </div>
				</a>
				<?php if($user['rank'] == ''. $rango_administrador .'') { ?>
				<a href="<?php echo $site; ?>/calendario_modificar.php?id=<?php echo $c['id']; ?>&alquilar=<?php echo $c['room']; ?>&category=<?php echo $c['category']; ?>"> 
				  <div style="text-align: center;padding: 4px 0px;background: #1975d2;color: #fff;border: 3px solid rgba(0, 0, 0, 0.12);">
				    <b class="white-text text-darken-2">Modificar</b>
				  </div>
				</a>
				<?php } ?>
			  </span>
			</div>
		</div>
		<?php } ?>
	   <?php } if(mysql_num_rows($c_sql) == 0) { ?>
		<div class="col s12 m12" style="margin-top: 40px;">
		  <div class="card #b71c1c red darken-4">
			<div class="card-content white-text">
			  <span class="card-title center">No hay ninguna reserva</span>
			</div>
		  </div>
		</div>
	   <?php } ?>
	  </div>
	</div>
	
	</main>
  
	<?php require 'templates/footer.php'; ?>