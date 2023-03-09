<?php

	$page = "Usuarios";
	
	
	require 'inc/core.php';
	require 'inc/session.php';
	require 'templates/header.php';
	
	if($user['rank'] == ''. $rango_administrador .'') {} else { header("Location: $site"); }
	
  if (isset($_POST['AddNewAdministrator'])) {
  $username = Filter($_POST['username']);
  $rank = Filter($_POST['rank']);
  $password = Filter($_POST['password']);
  mysql_query("INSERT INTO admins (username,rank,password) VALUES ('$username','$rank','$password')");
  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha creado un nuevo administrador','". time() ."')");
  header("Location: $site/$_SERVER[PHP_SELF]#admin_ok");
  }  
  
?>
	<main>
	<div class="container">	
	  <div class="row">	
<?php if($_GET['edit'] == "$_GET[edit]") $c2_sql = mysql_query("SELECT * FROM admins WHERE id='". $_GET[edit] ."'"); while($c2 = mysql_fetch_assoc($c2_sql)) { ?>
<?php
if (isset($_POST['borrarCliente_'. $c2[id] .''])) {
  mysql_query("DELETE FROM admins WHERE id='". $c2[id] ."'");
  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Se ha eliminado un administrador ($c2[username])','". time() ."')");
  $mensaje = '<script>sweetAlert("Perfecto!", "Se ha eliminado a '. $c2[nombre]. ' correctamente", "success");</script>';
  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/$_SERVER[PHP_SELF]#admin_ok'>";
	}
?>
				<div class="col s12 m12">
				 <div style="background: #fff;" class="card black-text">
				 <div class="card-content black-text">
				   <span class="card-title">Ficha <x style="text-transform: lowercase;"><?php echo RankName($c2['rank']); ?>a</x> de <?php echo $c2['username']; ?></span>
					  <div class="row">
					  <?php
  if (isset($_POST['SaveUser'])) {
  $username = Filter($_POST['username']);
  $rank = Filter($_POST['rank']);
  $password = Filter($_POST['password']);
  mysql_query("UPDATE admins SET username='$username', rank='$rank', password='$password' WHERE id='$c2[id]'");
  mysql_query("INSERT INTO historial (user_id,page,action,date) VALUES ('$user[id]','$page','Ha editado un administrador ($c2[username])','". time() ."')");
  $mensaje = '<script>sweetAlert("Perfecto!", "Actualizado satisfactoriamente", "success");</script>';
  echo "<META HTTP-EQUIV='Refresh' CONTENT='2; URL=$site/$_SERVER[PHP_SELF]#admin_ok'>";
  }  
					  ?>
<?php echo $mensaje; ?>
						<form method="POST" class="col s12 m12">
						  <div class="row">
							<div class="input-field col s12 m12">
							  <b>INFORMACIÓN PRINCIPAL</b><br><br>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="text" name="username" value="<?php echo $c2['username']; ?>" class="validate">
							  <label for="icon_prefix">Usuario</label>
							</div>
							<div class="input-field col s12 m4">
							<input disabled value="<?php echo RankName($c2['rank']); ?>" id="disabled" type="text" class="validate">
							<label for="disabled">Rol de usuario</label>
							</div>
							<div class="input-field col s12 m4">
							<input disabled value="<?php echo $c2['so']; ?>" id="disabled" type="text" class="validate">
							<label for="disabled">Sistema Operativo</label>
							</div>
							<div class="input-field col s12 m12">
							  <b>INFORMACIÓN PRIVADA</b><br><br>
							</div>
							<div class="input-field col s12 m4">
							  <input id="icon_prefix" type="password" name="password" value="<?php echo $c2['password']; ?>" class="validate">
							  <label for="icon_prefix">Contraseña</label>
							</div>
							<div class="input-field col s12 m4">
							<a style="margin-top: -17px;margin-left: 71px;position: absolute;" href="https://www.elhacker.net/geolocalizacion.html?host=<?php echo $c2['ip']; ?>" target="_blank">(ver localización)</a>
							<input disabled value="<?php echo $c2['ip']; ?>" id="disabled" type="text" class="validate">
							<label for="disabled">Dirección IP</label>
							</div>
							<div class="input-field col s12 m4">
							<select name="rank">
								<?php if($c2['rank'] == '3') { ?>
								<option value="3">Habilitado</option>
								<option value="2">Deshabilitar</option>
								<?php } else { ?>
								<option value="2">Deshabilitado</option>
								<option value="3">Habilitar</option>
								<?php } ?>
							  </optgroup>
							</select>
							<label>Permisos especiales</label>
							</div>
							<div class="input-field col s12 m12">
							<button type="submit" name="SaveUser" style="width: 100%;background: #<?php echo $colordelservidor; ?>;" class="waves-effect waves-light btn-large white-text">Guardar cambios</button>
							<button type="submit" name="borrarCliente_<?php echo $c2['id']; ?>" style="margin-top: 10px;width: 100%;" class="waves-effect waves-light btn-large white-text #b71c1c red darken-4">Borrar <?php echo RankName($c2['rank']); ?></button>
							</div>
						  </div>
						</form>
					  </div>
				 </div>
				 </div>
				 </div>
				 
				 <div class="col s12 m12">
				 <div style="background: #fff;" class="card black-text">
				 <div class="card-content black-text">
				   <span class="card-title">Historial de <?php echo $c2['username']; ?></span>
				   <table>
				    <thead>
					  <td>#</td>
					  <td>Página</td>
					  <td>Acción</td>
					  <td>Fecha</td>
					</thead>
					<tbody>
					  <?php $h_sql = mysql_query("SELECT * FROM historial WHERE user_id='$_GET[edit]' ORDER BY id DESC LIMIT 50"); while($h = mysql_fetch_assoc($h_sql)){ ?>
					  <tr>
						<td><?php echo $h['id']; ?></td>
						<td><?php echo $h['page']; ?></td>
						<td><?php echo $h['action']; ?></td>
						<td><?php echo date("d/m/Y", $h['date']); ?></td>
					  </tr>
					  <?php } ?>
					</tbody>
				   </table>
				 </div>
				 </div>
				 </div>
	<?php } ?>
	  
  <div class="fixed-action-btn click-to-toggle">
    <a href="#RegisterNewUser" class="btn-floating btn-large #e65100 modal-trigger">
      <i class="material-icons">add</i>
    </a>
    <ul>
    </ul>
  </div>
	  
		<div class="col s12 m12">
		  <div class="card" style="background: transparent;box-shadow: none;text-align: center;">
            <div class="card-content grey-text">
			  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Introduce la búsqueda ..">
              
			  <ul id="myUL">
			  	<?php $c_sql = mysql_query("SELECT * FROM admins ORDER BY id"); while($c = mysql_fetch_assoc($c_sql)){ ?>
			    <li class="responsive-table centered card card-content" style="padding: 1px;border-radius: 200px;border: 3px solid #e65100;">
			      <a href="?edit=<?php echo $c['id']; ?>"><?php echo $c['username']; ?></a>
			    </li>
			  	<?php } if(mysql_num_rows($c_sql) == 0) { ?>
				<div class="col s12 m12" style="margin-top: 40px;">
				  <div class="card #b71c1c red darken-4">
					<div class="card-content white-text">
					  <span class="card-title center">No hay administradores</span>
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
	
	<div id="RegisterNewUser" class="modal modal-fixed-footer" style="max-height: 100% !important;">
    <div class="modal-content">
      <h4>Usuario &#187; Nuevo usuario</h4>
		<form method="POST" class="col s12 m12">
		  <div class="row">
			<div class="input-field col s12 m4">
			  <input id="icon_prefix" type="text" name="username" class="validate">
			  <label for="icon_prefix">Usuario</label>
			</div>
			<div class="input-field col s12 m4">
			<select name="rank">
			  <option value="" disabled selected>Seleccionar rol</option>
			  <optgroup label="Tipos de rol">
			  <option value="2">Administrador</option>
			  <option value="1">Moderador</option>
			  </optgroup>
			</select>
			<label>Rol del usuario</label>
			</div>
			<div class="input-field col s12 m4">
			  <input id="icon_prefix" type="password" name="password" class="validate">
			  <label for="icon_prefix">Contraseña</label>
			</div>
			<div class="input-field col s12 m12">
			<button type="submit" name="AddNewAdministrator" style="width: 100%;background: #<?php echo $colordelservidor; ?>;" class="waves-effect waves-light btn-large white-text">Guardar cambios</button>
			</div>
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
	<?php require 'templates/footer.php'; ?>