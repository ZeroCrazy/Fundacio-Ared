<?php

	$page = "Home";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
	
  $Var = mysql_query("SELECT count(*) count FROM clientes");
  $count_clientes = mysql_fetch_assoc($Var);
  
  $Var = mysql_query("SELECT count(*) count FROM rooms");
  $count_habitaciones = mysql_fetch_assoc($Var);
  
  $Var = mysql_query("SELECT count(*) count FROM alquiler WHERE dia_entrada='". date("d") ."' AND mes_entrada='$mes' AND ano_entrada='$ano'");
  $count_calendario = mysql_fetch_assoc($Var);
  
  $Var = mysql_query("SELECT count(*) count FROM historial");
  $count_historial = mysql_fetch_assoc($Var);
?>

	<main>
	<div class="container">
	  <div class="row">
		<div class="col s12 m3">
		  <div class="card" style="background: transparent;box-shadow: none;text-align: center;">
            <div class="card-content grey-text">
              <p>
			  <img src="<?php echo $site . "/" . $cdn; ?>/images/calendario.png" width="200" height="200"><br>
			  <h5 style="color: #212529;font-weight: 500;">Calendario (HOY)</h5>
			  <b><?php echo $count_habitaciones['count']-$count_calendario['count']; ?></b> habitacion(es) <x style="color: green;">libres</x><br> Hay <b><?php echo $count_calendario['count']; ?></b> habitacion(es) <x style="color: red;">ocupadas</x>
			  </p>
            </div>
          </div>
		</div>
		<div class="col s12 m3">
		  <div class="card" style="background: transparent;box-shadow: none;text-align: center;">
            <div class="card-content grey-text">
              <p>
			  <img src="<?php echo $site . "/" . $cdn; ?>/images/clientes.png" width="200" height="200"><br>
			  <h5 style="color: #212529;font-weight: 500;">Clientes</h5>
			  <b><?php echo $count_clientes['count']; ?></b> cliente(s)
			  </p>
            </div>
          </div>
		</div>
		<div class="col s12 m3">
		  <div class="card" style="background: transparent;box-shadow: none;text-align: center;">
            <div class="card-content grey-text">
              <p>
			  <img src="<?php echo $site . "/" . $cdn; ?>/images/habitaciones.png" width="200" height="200"><br>
			  <h5 style="color: #212529;font-weight: 500;">Habitaciones</h5>
			  <b><?php echo $count_habitaciones['count']; ?></b> habitaciones
			  </p>
            </div>
          </div>
		</div>
		<div class="col s12 m3">
		  <div class="card" style="background: transparent;box-shadow: none;text-align: center;">
            <div class="card-content grey-text">
              <p>
			  <img src="<?php echo $site . "/" . $cdn; ?>/images/historial.png" width="200" height="200"><br>
			  <h5 style="color: #212529;font-weight: 500;">Historial</h5>
			  <b><?php echo $count_historial['count']; ?></b> acciones realizadas
			  </p>
            </div>
          </div>
		</div>
		<div class="col s12 m12">
		<a class="waves-effect waves-light btn-large #311b92 deep-purple darken-4" href="<?php echo $site; ?>/room.php" style="width: 100%;">ALQUILAR HABITACIÓN</a>
		</div>
		<div class="col s12 m6"><br>
		<a class="waves-effect waves-light btn-large modal-trigger #880e4f pink darken-4" href="#ConsultarDesayunos" style="width: 100%;">CONSULTAR DESAYUNOS</a>
		  <div id="ConsultarDesayunos" class="modal">
			<div class="modal-content">
			  <h4>Desayunos &#187; Mes de <b><?php echo $mes; ?></b></h4>
			  <div class="row">
				<div class="col s12 m4">
				 <a class="waves-effect waves-light btn-large modal-trigger" href="<?php echo $site; ?>/index.php?dia=<?php echo date("j")-1; ?>&mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>" style="width: 100%;">Ayer</a>
				</div>
				<div class="col s12 m4">
				 <a class="waves-effect waves-light btn-large modal-trigger" href="<?php echo $site; ?>/index.php?dia=<?php echo date("j"); ?>&mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>" style="width: 100%;">Hoy</a>
				</div>
				<div class="col s12 m4">
				 <a class="waves-effect waves-light btn-large modal-trigger" href="<?php echo $site; ?>/index.php?dia=<?php echo date("j")+1; ?>&mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>" style="width: 100%;">Mañana</a>
				</div>
			  </div>
			  <table>
				<thead>
				  <tr>
					<td>Nº Hab</td>
					<td>Cliente</td>
					<td>Personas</td>
					<td>Entrada</td>
					<td>Salida</td>
				  </tr>
				</thead>
				<tbody>
				<?php $d_sql = mysql_query("SELECT * FROM alquiler WHERE desayuno='1' ORDER BY id DESC"); while($d = mysql_fetch_assoc($d_sql)){ ?>
				  <!--tr>
					<td><?php echo $d['room']; ?> <div style="width: 15px;height: 15px;background: <?php echo $d['category']; ?>;float:left;margin-right: 4px;"></div></td>
					<td><?php echo NombreCliente($d['cliente_id']); ?></td>
					<td><?php echo $d['num_personas']; ?></td>
					<td><?php echo $d['dia_entrada']; ?> de <?php echo getMonthPerDay($d['mes_entrada']); ?> del <?php echo $d['ano_entrada']; ?></td>
					<td><?php echo $d['dia_salida']; ?> de <?php echo getMonthPerDay($d['mes_salida']); ?> del <?php echo $d['ano_salida']; ?></td>
				  </tr-->
<?php
$fecha_salida = new DateTime("". $d[dia_salida] ."-". $d[mes_salida] ."-". $d[ano_salida] ."");
$fecha_entrada = new DateTime("". $d[dia_entrada] ."-". $d[mes_entrada] ."-". $d[ano_entrada] ."");
//$fecha_hoy = new DateTime("". date('j') ."-". date('m') ."-". date('Y') ."");
$fecha_hoy = new DateTime("". $_GET[dia] ."-". $_GET[mes] ."-". $_GET[ano] ."");
?>

<?php if ($fecha_hoy > $fecha_salida) { // Fecha de hoy es superior a la fecha de salida ?>
<?php } elseif ($fecha_hoy < $fecha_entrada) { // Fecha de hoy está antes de la fecha de entrada ?>
<?php } else { // Habitación ocupada ?>
				  <tr>
					<td><?php echo $d['room']; ?> <div style="width: 15px;height: 15px;background: <?php echo $d['category']; ?>;float:left;margin-right: 4px;"></div></td>
					<td><?php echo NombreCliente($d['cliente_id']); ?></td>
					<td><?php echo $d['num_personas']; ?></td>
					<td><?php echo $d['dia_entrada']; ?> de <?php echo getMonthPerDay($d['mes_entrada']); ?> del <?php echo $d['ano_entrada']; ?></td>
					<td><?php echo $d['dia_salida']; ?> de <?php echo getMonthPerDay($d['mes_salida']); ?> del <?php echo $d['ano_salida']; ?></td>
				  </tr>
<?php } ?>
				<?php } ?>
				</tbody>
			  </table>
			</div>
			<div class="modal-footer">
			  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">CERRAR</a>
			</div>
		  </div>
		</div>
		<div class="col s12 m6"><br>
		<a class="waves-effect waves-light btn-large modal-trigger #546e7a blue-grey darken-1" href="#ConsultarCenas" style="width: 100%;">CONSULTAR CENAS</a>
		  <div id="ConsultarCenas" class="modal">
			<div class="modal-content">
			  <h4>Cenas &#187; Mes de <b><?php echo $mes; ?></b></h4>
			  <div class="row">
				<div class="col s12 m4">
				 <a class="waves-effect waves-light btn-large modal-trigger" href="<?php echo $site; ?>/index.php?dia=<?php echo date("j")-1; ?>&mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>" style="width: 100%;">Ayer</a>
				</div>
				<div class="col s12 m4">
				 <a class="waves-effect waves-light btn-large modal-trigger" href="<?php echo $site; ?>/index.php?dia=<?php echo date("j"); ?>&mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>" style="width: 100%;">Hoy</a>
				</div>
				<div class="col s12 m4">
				 <a class="waves-effect waves-light btn-large modal-trigger" href="<?php echo $site; ?>/index.php?dia=<?php echo date("j")+1; ?>&mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>" style="width: 100%;">Mañana</a>
				</div>
			  </div>
			  <table>
				<thead>
				  <tr>
					<td>Nº Hab</td>
					<td>Cliente</td>
					<td>Personas</td>
					<td>Entrada</td>
					<td>Salida</td>
				  </tr>
				</thead>
				<tbody>
				<?php $d_sql = mysql_query("SELECT * FROM alquiler WHERE cena='1' ORDER BY id DESC"); while($d = mysql_fetch_assoc($d_sql)){ ?>
				  <!--tr>
					<td><?php echo $d['room']; ?> <div style="width: 15px;height: 15px;background: <?php echo $d['category']; ?>;float:left;margin-right: 4px;"></div></td>
					<td><?php echo NombreCliente($d['cliente_id']); ?></td>
					<td><?php echo $d['num_personas']; ?></td>
					<td><?php echo $d['dia_entrada']; ?> de <?php echo getMonthPerDay($d['mes_entrada']); ?> del <?php echo $d['ano_entrada']; ?></td>
					<td><?php echo $d['dia_salida']; ?> de <?php echo getMonthPerDay($d['mes_salida']); ?> del <?php echo $d['ano_salida']; ?></td>
				  </tr-->
<?php
$fecha_salida = new DateTime("". $d[dia_salida] ."-". $d[mes_salida] ."-". $d[ano_salida] ."");
$fecha_entrada = new DateTime("". $d[dia_entrada] ."-". $d[mes_entrada] ."-". $d[ano_entrada] ."");
//$fecha_hoy = new DateTime("". date('j') ."-". date('m') ."-". date('Y') ."");
$fecha_hoy = new DateTime("". $_GET[dia] ."-". $_GET[mes] ."-". $_GET[ano] ."");
?>

<?php if ($fecha_hoy > $fecha_salida) { // Fecha de hoy es superior a la fecha de salida ?>
<?php } elseif ($fecha_hoy < $fecha_entrada) { // Fecha de hoy está antes de la fecha de entrada ?>
<?php } else { // Habitación ocupada ?>
				  <tr>
					<td><?php echo $d['room']; ?> <div style="width: 15px;height: 15px;background: <?php echo $d['category']; ?>;float:left;margin-right: 4px;"></div></td>
					<td><?php echo NombreCliente($d['cliente_id']); ?></td>
					<td><?php echo $d['num_personas']; ?></td>
					<td><?php echo $d['dia_entrada']; ?> de <?php echo getMonthPerDay($d['mes_entrada']); ?> del <?php echo $d['ano_entrada']; ?></td>
					<td><?php echo $d['dia_salida']; ?> de <?php echo getMonthPerDay($d['mes_salida']); ?> del <?php echo $d['ano_salida']; ?></td>
				  </tr>
<?php } ?>
				<?php } ?>
				</tbody>
			  </table>
			</div>
			<div class="modal-footer">
			  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">CERRAR</a>
			</div>
		  </div>
		</div>
		<div class="col s12 m12"><br>
		<a class="waves-effect waves-light btn-large #3e2723 brown darken-4" href="<?php echo $site; ?>/clientes.php" style="width: 100%;">PAGAR A CUENTA</a>
		</div>
	  </div>
	</div>
	</main>
  
	<?php require 'templates/footer.php'; ?>