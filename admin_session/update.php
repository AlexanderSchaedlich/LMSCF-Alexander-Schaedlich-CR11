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
	$currentName;
	$currentImage;
	$currentLocation;
	$currentDescription;
	$currentWebsite;
	$currentHobbies;
	$currentAge;
	$currentAvailability;

	$error = false;
	$nameError = '';
	$imageError = '';
	$locationError = '';
	$descriptionError = '';
	$websiteError = '';
	$hobbiesError = '';
	$ageError = '';
	$availabilityError = '';
	$success = '';
	$updateError = '';

	if ($_GET['table'] && $_GET['id']) {
		$table = $_GET['table'];
		$id = $_GET['id'];
	}

	if($table == "small"){
		$sql = "SELECT * FROM small WHERE `id` = {$id}" ;
		$result = $connect->query($sql);
		$row = $result->fetch_assoc();

		$currentName = $row['name'];
		$currentImage = $row['image'];
		$currentLocation = $row['location'];
		$currentDescription = $row['description'];
		$currentWebsite = $row['website'];
	} elseif($table == "large"){
		$sql = "SELECT * FROM large WHERE `id` = {$id}" ;
		$result = $connect->query($sql);
		$row = $result->fetch_assoc();

		$currentName = $row['name'];
		$currentImage = $row['image'];
		$currentLocation = $row['location'];
		$currentDescription = $row['description'];
		$currentHobbies = $row['hobbies'];
	} elseif($table == "senior"){
		$sql = "SELECT * FROM senior WHERE `id` = {$id}" ;
		$result = $connect->query($sql);
		$row = $result->fetch_assoc();

		$currentName = $row['name'];
		$currentImage = $row['image'];
		$currentLocation = $row['location'];
		$currentDescription = $row['description'];
		$currentHobbies = $row['hobbies'];
		$currentAge = $row['age'];
		$currentAvailability = $row['availability_date'];
	}

	if($_POST) {
		if ($_GET['table'] && $_GET['id']) {
			$table = $_GET['table'];
			$id = $_GET['id'];
		}

		if($table == "small"){
			$name = $_POST['name'];
			$image = $_POST['image'];
			$location = $_POST['location'];
			$description = $_POST['description'];
			$website = $_POST['website'];

			// input validation
			if ($name == '') {
				$error = true;
				$nameError = "Please enter a name.";
			}
			if ($image == '') {
				$error = true;
				$imageError = "Please enter an image.";
			}
			if ($location == '') {
				$error = true;
				$locationError = "Please enter an location.";
			}
			if ($description == '') {
				$error = true;
				$descriptionError = "Please enter a description.";
			}
			if ($website == '') {
				$error = true;
				$websiteError = "Please enter a website.";
			}

			if(!$error){
				$sql = "update small set name = '$name', image = '$image', location = '$location', description = '$description', website = '$website' where `id` = {$id}";

				if($connect->query($sql) === TRUE) {
					$success = 'Updated successfully!' ;
				} else {
					$updateError = 'Error ' . $sql . ' ' . $connect->connect_error;
				}
			}

			$connect->close();
		} 
	}

	if($_POST){
		if ($_GET['table'] && $_GET['id']) {
			$table = $_GET['table'];
			$id = $_GET['id'];
		}

		if($table == "large"){
			$name = $_POST['name'];
			$image = $_POST['image'];
			$location = $_POST['location'];
			$description = $_POST['description'];
			$hobbies = $_POST['hobbies'];

			// input validation
			if ($name == '') {
				$error = true;
				$nameError = "Please enter a name.";
			}
			if ($image == '') {
				$error = true;
				$imageError = "Please enter an image.";
			}
			if ($location == '') {
				$error = true;
				$locationError = "Please enter an location.";
			}
			if ($description == '') {
				$error = true;
				$descriptionError = "Please enter a description.";
			}
			if ($hobbies == '') {
				$error = true;
				$hobbiesError = "Please enter hobbies.";
			}

			if(!$error){
				$sql = "update large set name = '$name', image = '$image', location = '$location', description = '$description', hobbies = '$hobbies' where `id` = {$id}";

				if($connect->query($sql) === TRUE) {
					$success = 'Updated successfully!' ;
				} else {
					$updateError = 'Error ' . $sql . ' ' . $connect->connect_error;
				}
			}

			$connect->close();
		}
	}
		
	if($_POST){
		if ($_GET['table'] && $_GET['id']) {
			$table = $_GET['table'];
			$id = $_GET['id'];
		}

		if($table == "senior"){
			$name = $_POST['name'];
			$image = $_POST['image'];
			$location = $_POST['location'];
			$description = $_POST['description'];
			$hobbies = $_POST['hobbies'];
			$age = $_POST['age'];
			$availability = $_POST['availability'];

			// input validation
			if ($name == '') {
				$error = true;
				$nameError = "Please enter a name.";
			}
			if ($image == '') {
				$error = true;
				$imageError = "Please enter an image.";
			}
			if ($location == '') {
				$error = true;
				$locationError = "Please enter an location.";
			}
			if ($description == '') {
				$error = true;
				$descriptionError = "Please enter a description.";
			}
			if ($hobbies == '') {
				$error = true;
				$hobbiesError = "Please enter hobbies.";
			}
			if ($age == '') {
				$error = true;
				$ageError = "Please enter an age.";
			}
			if ($availability == '') {
				$error = true;
				$availabilityError = "Please enter an availability date.";
			}

			if(!$error){
				$sql = "update senior set name = '$name', image = '$image', location = '$location', description = '$description', hobbies = '$hobbies', age = '$age'availability = '$availability_date' where `id` = {$id}";

				if($connect->query($sql) === TRUE) {
					$success = 'Updated successfully!' ;
				} else {
					$updateError = 'Error ' . $sql . ' ' . $connect->connect_error;
				}
			}

			$connect->close();
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
	<script
	src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
	<script>
		$(document).ready(function(){
			let tableName = $('#table').val();

			if(tableName == "small"){
				$('#hobbiesDiv').hide();
				$('#ageDiv').hide();
				$('#availabilityDiv').hide();
			} else if(tableName == "large"){
				$('#websiteDiv').hide();
				$('#ageDiv').hide();
				$('#availabilityDiv').hide();
			} else if(tableName == "senior"){
				$('#websiteDiv').hide();
			}
		});
	</script>
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
		<p class="text-center text-success"><?php echo $success; ?></p>
		<p class="text-center text-success"><?php echo $insertError; ?></p>
		<br>
	</header>

	<main>
		<div class="container">
			<div class="row">
				<div class="col-sm-0 col-md-3 col-lg-3"></div>

				<div class="col-sm-12 col-md-6 col-lg-6">
					<div class="p-3 bg-dark text-white text-center rounded-lg">
						<form action="update.php?table=<?php echo $table; ?>&id=<?php echo $id; ?>" method="post">
							<input type="hidden" value="<?php echo $table; ?>" id="table">
							<div class="form-group">
								<label for="newName">Name</label>
								<input type="text" name="name" value="<?php echo $currentName; ?>" class="form-control" id="newName">
								<span class="text-danger"><?php echo $nameError; ?></span>
							</div>
							<div class="form-group">
								<label for="newImage">Image</label>
								<input type="text" name="image" value="<?php echo $currentImage; ?>" class="form-control" id="newImage">
								<span class="text-danger"><?php echo $imageError; ?></span>
							</div>
							<div class="form-group">
								<label for="newLocation">Location</label>
								<input type="text" name="location" value="<?php echo $currentLocation; ?>" class="form-control" id="newLocation">
								<span class="text-danger"><?php echo $locationError; ?></span>
							</div>
							<div class="form-group">
								<label for="newDescription">Description</label>
								<input type="text" name="description" value="<?php echo $currentDescription; ?>" class="form-control" id="newDescription">
								<span class="text-danger"><?php echo $descriptionError; ?></span>
							</div>
							<div class="form-group" id="websiteDiv">
								<label for="newWebsite">Website</label>
								<input type="text" name="website" value="<?php echo $currentWebsite; ?>" class="form-control" id="newWebsite">
								<span class="text-danger"><?php echo $websiteError; ?></span>
							</div>
							<div class="form-group" id="hobbiesDiv">
								<label for="newHobbies">Hobbies</label>
								<input type="text" name="hobbies" value="<?php echo $currentHobbies; ?>" class="form-control" id="newHobbies">
								<span class="text-danger"><?php echo $hobbiesError; ?></span>
							</div>
							<div class="form-group" id="ageDiv">
								<label for="newAge">Age</label>
								<input type="text" name="age" value="<?php echo $currentAge; ?>" class="form-control" id="newAge">
								<span class="text-danger"><?php echo $ageError; ?></span>
							</div>
							<div class="form-group" id="availabilityDiv">
								<label for="newAvailability">Availability Date</label>
								<input type="date" name="availability" value="<?php echo $currentAvailability; ?>" class="form-control" id="newAvailability">
								<span class="text-danger"><?php echo $availabilityError;?></span>
							</div>
							<button type="submit" class="btn btn-success">Update</button>
							<a href="admin_panel.php" class="btn btn-primary">Back</a>
						</form>
					</div>
				</div>

				<div class="col-sm-0 col-md-3 col-lg-3"></div>
			</div>
		</div>
		<br><br><br>
	</main>

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