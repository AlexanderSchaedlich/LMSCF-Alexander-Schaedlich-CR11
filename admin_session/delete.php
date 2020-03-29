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

	$table;
	$id;
	
	if ($_GET['table'] && $_GET['id']) {
		$table = $_GET['table'];
		$id = $_GET['id'];
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
	<script
	src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-primary bg-primary">
		<a class="navbar-brand text-white" href="admin_panel.php">Adopt A Pet</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link text-white" href="admin_panel.php">View</a>
				<a class="nav-item nav-link text-white" href="#">Create</a>
				<a class="nav-item nav-link text-white" href="../logout.php?logout">Logout</a>
			</div>
		</div>
	</nav>

	<header>
		<br>
		<p class="text-center text-warning">Do you really want to delete this media?</p>
		<br>

		<div class="d-flex justify-content-center">
			<div>
				<form action="delete_really.php?table=<?php echo $table; ?>&id=<?php echo $id; ?>" method="post">
					<input type="submit" name="submit" class='btn btn-success' value="Yes, delete it!">
					<a href="admin_panel.php">
						<button type="button" class='btn btn-primary'>No, go back!</button>
					</a>
				</form>
			</div>
		</div>
		<br>
	</header>

	<?php  
		echo "
			<main>
				<div class='container'>
					<div class='py-4'>
		";

		$sql = "SELECT * FROM {$table} WHERE `id` = {$id}";
		$res = $connect->query($sql);
		$row = $res->fetch_assoc();
		$differentParams = "";
		if($table == "small"){
			$differentParams = "
				<a href='" . $row['website'] . "' target='_blank'>
					<p>" . $row['website'] . "</p>
				</a>
			";
		} elseif($table == "large"){
			$differentParams = "
				<p>Hobbies: " . $row['hobbies'] . "</p>
			";
		} elseif($table == "senior"){
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
						<p>Category: " . $table . "</p>
						<p>Name: " . $row['name'] . "</p>
						<p>Location: " . $row['location'] . "</p>
						<p>Description: " . $row['description'] . "</p>
						" . $differentParams . "
						<br>
					</div>
				</div>
			</div>
		";

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

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>