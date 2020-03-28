<?php
	ob_start();
	require_once '../db_connect.php';
	session_start();

	if(!isset($_SESSION['admin'])){
		if(isset($_SESSION['user']) != "") {
			header("Location: ../user_session/home.php");
		} else{
			header("Location: ../index.php");
		}
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
		<a class="navbar-brand text-white" href="#">Adopt A Pet</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link text-white" href="#">View</a>
				<a class="nav-item nav-link text-white" href="a_small.php">Create</a>
				<a class="nav-item nav-link text-white" href="../logout.php?logout">Logout</a>
			</div>
		</div>
	</nav>

	<?php  
		echo "
			<main>
				<div class='container'>
					<div class='py-4'>
		";

		$tables = array("small", "large", "senior");

		for($i = 0; $i < 3; $i++){
			$sql = "SELECT * FROM " . $tables[$i];
			$res = $connect->query($sql);
			if($res->num_rows > 0){
				while($row = $res->fetch_assoc()){
					$differentParams = "";
					if($tables[$i] == "small"){
						$differentParams = "
							<a href='" . $row['website'] . "' target='_blank'>
								<p>" . $row['website'] . "</p>
							</a>
						";
					} elseif($tables[$i] == "large"){
						$differentParams = "
							<p>Hobbies: " . $row['hobbies'] . "</p>
						";
					} elseif($tables[$i] == "senior"){
						$differentParams = "
							<p>Age: " . $row['age'] . " years old</p>
							<p>Hobbies: " . $row['hobbies'] . "</p>
							<p>Available from: " . $row['availability_date'] . "</p>
						";
					}

					echo "
						<div class='py-4'>
							<div class='row'>
								<div class='col-6 imageDiv'>
									<img src='" . $row['image'] . "' 
										alt='" . $row['name'] . "' class='image'>
								</div>

								<div class='col-6'>
									<p>Category: " . $tables[$i] . "</p>
									<p>Name: " . $row['name'] . "</p>
									<p>Location: " . $row['location'] . "</p>
									<p>Description: " . $row['description'] . "</p>
									" . $differentParams . "
									<br>

									<form action='update.php' method='post' class='d-inline mr-2'>
										<input type='hidden' name='table' 
											value='" . $tables[$i] . "'>

										<input type='hidden' name='id' 
											value='" . $row['id'] . "'>

										<button type='submit' class='btn btn-secondary'>Update</button>
									</form>

									<form action='delete.php' method='post' class='d-inline'>
										<input type='hidden' name='table' 
											value='" . $tables[$i] . "'>

										<input type='hidden' name='id' 
											value='" . $row['id'] . "'>

										<button type='submit' class='btn btn-secondary'>Delete</button>
									</form>
								</div>
							</div>
						</div>
					";
				}
			}
		}

		echo "
					</div>
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