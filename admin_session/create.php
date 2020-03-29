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

	$error = false;

	if($_POST){
		$category = $_POST['category'];

		if($category == "small"){
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
				$sql = "INSERT INTO small (image, name, location, description, website) VALUES ('$image', '$name', '$location', '$description', '$website')";
				if($connect->query($sql) === TRUE){
					$success = 'Created successfully!' ;
				} else{
					$insertError = 'Error ' . $sql . ' ' . $connect->connect_error;
				}
			}
		} elseif($category == "large"){
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
				$hobbies = "Please enter hobbies.";
			}

			if(!$error){
				$sql = "INSERT INTO large (image, name, location, description, hobbies) VALUES ('$image', '$name', '$location', '$description', '$hobbies')";
				if($connect->query($sql) === TRUE){
					$success = 'Created successfully!' ;
				} else{
					$insertError = 'Error ' . $sql . ' ' . $connect->connect_error;
				}
			}
		} elseif($category == "senior"){
			$name = $_POST['name'];
			$image = $_POST['image'];
			$location = $_POST['location'];
			$description = $_POST['description'];
			$hobbies = $_POST['hobbies'];
			$age = $_POST['age'];
			$availability_date = $_POST['availability_date'];

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
				$hobbies = "Please enter hobbies.";
			}
			if ($age == '') {
				$error = true;
				$ageError = "Please enter an age.";
			}
			if ($availability_date == '') {
				$error = true;
				$availabilityError = "Please enter an availability date.";
			}

			if(!$error){
				$sql = "INSERT INTO senior (image, name, location, description, age, hobbies, availability_date) VALUES ('$image', '$name', '$location', '$description', 'age', $hobbies', $availability_date)";
				if($connect->query($sql) === TRUE){
					$success = 'Created successfully!' ;
				} else{
					$insertError = 'Error ' . $sql . ' ' . $connect->connect_error;
				}
			}
		}

		$connect->close();
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
			$('#hobbiesDiv').hide();
			$('#ageDiv').hide();
			$('#availabilityDiv').hide();

			$('#myDropDown').change(function(){
				let inputValue = $(this).val();

				if(inputValue == "small"){
					$('#websiteDiv').show();
					$('#hobbiesDiv').hide();
					$('#ageDiv').hide();
					$('#availabilityDiv').hide();
				} else if(inputValue == "large"){
					$('#websiteDiv').hide();
					$('#hobbiesDiv').show();
					$('#ageDiv').hide();
					$('#availabilityDiv').hide();
				} else if(inputValue == "senior"){
					$('#websiteDiv').hide();
					$('#hobbiesDiv').show();
					$('#ageDiv').show();
					$('#availabilityDiv').show();
				}
			});
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
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<div class="form-group">
								<label for="myDropDown">Category</label>
								<select name="category" class="form-control" id="myDropDown">
									<option value="small" selected>Small</option>
									<option value="large">Large</option>
									<option value="senior">Senior</option>
								</select>
								<span class="text-danger"><?php echo $categoryError; ?></span>
							</div>
							<div class="form-group">
								<label for="newName">Name</label>
								<input type="text" name="name" class="form-control" id="newName">
								<span class="text-danger"><?php echo $nameError; ?></span>
							</div>
							<div class="form-group">
								<label for="newImage">Image</label>
								<input type="text" name="image" class="form-control" id="newImage">
								<span class="text-danger"><?php echo $imageError; ?></span>
							</div>
							<div class="form-group">
								<label for="newLocation">Location</label>
								<input type="text" name="location" class="form-control" id="newLocation">
								<span class="text-danger"><?php echo $locationError; ?></span>
							</div>
							<div class="form-group">
								<label for="newDescription">Description</label>
								<input type="text" name="description" class="form-control" id="newDescription">
								<span class="text-danger"><?php echo $descriptionError; ?></span>
							</div>
							<div class="form-group" id="websiteDiv">
								<label for="newWebsite">Website</label>
								<input type="text" name="website" class="form-control" id="newWebsite">
								<span class="text-danger"><?php echo $websiteError; ?></span>
							</div>
							<div class="form-group" id="hobbiesDiv">
								<label for="newHobbies">Hobbies</label>
								<input type="text" name="hobbies" class="form-control" id="newHobbies">
								<span class="text-danger"><?php echo $hobbiesError; ?></span>
							</div>
							<div class="form-group" id="ageDiv">
								<label for="newAge">Age</label>
								<input type="text" name="age" class="form-control" id="newAge">
								<span class="text-danger"><?php echo $ageError; ?></span>
							</div>
							<div class="form-group" id="availabilityDiv">
								<label for="newAvailability">Availability Date</label>
								<input type="date" name="availability_date" class="form-control" id="newAvailability">
								<span class="text-danger"><?php echo $availabilityError;?></span>
							</div>
							<button type="submit" class="btn btn-success">Create</button>
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