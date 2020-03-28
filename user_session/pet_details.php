<?php
	ob_start();
	require_once '../db_connect.php';
	session_start();

	if(!isset($_SESSION['user'])){
		if(isset($_SESSION['admin']) != "") {
			header("Location: ../admin_session/admin_panel.php");
		} else{
			header("Location: ../index.php");
		}
	}

	$table;
	$id;

	if($_POST){
		$table = $_POST['table'];
		$id = $_POST['id'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Adopt A Pet</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-primary bg-primary">
		<a class="navbar-brand text-white" href="home.php">Adopt A Pet</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link text-white" href="home.php">Home</a>
				<a class="nav-item nav-link text-white" href="general.php">General</a>
				<a class="nav-item nav-link text-white" href="seniors.php">Seniors</a>
				<a class="nav-item nav-link text-white" href="../logout.php?logout">Logout</a>
			</div>
		</div>
	</nav>

	<?php  
		echo "
			<main>
				<div class='container'>
			
		";
			$sql = "SELECT * FROM " . $table . " WHERE `id` = " . $id;
			$res = $connect->query($sql);
			if($res->num_rows > 0){
				while($row = $res->fetch_assoc()){
					if($table == "small"){
						echo "
							<img src='" . $row['image'] . "' 
								alt='" . $row['name'] . "' 
								class='pt-5 w-100 h-auto'>
							<div class='py-3'>
								<p>" . $row['name'] . "</p>
								<p>" . $row['location'] . "</p>
								<p>" . $row['description'] . "</p>
								<a href='" . $row['website'] . "' target='_blank'>
									<p>" . $row['website'] . "</p>
								</a>
							</div>
						";
					} elseif($table == "large"){
						echo "
							<img src='" . $row['image'] . "' 
								alt='" . $row['name'] . "' 
								class='pt-5 w-100 h-auto'>
							<div class='py-3'>
								<p>" . $row['name'] . "</p>
								<p>" . $row['location'] . "</p>
								<p>" . $row['description'] . "</p>
								<p>Hobbies: " . $row['hobbies'] . "</p>
							</div>
						";
					} elseif($table == "senior"){
						echo "
							<img src='" . $row['image'] . "' 
								alt='" . $row['name'] . "' 
								class='pt-5 w-100 h-auto'>
							<div class='py-3'>
								<p>" . $row['name'] . "</p>
								<p>" . $row['age'] . " years old</p>
								<p>" . $row['location'] . "</p>
								<p>" . $row['description'] . "</p>
								<p>Hobbies: " . $row['hobbies'] . "</p>
								<p>Available from: " . $row['availability_date'] . "</p>
							</div>
						";
					}
				}
			}

		echo "
				</div>
			</main>
		";
	?>

	<footer>
		<div class="text-center bg-primary text-white p-3">
			&copy; Adopt A Pet 2020
		</div>
	</footer>

	<script
	src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>