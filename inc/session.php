<?php
	if (isset($_SESSION['id'])) {
		
	} else {
		header("Location: ". $site ."/login.php");
	}
?>