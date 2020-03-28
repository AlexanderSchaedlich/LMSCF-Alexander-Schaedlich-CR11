<?php
  ob_start();

  include_once 'db_connect.php';

  // start a new session or continue the previous
  session_start();

  // it will never let you register if session is set
  if(isset($_SESSION['user'])!=""){
    // redirect
    header("Location: user_session/home.php");
  } elseif(isset($_SESSION['admin'])!=""){
    // redirect
    header("Location: admin_session/admin_panel.php");
  }

  $error = false;

  if(isset($_POST['btn-signup'])){

    // sanitize user input to prevent sql injection:

    // strip whitespace (or other characters) from the beginning and end of a string
    $name = trim($_POST['name']);
    // strip HTML and PHP tags from a string
    $name = strip_tags($name);
    // convert special characters to HTML entities
    $name = htmlspecialchars($name);

    $email = trim($_POST[ 'email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // basic name validation
    if(empty($name)){
      $error = true;
      $nameError = "Please enter your full name.";
    } elseif(strlen($name) < 3){
      $error = true;
      $nameError = "Name must have at least 3 characters.";
    } elseif(!preg_match("/^[a-zA-Z ]+$/",$name)){
      $error = true;
      $nameError = "Name must contain alphabets and space.";
    }

    // basic email validation
    if(empty($email)){
      $error = true;
      $emailError = "Please enter your email adress.";
    } elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $error = true;
      $emailError = "Please enter a valid email address.";
    } else{
      // check whether the email already exists in the database
      $query = "SELECT email FROM `user` WHERE email='$email'";
      $result = mysqli_query($connect, $query);
      if($result->num_rows != 0){
        $error = true;
        $emailError = "Provided email is already in use.";
      }
    }

    // basic password validation
    if (empty($pass)){
    $error = true;
    $passError = "Please enter a password.";
    } elseif(strlen($pass) < 6) {
    $error = true;
    $passError = "Password must have at least 6 characters." ;
    }

    // password hashing for security
    $password = hash('sha256' , $pass);

    // if there's no error, continue to register
    if(!$error){
      $query = "INSERT INTO `user`(name, email, password) 
      VALUES('$name','$email','$password')";
      $res = mysqli_query($connect, $query);

      if($res){
        $errColor = "success";
        $errMSG = "Successfully registered, you may login now";
        unset($name);
        unset($email);
        unset($pass);
      } else{
        $errColor = "danger";
        $errMSG = "Something went wrong, try again later...";
      }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login & Registration</title>
  <link rel="stylesheet"  href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"  crossorigin="anonymous">
</head>
<body>
  <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
    <h2>Sign Up.</h2>
    <hr />

    <?php
      if(isset($errMSG)){
    ?>

    <div  class="alert alert-<?php echo $errColor ?>" >
      <?php echo $errMSG; ?>
    </div>

    <?php
      }
    ?>

    <input type="text" name="name" class="form-control" placeholder="Enter Name"  maxlength="50" value="<?php echo $name ?>" />
    <span class="text-danger"><?php echo $nameError; ?></span>
    <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
    <span class="text-danger"><?php echo $emailError; ?></span>
    <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
    <span class="text-danger"><?php echo $passError; ?></span>
    <hr />
    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
      Sign Up
    </button>
    <hr />
    <a href="index.php">Sign in Here...</a>
  </form>
</body>
</html>

<?php ob_end_flush(); ?>