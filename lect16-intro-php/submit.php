<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Intro to PHP</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Intro to PHP</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4 mb-3">PHP Output</h2>

<div class="col-12">
	<!-- Display Test Output Here -->
	<?php
		// Write php within the <?php tags

		// echo displays strings/ints etc to the browser
		echo "Hello!!!";

		// can even write HTML within echo
		echo "<strong>Tommy</strong>";
		echo "<hr>";

		// Variables in php

		$name = "Tommy";
		$age = 21;

		echo $name;

		// For strings, can use single quote or double quotes. The only difference is with double quotes, you can utilize variable interpolation, like below:

		echo "My name is $name";

		// Can't do variable interpolation with single quotes
		echo 'My name is $name';

		// Concatenation with strings is very similar as other langauges except use period (.) to concatenate strings

		echo "<hr>";
		echo "My name is <em>" . $name . "</em>";

		// var_dump() is a useful method to dump out more information about a variable. It tells you the data type and value.
		echo "<hr>";
		var_dump($name);


		// Date/time function in PHP is great!

		// Set the timezone we'll be using
		// the parameter is the country/city name that can be found in the php documentation
		date_default_timezone_set("America/Los_Angeles");
		
		echo "<hr>";
		// Display the current time in a specific format.
		// date() returns the current day and time
		// 1st param: the format of the current date/time https://www.php.net/manual/en/datetime.format.php
		echo date("m-d-y H:i:s T");
		
		// Arrays in PHP
		$colors = ["red", "blue", "green"];
		echo "<hr>";
		echo $colors[0];
		
		echo "<hr>";
		for($i = 0; $i < sizeof($colors); $i++ ) {
			echo $colors[$i] . ", ";
		}

		// Associative arrays are very useful in PHP
		// Associative arrays are arrays with string keys
		$courses = [
			"ITP 303" => "Full-Stack Web Development",
			"ITP 404" => "Advanced Front-End Development",
			"ITP 405" => "Advanced Back-End Development"
		];

		// Can grab values by string key
		echo "<hr>";
		echo $courses["ITP 303"];

		// Iterating through associative arrays with foreach loop
		echo "<hr>";
		foreach($courses as $courseNumber => $courseName) {
			echo $courseNumber . ": " . $courseName;
			echo "<br>";
		}

		// Use foreach loop to show ONLY the values (the right hand side)
		echo "<hr>";
		foreach($courses as $courseName) {
			echo $courseName;
			echo "<br>";
		}

		// If you try to echo out an array or assoc array, you will see an error
		// You can echo out strings and numbers. Not arrays.
		//echo $courses;

		// However, you ca use var_dump() to quickly see information about an array
		echo "<hr>";
		var_dump($courses);

		// Superglobal variables are default holding some information, usually as an array
		var_dump($_SERVER);
		// It's an associative array so I can grab any value I need
		echo "<hr>";
		echo $_SERVER["HTTP_SEC_CH_UA"];

		// Two other commonly used superglobal variables
		echo "<hr>";
		echo "GET: ";
		var_dump($_GET);
		echo "<br>";
		echo "POST: ";
		var_dump($_POST);
		
	?>
</div>

		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">
		<div class="row">

			<h2 class="col-12 mt-4">Form Data</h2>

		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-3 text-right">Name:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
<?php
	if( isset($_POST["name"]) && !empty($_POST["name"])) {
		echo $_POST["name"];
	}
	else {
		// text-danger class name comes from bootstrap
		echo "<div class='text-danger'>Not provided</div>";
	}
	
?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Email:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
<?php
	if( isset($_POST["email"]) && !empty($_POST["email"])) {
		echo $_POST["email"];
	}
	else {
		// text-danger class name comes from bootstrap
		echo "<div class='text-danger'>Not provided</div>";
	}
	
?>				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Current Student:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subscribe:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				<?php
					if( isset($_POST["subscribe"]) && !empty($_POST["subscribe"])) {
						// Foreach loop to iterate
						foreach ( $_POST["subscribe"] as $sub ) {
							echo $sub . ", ";
						}
					}
					else {
						// class text-danger is coming from bootstrap
						echo "<div class='text-danger'>Not provided.</div>";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Subject:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-3 text-right">Message:</div>
			<div class="col-9">
				<!-- Display Form Data Here -->
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->
	
</body>
</html>