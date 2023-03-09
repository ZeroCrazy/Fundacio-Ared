<?php

	$page = "Usuarios";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
  
?>
<main>
<div class="container">	
<div class="row">	
<br>
<?php

// -----------
//$fecha_hoy = "". $_GET[dia] ."/". $_GET[mes] ."/". $_GET[ano] ."";
//$fecha_salida = "30/11/2017";
//$fecha_entrada = "20/11/2017";
//
//echo "<b>Fecha entrada:</b> " . $fecha_entrada . "<br>";
//echo "<b>Fecha salida:</b> " . $fecha_salida . "<br>";
//echo "<b>Fecha de hoy:</b> " . $fecha_hoy . "<br>";
//echo "<b>Habitación: $v[room] <br></b>";
//if ($fecha_hoy > $fecha_salida) { 
//	echo 'Está libre'; 
//} elseif ($fecha_hoy < $fecha_entrada) {
//	echo 'Aún no ha llegado la fecha';
//} else {
//	echo 'Habitación ocupada';
//}
// -----------

?>
<?php
//$fecha_salida = new DateTime("". $d[dia_salida] ."-". $d[mes_salida] ."-". $d[ano_salida] ."");
//$fecha_entrada = new DateTime("". $d[dia_entrada] ."-". $d[mes_entrada] ."-". $d[ano_entrada] ."");
//$fecha_hoy = new DateTime("". $_GET[dia] ."-". $_GET[mes] ."-". $_GET[ano] ."");
?>
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
<a class="waves-effect waves-light btn-large modal-trigger" href="javascript:window.history.back();" style="width: 100%;">Buscar otra fecha</a>
<div style="background: url(assets/images/grafico.png);width: 1565px;height: 997px;position: absolute;margin-top: -77px;">
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
</main>
<?php require 'templates/footer.php'; ?>
<?php require 'templates/footer.php'; ?>