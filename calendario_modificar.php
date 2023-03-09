<?php

	$page = "Calendario";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
	
	if($user['rank'] == ''. $rango_administrador .'') {} else { header("Location: $site"); }
	
  if (isset($_POST['GuardarCambiosRoom'])) {
  $dia_entrada = Filter($_POST['dia_entrada']);
  $mes_entrada = Filter($_POST['mes_entrada']);
  $ano_entrada = Filter($_POST['ano_entrada']);
  $dia_salida = Filter($_POST['dia_salida']);
  $mes_salida = Filter($_POST['mes_salida']);
  $ano_salida = Filter($_POST['ano_salida']);
  $cliente_id = Filter($_POST['cliente_id']);
  $num_personas = Filter($_POST['num_personas']);
  $desayuno = Filter($_POST['desayuno']);
  $cena = Filter($_POST['cena']);
  $payment = Filter($_POST['payment']);
  $Falloxd = false;
  if(empty($dia_entrada)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado día entrada", "error");</script>';
	$Falloxd = true;
  }else{
  if(empty($mes_entrada)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado mes entrada", "error");</script>';
	$Falloxd = true;
  }else{
  if(empty($ano_entrada)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado año entrada", "error");</script>';
	$Falloxd = true;
  }else{
  if(empty($dia_salida)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado día salida", "error");</script>';
	$Falloxd = true;
  }else{
  if(empty($mes_salida)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado mes salida", "error");</script>';
	$Falloxd = true;
  }else{
  if(empty($ano_salida)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado año salida", "error");</script>';
	$Falloxd = true;
  }else{
  if(empty($cliente_id)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado un cliente", "error");</script>';
	$Falloxd = true;
  }else{
  if(empty($num_personas)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado número de personas", "error");</script>';
	$Falloxd = true;
  }}}}}}}}
  if($Falloxd == false) {
  mysql_query("UPDATE alquiler SET room='$_GET[alquilar]', category='$_GET[category]', dia_entrada='$dia_entrada', mes_entrada='$mes_entrada', ano_entrada='$ano_entrada', dia_salida='$dia_salida', mes_salida='$mes_salida', ano_salida='$ano_salida', cliente_id='$cliente_id', num_personas='$num_personas', desayuno='$desayuno', cena='$cena', payment='$payment' WHERE id='$_GET[id]'");
  $mensaje = '<script>sweetAlert("Perfecto!", "Los cambios han sido guardados", "success");</script>';
  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$cliente_id','$page','Ha modificado un alquiler','". time() ."')");
  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/calendario.php'>";
  }
  }
  
if (isset($_POST['borrarReserva'])) {
  mysql_query("DELETE FROM alquiler WHERE id='". $_GET[id] ."'");
  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha eliminado una reserva','". time() ."')");
  header("Location: $site/calendario.php");
}
	
?>
<?php echo $mensaje; ?>
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
	<br>
	<main>
	<div class="container">
	  <div class="row">
	   <?php $h_sql = mysql_query("SELECT * FROM alquiler WHERE id = $_GET[id]"); while($h = mysql_fetch_assoc($h_sql)){ ?>
		<div class="col s12 m12">
		  <div class="card white darken-1">
			<div class="card-content">
<form method="POST">
              <span class="card-title">Calendario &#187; Modificar datos reserva</span>
              <div class="row">
				<div class="input-field col s12 m12">
				<?php if($h['cliente_id'] == '') { ?>
				  <select name="cliente_id">
					<option value="" disabled selected>Seleccionar cliente</option>
					<?php $cx_sql = mysql_query("SELECT * FROM clientes ORDER BY id DESC"); while($c = mysql_fetch_assoc($cx_sql)){ ?>
					 <option value="<?php echo $c['id']; ?>"><?php echo $c['nombre']; ?> <?php echo $c['apellidos']; ?></option>
					<?php } ?>
				  </select>
				<?php } else { ?>
				  <select name="cliente_id">
					<option value="" disabled>Seleccionar cliente</option>
					 <option value="<?php echo $h['cliente_id']; ?>" selected><?php echo NombreCliente($h['cliente_id']); ?></option>
				  </select>
				<?php } ?>
				</div>
				<div class="input-field col s12 m6">
				<b>ENTRADA</b><br>
				  <div class="input-field col s12 m4">
					<select name="dia_entrada">
					  <?php if($h['dia_entrada'] == '') { ?><option value="" disabled selected>Día</option><?php } else { ?><option value="<?php echo $h['dia_entrada']; ?>" selected><?php echo $h['dia_entrada']; ?></option><?php } ?>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  <option value="6">6</option>
					  <option value="7">7</option>
					  <option value="8">8</option>
					  <option value="9">9</option>
					  <option value="10">10</option>
					  <option value="11">11</option>
					  <option value="12">12</option>
					  <option value="13">13</option>
					  <option value="14">14</option>
					  <option value="15">15</option>
					  <option value="16">16</option>
					  <option value="17">17</option>
					  <option value="18">18</option>
					  <option value="19">19</option>
					  <option value="20">20</option>
					  <option value="21">21</option>
					  <option value="22">22</option>
					  <option value="23">23</option>
					  <option value="24">24</option>
					  <option value="25">25</option>
					  <option value="26">26</option>
					  <option value="27">27</option>
					  <option value="28">28</option>
					  <option value="29">29</option>
					  <option value="30">30</option>
					  <option value="31">31</option>
					</select>
				  </div>
				  <div class="input-field col s12 m4">
					<select name="mes_entrada">
					  <?php if($h['mes_entrada'] == '') { ?><option value="" disabled selected>Mes</option><?php } else { ?><option value="<?php echo $h['mes_entrada']; ?>" selected><?php echo getMonthPerDay($h['mes_entrada']); ?></option><?php } ?>
					  <option value="Enero">Enero</option>
					  <option value="Febrero">Febrero</option>
					  <option value="Marzo">Marzo</option>
					  <option value="Abril">Abril</option>
					  <option value="Mayo">Mayo</option>
					  <option value="Junio">Junio</option>
					  <option value="Julio">Julio</option>
					  <option value="Agosto">Agosto</option>
					  <option value="Septiembre">Septiembre</option>
					  <option value="Octubre">Octubre</option>
					  <option value="Noviembre">Noviembre</option>
					  <option value="Diciembre">Diciembre</option>
					</select>
				  </div>
				  <div class="input-field col s12 m4">
					<select name="ano_entrada">
					  <?php if($h['ano_entrada'] == '') { ?><option value="" disabled selected>Año</option><?php } else { ?><option value="<?php echo $h['ano_entrada']; ?>" selected><?php echo $h['ano_entrada']; ?></option><?php } ?>
					  <option value="<?php echo date("Y")-1; ?>"><?php echo date("Y")-1; ?></option>
					  <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
					  <option value="<?php echo date("Y")+1; ?>"><?php echo date("Y")+1; ?></option>
					  <option value="<?php echo date("Y")+2; ?>"><?php echo date("Y")+2; ?></option>
					  <option value="<?php echo date("Y")+3; ?>"><?php echo date("Y")+3; ?></option>
					  <option value="<?php echo date("Y")+4; ?>"><?php echo date("Y")+4; ?></option>
					  <option value="<?php echo date("Y")+5; ?>"><?php echo date("Y")+5; ?></option>
					  <option value="<?php echo date("Y")+6; ?>"><?php echo date("Y")+6; ?></option>
					</select>
				  </div>
				</div>
				<div class="input-field col s12 m6">
				<b>SALIDA</b><br>
				  <div class="input-field col s12 m4">
					<select name="dia_salida">
					  <?php if($h['dia_salida'] == '') { ?><option value="" disabled selected>Día</option><?php } else { ?><option value="<?php echo $h['dia_salida']; ?>" selected><?php echo $h['dia_salida']; ?></option><?php } ?>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  <option value="6">6</option>
					  <option value="7">7</option>
					  <option value="8">8</option>
					  <option value="9">9</option>
					  <option value="10">10</option>
					  <option value="11">11</option>
					  <option value="12">12</option>
					  <option value="13">13</option>
					  <option value="14">14</option>
					  <option value="15">15</option>
					  <option value="16">16</option>
					  <option value="17">17</option>
					  <option value="18">18</option>
					  <option value="19">19</option>
					  <option value="20">20</option>
					  <option value="21">21</option>
					  <option value="22">22</option>
					  <option value="23">23</option>
					  <option value="24">24</option>
					  <option value="25">25</option>
					  <option value="26">26</option>
					  <option value="27">27</option>
					  <option value="28">28</option>
					  <option value="29">29</option>
					  <option value="30">30</option>
					  <option value="31">31</option>
					</select>
				  </div>
				  <div class="input-field col s12 m4">
					<select name="mes_salida">
					  <?php if($h['mes_salida'] == '') { ?><option value="" disabled selected>Mes</option><?php } else { ?><option value="<?php echo $h['mes_salida']; ?>" selected><?php echo getMonthPerDay($h['mes_salida']); ?></option><?php } ?>
					  <option value="Enero">Enero</option>
					  <option value="Febrero">Febrero</option>
					  <option value="Marzo">Marzo</option>
					  <option value="Abril">Abril</option>
					  <option value="Mayo">Mayo</option>
					  <option value="Junio">Junio</option>
					  <option value="Julio">Julio</option>
					  <option value="Agosto">Agosto</option>
					  <option value="Septiembre">Septiembre</option>
					  <option value="Octubre">Octubre</option>
					  <option value="Noviembre">Noviembre</option>
					  <option value="Diciembre">Diciembre</option>
					</select>
				  </div>
				  <div class="input-field col s12 m4">
					<select name="ano_salida">
					  <?php if($h['ano_salida'] == '') { ?><option value="" disabled selected>Año</option><?php } else { ?><option value="<?php echo $h['ano_salida']; ?>" selected><?php echo $h['ano_salida']; ?></option><?php } ?>
					  <option value="<?php echo date("Y")-1; ?>"><?php echo date("Y")-1; ?></option>
					  <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
					  <option value="<?php echo date("Y")+1; ?>"><?php echo date("Y")+1; ?></option>
					  <option value="<?php echo date("Y")+2; ?>"><?php echo date("Y")+2; ?></option>
					  <option value="<?php echo date("Y")+3; ?>"><?php echo date("Y")+3; ?></option>
					  <option value="<?php echo date("Y")+4; ?>"><?php echo date("Y")+4; ?></option>
					  <option value="<?php echo date("Y")+5; ?>"><?php echo date("Y")+5; ?></option>
					  <option value="<?php echo date("Y")+6; ?>"><?php echo date("Y")+6; ?></option>
					</select>
				  </div>
				</div>
				<div class="input-field col s12 m6">
				  <b>Nº Personas</b>
				  <p class="range-field">
				    <input type="range" name="num_personas" id="personas" min="1" max="<?php if($h['num_personas'] == '') { ?>2<?php } else { ?><?php echo $h['num_personas']; ?><?php } ?>" />
				  </p>
				</div>
				<div class="input-field col s12 m6">
				<b>Habitación seleccionada</b><br>
				  <?php if($h['room'] == '') { ?>
				  <x style="color: red;">Debes asignar una habitación</x><br>
				  <a class="waves-effect waves-light modal-trigger" href="#ConsultRooms" style="width: 100%;">Asignar habitación</a>
				  <br><br><br><br>
				  <?php } else { ?>
				  <a class="waves-effect waves-light modal-trigger" href="#ConsultRooms" style="width: 100%;">Cambiar habitación</a>
				  <br><br>
				  <x style="background: <?php echo $h['category']; ?>;color: #fff;font-weight: bold;padding: 5px 17px;border: 3px solid #00000040;border-radius: 3px;">Has seleccionado la habitación número <?php echo $h['room']; ?></x>
				  <br><br>
				  <?php }?>
				</div>
				<div class="input-field col s12 m4">
				  <select name="payment">
					<option value="" disabled>Forma de pago</option>
					<?php if($h['payment'] == 'efectivo') { ?>
					<option value="efectivo" selected>Efectivo</option>
					<option value="transferencia">Transferencia</option>
					<?php } else { ?>
					<option value="transferencia" selected>Transferencia</option>
					<option value="efectivo">Efectivo</option>
					<?php } ?>
				  </select>
				</div>
				<div class="input-field col s12 m4">
				  <select name="desayuno">
					<option value="" disabled>Desayuno</option>
					<?php if($h['desayuno'] == '1') { ?>
					<option value="1" selected>Sí</option>
					<option value="0">No</option>
					<?php } else { ?>
					<option value="0" selected>No</option>
					<option value="1">Sí</option>
					<?php } ?>
				  </select>
				</div>
				<div class="input-field col s12 m4">
				  <select name="cena">
					<option value="" disabled>Cena</option>
					<?php if($h['cena'] == '1') { ?>
					<option value="1" selected>Sí</option>
					<option value="0">No</option>
					<?php } else { ?>
					<option value="0" selected>No</option>
					<option value="1">Sí</option>
					<?php } ?>
				  </select>
				</div>
				<div class="input-field col s12 m12">
				<button type="submit" name="GuardarCambiosRoom" class="waves-effect waves-light btn-large modal-trigger" style="width: 100%;">Finalizar</button>
				<button type="submit" name="borrarReserva" style="margin-top: 10px;width: 100%;" class="waves-effect waves-light btn-large white-text #b71c1c red darken-4">Borrar reserva <?php echo $h[id]; ?></button>
				</div>
				<div class="input-field col s12 m12">
				  <div class="card #ffe57f amber accent-1" style="box-shadow: none;color: #826805;">
					<div class="card-content">
					  <p><b>Nota:</b> Si el cliente va a pagar mediante transferencia, debe ingresarlo en la siguiente cuenta:<br>LaCaixa, 21 00 3106 27 2200159700 (IBAN ES89 2100 3106 2722 0015 9700)</p>
					</div>
				  </div>
				</div>
			  </div>
            </div>
          </div>
        </div>
		</form>
			</div>
		  </div>
		</div>
	   <?php } ?>
	  </div>
	</div>
	
	<div id="ConsultRooms" class="modal" style="width: 100%;    height: 100%;    max-height: 100%;    margin-top: -98px;">
    <div class="modal-content">
      <h4>Habitaciones &#187; Disponibilidad <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a></h4>
	  <div class="container">
	    <div class="row">
<?php if($_GET['dia'] == '') { ?>
<form method="GET">
				<div class="input-field col s12 m12">
				<b>BUSCADOR FECHAS DISPONIBILIDAD</b><br>
				  <div class="input-field col s12 m4">
					<select name="dia">
					  <option value="" disabled selected>Día</option>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  <option value="6">6</option>
					  <option value="7">7</option>
					  <option value="8">8</option>
					  <option value="9">9</option>
					  <option value="10">10</option>
					  <option value="11">11</option>
					  <option value="12">12</option>
					  <option value="13">13</option>
					  <option value="14">14</option>
					  <option value="15">15</option>
					  <option value="16">16</option>
					  <option value="17">17</option>
					  <option value="18">18</option>
					  <option value="19">19</option>
					  <option value="20">20</option>
					  <option value="21">21</option>
					  <option value="22">22</option>
					  <option value="23">23</option>
					  <option value="24">24</option>
					  <option value="25">25</option>
					  <option value="26">26</option>
					  <option value="27">27</option>
					  <option value="28">28</option>
					  <option value="29">29</option>
					  <option value="30">30</option>
					  <option value="31">31</option>
					</select>
				  </div>
				  <div class="input-field col s12 m4">
					<select name="mes">
					  <option value="" disabled selected>Mes</option>
					  <option value="1">Enero</option>
					  <option value="2">Febrero</option>
					  <option value="3">Marzo</option>
					  <option value="4">Abril</option>
					  <option value="5">Mayo</option>
					  <option value="6">Junio</option>
					  <option value="7">Julio</option>
					  <option value="8">Agosto</option>
					  <option value="9">Septiembre</option>
					  <option value="10">Octubre</option>
					  <option value="11">Noviembre</option>
					  <option value="12">Diciembre</option>
					</select>
				  </div>
				  <div class="input-field col s12 m4">
					<select name="ano">
					  <option value="" disabled selected>Año</option>
					  <option value="<?php echo date("Y")-1; ?>"><?php echo date("Y")-1; ?></option>
					  <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
					  <option value="<?php echo date("Y")+1; ?>"><?php echo date("Y")+1; ?></option>
					  <option value="<?php echo date("Y")+2; ?>"><?php echo date("Y")+2; ?></option>
					  <option value="<?php echo date("Y")+3; ?>"><?php echo date("Y")+3; ?></option>
					  <option value="<?php echo date("Y")+4; ?>"><?php echo date("Y")+4; ?></option>
					  <option value="<?php echo date("Y")+5; ?>"><?php echo date("Y")+5; ?></option>
					  <option value="<?php echo date("Y")+6; ?>"><?php echo date("Y")+6; ?></option>
					</select>
				  </div>
				  <div class="input-field col s12 m12">
				  <button type="submit" class="waves-effect waves-light btn-large modal-trigger" style="width: 100%;">Buscar fecha</button>
				  </div>
				</div>
				<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
				</form>
<?php } else { ?>
<form method="GET">
				<div class="input-field col s12 m12">
				<b>BUSCADOR FECHAS DISPONIBILIDAD</b><br>
				  <div class="input-field col s12 m4">
					<select name="dia">
					  <option value="<?php echo $_GET['dia']; ?>" selected><?php echo $_GET['dia']; ?></option>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  <option value="6">6</option>
					  <option value="7">7</option>
					  <option value="8">8</option>
					  <option value="9">9</option>
					  <option value="10">10</option>
					  <option value="11">11</option>
					  <option value="12">12</option>
					  <option value="13">13</option>
					  <option value="14">14</option>
					  <option value="15">15</option>
					  <option value="16">16</option>
					  <option value="17">17</option>
					  <option value="18">18</option>
					  <option value="19">19</option>
					  <option value="20">20</option>
					  <option value="21">21</option>
					  <option value="22">22</option>
					  <option value="23">23</option>
					  <option value="24">24</option>
					  <option value="25">25</option>
					  <option value="26">26</option>
					  <option value="27">27</option>
					  <option value="28">28</option>
					  <option value="29">29</option>
					  <option value="30">30</option>
					  <option value="31">31</option>
					</select>
				  </div>
				  <div class="input-field col s12 m4">
					<select name="mes">
					  <option value="<?php echo $_GET['mes']; ?>" selected><?php echo getMonthPerDay($_GET['mes']); ?></option>
					  <option value="1">Enero</option>
					  <option value="2">Febrero</option>
					  <option value="3">Marzo</option>
					  <option value="4">Abril</option>
					  <option value="5">Mayo</option>
					  <option value="6">Junio</option>
					  <option value="7">Julio</option>
					  <option value="8">Agosto</option>
					  <option value="9">Septiembre</option>
					  <option value="10">Octubre</option>
					  <option value="11">Noviembre</option>
					  <option value="12">Diciembre</option>
					</select>
				  </div>
				  <div class="input-field col s12 m4">
					<select name="ano">
					  <option value="<?php echo $_GET['ano']; ?>" selected><?php echo $_GET['ano']; ?></option>
					  <option value="<?php echo date("Y")-1; ?>"><?php echo date("Y")-1; ?></option>
					  <option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
					  <option value="<?php echo date("Y")+1; ?>"><?php echo date("Y")+1; ?></option>
					  <option value="<?php echo date("Y")+2; ?>"><?php echo date("Y")+2; ?></option>
					  <option value="<?php echo date("Y")+3; ?>"><?php echo date("Y")+3; ?></option>
					  <option value="<?php echo date("Y")+4; ?>"><?php echo date("Y")+4; ?></option>
					  <option value="<?php echo date("Y")+5; ?>"><?php echo date("Y")+5; ?></option>
					  <option value="<?php echo date("Y")+6; ?>"><?php echo date("Y")+6; ?></option>
					</select>
				  </div>
				  <div class="input-field col s12 m12">
				  <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
				  <button type="submit" class="waves-effect waves-light btn-large modal-trigger" style="width: 100%;">Buscar fecha</button>
				  </div>
				</div>
				</form>
				<br><br><br><br>
<div style="background: url(assets/images/grafico.png);width: 1565px;height: 997px;position: absolute;">
  <?php $h_sql = mysql_query("SELECT * FROM rooms ORDER BY id"); while($h = mysql_fetch_assoc($h_sql)){ ?>
	<?php $d_sql = mysql_query("SELECT * FROM alquiler ORDER BY id"); while($d = mysql_fetch_assoc($d_sql)){ ?>
	
<?php
$fecha_salida = new DateTime("". $d[dia_salida] ."-". $d[mes_salida] ."-". $d[ano_salida] ."");
$fecha_entrada = new DateTime("". $d[dia_entrada] ."-". $d[mes_entrada] ."-". $d[ano_entrada] ."");
$fecha_hoy = new DateTime("". $_GET[dia] ."-". $_GET[mes] ."-". $_GET[ano] ."");
?>


<?php if ($fecha_hoy > $fecha_salida) { // Habitación libre porque la fecha de hoy es superior a la fecha de salida ?>
<?php if($h['show'] == '1') { ?>
<a href="<?php echo $site; ?><?php echo $_SERVER['REQUEST_URI']; ?>&alquilar=<?php echo $h['name']; ?>&category=<?php echo $h['category']; ?><?php if($h['status'] == "1") { ?>&status=1<?php } ?>">
  <div class="room_<?php echo $h['category']; ?>" style="<?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
</a>
<?php } ?>
<?php } elseif ($fecha_hoy < $fecha_entrada) { // Habitación libre porque está antes de la fecha de entrada ?>
<?php if($h['show'] == '1') { ?>
<a href="<?php echo $site; ?><?php echo $_SERVER['REQUEST_URI']; ?>&alquilar=<?php echo $h['name']; ?>&category=<?php echo $h['category']; ?><?php if($h['status'] == "1") { ?>&status=1<?php } ?>">
  <div class="room_<?php echo $h['category']; ?>" style="<?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
</a>
<?php } ?>
<?php } else { // Habitación ocupada ?>
<?php if($h['show'] == '1') { ?>
<a href="<?php echo $site; ?><?php echo $_SERVER['REQUEST_URI']; ?>&alquilar=<?php echo $h['name']; ?>&category=<?php echo $h['category']; ?><?php if($h['status'] == "1") { ?>&status=1<?php } ?>">
  <div class="room_<?php echo $h['category']; ?>" style="<?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
</a>
	<?php if($h['name'] == ''. $d[room] .'') { ?>
	  <?php if($h['category'] == ''. $d[category] .'') { ?>
		<div class="room_<?php echo $h['category']; ?>" style="z-index: 1;background: red;<?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
	    <a class="btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Ocupado hasta <?php echo $d['dia_salida']; ?> de <?php echo getMonthPerDay($d['mes_salida']); ?>, <?php echo $d['ano_salida']; ?> por <?php echo NombreCliente($d['cliente_id']); ?>" style="<?php echo $h['style']; ?>background: #2b2b2b;width: auto;padding: 28px 12px 37px 5px;line-height: 45px;">INFO</a>
	  <?php } ?>
	<?php } ?>
<?php } ?>
<?php } ?>

	
	<?php } ?>
  <?php } ?>
</div>
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
<?php } ?>
	    </div>
	  </div>
    </div>
  </div>
	
	</main>
  
	<?php require 'templates/footer.php'; ?>