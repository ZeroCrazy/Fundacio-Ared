<?php

	$page = "Habitaciones";
	
	
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
  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/room.php#ok'>";
  }  
  
  
  if (isset($_POST['RegisterNewRoom'])) {
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
  }else{
  if(empty($payment)) {
	$mensaje = '<script>sweetAlert("Oops...", "No has seleccionado método de pago", "error");</script>';
	$Falloxd = true;
  }}}}}}}}}
  if($Falloxd == false) {
  mysql_query("INSERT INTO alquiler (room,category,dia_entrada,mes_entrada,ano_entrada,dia_salida,mes_salida,ano_salida,cliente_id,num_personas,desayuno,cena,payment,price_cena,price_desayuno,price_persona,total_a_pagar,date) VALUES 
  ('$_GET[alquilar]','$_GET[category]','$dia_entrada','$mes_entrada','$ano_entrada','$dia_salida','$mes_salida','$ano_salida','$cliente_id','$num_personas','$desayuno','$cena','$payment','$precio_cena','$precio_desayuno','$precio_rooms','$total_a_pagar','". time() ."')");
  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha añadido un alquiler (Hab: $_GET[alquilar]-$_GET[category])','". time() ."')");
  $mensaje = '<script>sweetAlert("Perfecto!", "Habitación alquilada satisfactoriamente", "success");</script>';
  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/room.php#ok'>";
  }
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
        <div class="col s12 m6">
		<a class="waves-effect waves-light btn-large modal-trigger" href="#RegisterNewUser" style="width: 100%;">Crear nuevo cliente</a>
		</div>
		<div class="col s12 m6">
		<a class="waves-effect waves-light btn-large modal-trigger" href="#ConsultRooms" style="width: 100%;">Habitaciones disponibles</a>
		</div>
		<div class="col s12 m12">
          <div class="card white darken-1">
            <div class="card-content black-text">
			<form method="POST">
              <span class="card-title">Hola <?php echo $user['username']; ?> &#187; Alquilar habitación</span>
              <div class="row">
				<div class="input-field col s12 m12">
				  <select name="cliente_id" required>
					<option value="" disabled selected>Seleccionar cliente</option>
					<?php $cx_sql = mysql_query("SELECT * FROM clientes ORDER BY id DESC"); while($c = mysql_fetch_assoc($cx_sql)){ ?>
					 <option value="<?php echo $c['id']; ?>"><?php echo $c['nombre']; ?> <?php echo $c['apellidos']; ?></option>
					<?php } ?>
				  </select>
				</div>
				<div class="input-field col s12 m6">
				<b>ENTRADA</b><br>
				  <div class="input-field col s12 m4">
					<select name="dia_entrada" required>
					  <?php if($_GET['dia'] == '') { ?><option value="" disabled selected>Día</option><?php } else { ?><option value="<?php echo $_GET['dia']; ?>" selected><?php echo $_GET['dia']; ?></option><?php } ?>
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
					<select name="mes_entrada" required>
					  <?php if($_GET['mes'] == '') { ?><option value="" disabled selected>Mes</option><?php } else { ?><option value="<?php echo $_GET['mes']; ?>" selected><?php echo getMonthPerDay($_GET['mes']); ?></option><?php } ?>
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
					<select name="ano_entrada" required>
					  <?php if($_GET['ano'] == '') { ?><option value="" disabled selected>Año</option><?php } else { ?><option value="<?php echo $_GET['ano']; ?>" selected><?php echo $_GET['ano']; ?></option><?php } ?>
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
					<select name="dia_salida" required>
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
					<select name="mes_salida" required>
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
					<select name="ano_salida" required>
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
				</div>
				<div class="input-field col s12 m6">
				  <b>Nº Personas</b>
				  <p class="range-field">
				    <input type="range" name="num_personas" id="personas" min="1" max="2" required>
				  </p>
				</div>
				<div class="input-field col s12 m6">
				<b>Habitación seleccionada</b><br>
				  <?php if($_GET['alquilar'] == '') { ?>
				  <x style="color: red;">Por favor, selecciona una habitación.</x><br><br><br>
				  <?php } else { ?>
				  <br>
				  <x style="background: <?php echo $_GET['category']; ?>;color: #fff;font-weight: bold;padding: 5px 17px;border: 3px solid #00000040;border-radius: 3px;">Has seleccionado la habitación número <?php echo $_GET['alquilar']; ?></x>
				  <br><br><br>
				  <?php } ?>
				</div>
				<div class="input-field col s12 m4">
				  <select name="payment" required>
					<option value="" disabled selected>Forma de pago</option>
					<option value="efectivo">Efectivo</option>
					<option value="transferencia">Transferencia</option>
				  </select>
				</div>
				<div class="input-field col s12 m4">
				  <select name="desayuno" required>
					<option value="" disabled selected>Desayuno</option>
					<option value="1">Sí</option>
					<option value="0">No</option>
				  </select>
				</div>
				<div class="input-field col s12 m4">
				  <select name="cena" required>
					<option value="" disabled selected>Cena</option>
					<option value="1">Sí</option>
					<option value="0">No</option>
				  </select>
				</div>
				<div class="input-field col s12 m12">
				<button type="submit" name="RegisterNewRoom" class="waves-effect waves-light btn-large modal-trigger" style="width: 100%;">Finalizar</button>
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
</main>

  <!-- ConsultRooms -->
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
<a href="<?php echo $site; ?>/room.php?dia=<?php echo $_GET['dia']; ?>&mes=<?php echo $_GET['mes']; ?>&ano=<?php echo $_GET['ano']; ?>&alquilar=<?php echo $h['name']; ?>&category=<?php echo $h['category']; ?><?php if($h['status'] == "1") { ?>&status=1<?php } ?>">
  <div class="room_<?php echo $h['category']; ?>" style="<?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
</a>
<?php } ?>
<?php } elseif ($fecha_hoy < $fecha_entrada) { // Habitación libre porque está antes de la fecha de entrada ?>
<?php if($h['show'] == '1') { ?>
<a href="<?php echo $site; ?>/room.php?dia=<?php echo $_GET['dia']; ?>&mes=<?php echo $_GET['mes']; ?>&ano=<?php echo $_GET['ano']; ?>&alquilar=<?php echo $h['name']; ?>&category=<?php echo $h['category']; ?><?php if($h['status'] == "1") { ?>&status=1<?php } ?>">
  <div class="room_<?php echo $h['category']; ?>" style="<?php echo $h['style']; ?>"><?php echo $h['name']; ?></div>
</a>
<?php } ?>
<?php } else { // Habitación ocupada ?>
<?php if($h['show'] == '1') { ?>
<a href="<?php echo $site; ?>/room.php?dia=<?php echo $_GET['dia']; ?>&mes=<?php echo $_GET['mes']; ?>&ano=<?php echo $_GET['ano']; ?>&alquilar=<?php echo $h['name']; ?>&category=<?php echo $h['category']; ?><?php if($h['status'] == "1") { ?>&status=1<?php } ?>">
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

  <!-- RegisterNewUser -->
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
  </div>

  <div class="fixed-action-btn click-to-toggle">
    <a class="btn-floating btn-large #e65100 modal-trigger" href="#HelpRoomPage">
      <i class="material-icons">info</i>
    </a>
  </div>
  
  <div id="HelpRoomPage" class="modal">
    <div class="modal-content">
      <h4>Funcionalidad del sistema paso a paso <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a></h4>
		<video width="1000" controls>
		  <source src="<?php echo $site . "/" . $cdn; ?>/videos/HelpRoomPage.mp4" type="video/mp4">
		  Tu explorador no es compatible con el vídeo. Recomendamos a los usuarios que utilizen Google Chrome para mayor compatibilidad.
		</video>
    </div>
  </div>
  
<?php 

	require 'templates/footer.php'; 
	
?>