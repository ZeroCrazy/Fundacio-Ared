<?php

	$page = "Historial";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
	
	if($user['rank'] == ''. $rango_administrador .'') {} else { header("Location: $site"); }
	
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
		<div class="col s12 m12">
		  <div class="card">
			<div class="card-content">
			  <span class="card-title">Historial de movimientos</span>
			  <table>
				<thead>
				  <tr>
					<td>#</td>
					<td>Usuario</td>
					<td>Acción</td>
					<td>Fecha</td>
				  </tr>
				</thead>
				<tbody>
				<?php $hsql = mysql_query("SELECT * FROM historial ORDER BY id DESC LIMIT 90"); while($h = mysql_fetch_assoc($hsql)){ ?>
				  <tr>
					<td><?php echo $h['id']; ?></td>
					<td><?php echo getAdmin($h['user_id']); ?></td>
					<td><?php echo $h['action']; ?></td>
					<td><?php echo date("j/m/Y", $h['date']); ?></td>
				  </tr>
				<?php } ?>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	</main>
  
	<?php require 'templates/footer.php'; ?>