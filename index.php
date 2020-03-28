<?php
	ob_start();

	require_once 'db_connect.php';

	// start a new session or continue the previous
	session_start();

	// it will never let you open index (login) page if session is set
	if(isset($_SESSION['user'])!=""){
		// redirect
		header("Location: user_session/home.php");
		// terminate the current script
		exit;
	} elseif(isset($_SESSION['admin'])!=""){
		// redirect
		header("Location: admin_session/admin_panel.php");
		// terminate the current script
		exit;
	}

	$error = false;

	if(isset($_POST['btn-login'])){

		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST[ 'pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		// email validation
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$error = true;
			$emailError = "Please enter a valid email address.";
		}

		// password validation
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		} elseif(strlen($pass) < 6){
			$error = true;
			$passError = "The password must be at least 6 characters long.";
		}

		// if there's no error, continue to login
		if(!$error){
			// password hashing
			$password = hash('sha256', $pass);

			$res=mysqli_query($connect, "SELECT * FROM `user` WHERE email='$email'" );
			$row=mysqli_fetch_array($res, MYSQLI_ASSOC);

			if($res->num_rows == 1 && $row['password'] == $password){
				if($row['status'] == 'admin'){
					$_SESSION['admin'] = $row['id'];
					header("Location: admin_session/admin_panel.php");
				} else{
					$_SESSION['user'] = $row['id'];
					header("Location: user_session/home.php");
				}
			} else{
				$errMSG = "Incorrect Credentials, Try again..." ;
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login & Registration</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
		<h2>Sign In.</h2>
		<hr />

		<?php
			if(isset($errMSG)){
				echo  $errMSG; 
			}
		?>

		<input  type="email" name="email"  class="form-control" placeholder= "Your Email" value="<?php echo $email; ?>"  maxlength="40" />
		<span class="text-danger"><?php  echo $emailError; ?></span >
		<input  type="password" name="pass"  class="form-control" placeholder ="Your Password" maxlength="15"  />
		<span  class="text-danger"><?php  echo $passError; ?></span>
		<hr />
		<button  type="submit" name= "btn-login">Sign In</button>
		<hr />
		<a  href="register.php">Sign Up Here...</a>
   </form>
</body>
</html>

<?php ob_end_flush(); ?>