<?php
	session_start();

	if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
		header("Location: index.php");
	} elseif(isset($_SESSION['user']) != ""){
		header("Location: user_session/home.php");
	} elseif(isset($_SESSION['admin']) != ""){
		header("Location: admin_session/admin_panel.php");
	}

	if(isset($_GET['logout'])){
		unset($_SESSION['user']);
		unset($_SESSION['admin']);
		session_unset();
		session_destroy();
		header("Location: index.php");
		exit;
	}
?>