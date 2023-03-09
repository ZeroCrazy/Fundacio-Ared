<?php
# Conexión al MySQL
$host = ""; // HOST DÓNDE TE CONECTAS
$user = ""; // USUARIOS DEL HOST
$password = ""; // CONTRASEÑA DEL HOST
$database = ""; // BASE DE DATOS DEL HOST
$conexion = mysql_connect (''. $host .'', ''. $user .'', ''. $password .'');
mysql_select_db (''. $database .'');
?>
