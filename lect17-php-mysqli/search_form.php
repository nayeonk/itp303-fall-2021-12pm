<?php

// ---- STEP 1: Establish the database connection

// Four pieces of required information
$host = "303.itpwebdev.com";
$user = "nayeon_db_user";
$password = "uscItp2021!";
$db = "nayeon_song_db";

// Create an instance of the mysqli class
// requires four parameters
// Will also attempt to connect to the database with these credentials
$mysqli = new mysqli($host, $user, $password, $db);

// Check if connection was succesful
// connect_errno is a property of the mysqli object. It will return an error code if there is one
if($mysqli->connect_errno) {
	// Let's output the error message
	echo $mysqli->connect_error;
	// Exit the program if there is an error. There is no reason to continue executing the rest of the code if we can't even connect to the database.
	exit();
}

// ---- STEP 2: Generate & Submit SQL query
$sql = "SELECT * FROM genres;";
// Echo out the sql statement to make sure it looks good.
echo "<hr>" . $sql . "<hr>";

// Submit the sql query to the database!
// query() method runs the sql query against the database
// query() returns not the full results but it returns some meta data about the results (like the num_rows) as an object
$results = $mysqli->query($sql);
// If there is an error with querying the DB, $results will return false
if(!$results) {
	// ->error will return the error message
	echo $mysqli->error;
	// terminate the program
	exit();
}


// dump out results to quickly see what it looks like
var_dump($results);

echo "<hr>";
// use -> notation for objects ([] is used for associative array keys)
echo "Num of results: " . $results->num_rows;

// Get the actual results
// We can actually choose how to get results. We will get results as an associative array
// fetch_assoc() only gives us one result at a time. Need to run through a while loop to get ALL results
echo "<hr>";
// var_dump( $results->fetch_assoc() );
// var_dump( $results->fetch_assoc() );
// var_dump( $results->fetch_assoc() );
// var_dump( $results->fetch_assoc() );
// var_dump( $results->fetch_assoc() );
// Loop through all the results
// when we reach the end of results, $results->fetch_assoc() will return FALSE
// while( $row = $results->fetch_assoc() ) {
// 	var_dump($row);
// 	echo "<hr>";
// }

// -- Can run multiple sql queries, use different variable to store SQL statement and the results.

$sql_media_types = "SELECT * FROM media_types;";
$results_media_types = $mysqli->query($sql_media_types);
if(!$results_media_types) {
	echo $mysqli->error;
	exit();
}


// --- STEP 3: Display the results in the appropriate html tags (scroll to below)

// ---- STEP 4: close the db connection
$mysqli->close();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Song Search Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">

		<form action="search_results.php" method="GET">

			<div class="form-group row">
				<label for="name-id" class="col-sm-3 col-form-label text-sm-right">Track Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="name-id" name="track_name">
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
				<div class="col-sm-9">
<select name="genre" id="genre-id" class="form-control">
	<option value="" selected>-- All --</option>
	
	<?php 
	// STEP 3: Display the results
	// We still have access to $results here because $results is a global variable

	// Mixing PHP and HTML gets really confusing, 
	// Use alternate PHP syntax instead

	// while($row = $results->fetch_assoc()) {
	// 	echo "<option value='" . $row['genre_id'] ."'>" . $row["name"] . "</option>";
	// }
	?>

	<?php while($row = $results->fetch_assoc()) : ?>

		<option value="<?php echo $row['genre_id']?>"> 
			<?php echo $row["name"]; ?>
		</option>

	<?php endwhile; ?>

	<!-- <option value='1'>Rock</option>
	<option value='2'>Jazz</option>
	<option value='3'>Metal</option>
	<option value='4'>Alternative & Punk</option>
	<option value='5'>Rock And Roll</option> -->

</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">Media Type:</label>
				<div class="col-sm-9">
<select name="media_type" id="media-type-id" class="form-control">
	<option value="" selected>-- All --</option>
	
	<?php while($row = $results_media_types->fetch_assoc()) : ?>

		<option value="<?php echo $row['media_type_id']?>"> 
			<?php echo $row["name"]; ?>
		</option>

	<?php endwhile; ?>

	<!-- <option value='1'>MPEG audio file</option>
	<option value='2'>Protected AAC audio file</option> -->

</select>
				</div>
			</div> <!-- .form-group -->
			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9 mt-2">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->
		</form>
	</div> <!-- .container -->
</body>
</html>