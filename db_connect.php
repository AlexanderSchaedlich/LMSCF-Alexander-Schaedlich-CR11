<?php  
	$connect = new mysqli("localhost", "root", "", "cr11_alexander_petadoption");

	if($connect->connect_error){
		echo "Connection failed: " . $connect->connect_error;
	}

	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
?>