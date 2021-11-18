<?php
require '../config/config.php';
// If the user is logged in, we want to redirect the user out of this page (aka kick them out). If they are logged in, they don't see the log in page

if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
	// Check if this page has username and password passed to it via POST (aka user is trying to login)
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		// Validation - make sure user has entered username AND password
		if ( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter username and password.";

		}
		else {
			// Everything looks good, let's connect to the database to see if user entered the correct credentials (username/password)
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}
			// Hash the user's password input and compared this hashed version to the hashed version in the database
			$passwordInput = hash("sha256", $_POST["password"]);

			$sql = "SELECT * FROM users
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

			echo "<hr>" . $sql . "<hr>";
			
			$results = $mysqli->query($sql);
			if(!$results) {
				echo $mysqli->error;
				exit();
			}
			// If we get a result back, means username/pw was correct
			if($results->num_rows > 0) {
				// Let's "log them in" by creating a session variable and setting their info here
				//echo "logged in!";
				$_SESSION["logged_in"] = true;
				$_SESSION["username"] = $_POST["username"];

				// If the  have logged in, redirect them to the home page
				header("Location: ../song-db/index.php");
			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
}
else {
	// Will get to this code if you are logged in
	// Redirect them to the home page
	header("Location: ../song-db/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Song Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<?php include '../song-db/nav.php'; ?>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Login</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<form action="login.php" method="POST">

			<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9 ml-sm-auto">
					<!-- Show errors here. -->
					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div> <!-- .row -->
			

			<div class="form-group row">
				<label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="username-id" name="username">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="password-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="password-id" name="password">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Login</button>
					<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Cancel</a>
				</div>
			</div> <!-- .form-group -->
		</form>

		<div class="row">
			<div class="col-sm-9 ml-sm-auto">
				<a href="register_form.php">Create an account</a>
			</div>
		</div> <!-- .row -->

	</div> <!-- .container -->
</body>
</html>