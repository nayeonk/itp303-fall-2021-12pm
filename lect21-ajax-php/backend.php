<?php
	$php_array = [
		"first_name" => "Tommy",
		"last_name" => "Trojan",
		"age" => 21,
		"phone" => [
			"cell" => "123-123-1234",

			"home" => "456-456-4567"
		],
	];

	// Whatever backend.php echoes out, gets sent back to the frontend
	// Remember that you can only echo out STRINGS.
	//echo "Hello World!";
	
	// So you cannot echo out associative arrays. However, PHP loves associative arrays!

	// Fortunately, we can easily convert an associative array into a JSON formatted string
	//echo json_encode($php_array);

	// How backend receives parameters from the frontend via GET
	//echo $_GET["name"];
	//echo $_GET["age"];

	// How backend receives parameters from the frontend via POST
	//echo $_POST["firstName"];
	//echo $_POST["age"];

	$host = "303.itpwebdev.com";
	$user = "nayeon_db_user";
	$pass = "uscItp2021!";
	$db = "nayeon_song_db";

	$mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	$searchterm = "%" . $_GET["term"] . "%";

	$statement = $mysqli->prepare("SELECT * FROM tracks WHERE name LIKE ? LIMIT 10");
	$statement->bind_param("s", $searchterm);
	$executed = $statement->execute();
	if(!$executed) {
		echo $mysqli->error;
		exit();
	} 

	// How prepared statement gets results
	$results = $statement->get_result();

	$mysqli->close();

	// Create a variable to hold our results
	$results_array = [];

	// Run through all the results and push each row into the $results_array
	while($row = $results->fetch_assoc()) {
		array_push($results_array, $row);
	}

	// Convert this assoc array into json string and echo it out so that frontend receives it
	echo json_encode($results_array);


?>