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
				<a class="nav-item nav-link text-white" href="#">Home</a>
				<a class="nav-item nav-link text-white" href="general.php">General</a>
				<a class="nav-item nav-link text-white" href="seniors.php">Seniors</a>
				<a class="nav-item nav-link text-white" href="../logout.php?logout">Logout</a>
			</div>
		</div>
	</nav>

	<?php  
		echo "
			<main>
				<div class='row' style='padding: 15px 30px;'>
		";

		$tables = array("small", "large", "senior");

		for($i = 0; $i < 3; $i++){
			$sql = "SELECT * FROM " . $tables[$i];
			$res = $connect->query($sql);
			if($res->num_rows > 0){
				while($row = $res->fetch_assoc()){
					echo "
						<div class='col-sm-12 col-md-6 col-lg-4' style='padding: 15px;'>
							<form action='pet_details.php' method='post'>

								<input type='hidden' name='table' 
									value='" . $tables[$i] . "'>

								<input type='hidden' name='id' 
									value='" . $row['id'] . "'>

								<button type='submit' style='border: none; padding: 0;'>
									<div class='d-flex flex-column'>
										<div class='smallImageDiv'>
											<img src='" . $row['image'] . "' 
												alt='" . $row['name'] . "' 
												class='smallImage'>
										</div>

										<div class='bg-info text-white smallTextDiv'>
											<div class='d-flex flex-column justify-content-around h-100' style='padding: 15px 30px;'>

												<div>
													<p class='mb-0'>" . $row['name'] . "</p>
												</div>

												<div>
													<p class='mb-0'>" . $row['location'] . "</p>
												</div>
											</div>
										</div>
									</div>
								</button>
							</form>
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