<?php
var_dump($_GET);
echo "<hr>";
echo $_GET["track_name"];
echo "<hr>";
echo $_GET["genre"];
echo "<hr>";
echo $_GET["media_type"];

// Same 4 steps to connect and query the database

// STEP 1
$host = "303.itpwebdev.com";
$user = "nayeon_db_user";
$password = "uscItp2021!";
$db = "nayeon_song_db";

$mysqli = new mysqli($host, $user, $password, $db);
if($mysqli->connect_errno) {
	echo $mysqli->connect_error;
	exit();
}

// Remove weird symbols
$mysqli->set_charset("utf-8");


// STEP 2
$sql = "SELECT tracks.name AS track, 
genres.name AS genre, 
media_types.name AS media_type
FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id
JOIN media_types
	ON tracks.media_type_id = media_types.media_type_id
WHERE 1=1";

// Depending on what user information was passed to this page, append to the base statement
if( isset($_GET["track_name"]) && !empty($_GET["track_name"]) ) {
	$sql = $sql . " AND tracks.name LIKE '%" . $_GET["track_name"] . "%' ";
}

// Check if user selected genre
if( isset($_GET["genre"]) && !empty($_GET["genre"]) ) {
	$sql = $sql . " AND genres.genre_id = " . $_GET["genre"];
}

// Check if user selected media type
if( isset($_GET["media_type"]) && !empty($_GET["media_type"]) ) {
	$sql = $sql . " AND media_types.media_type_id = " . $_GET["media_type"];
}

// Don't forget the semicolon at the end!
$sql = $sql . ";";

// Really important to check that your SQL statement looks good
echo "<hr>" . $sql . "<hr>";

// Submit the query!
$results = $mysqli->query($sql);
if(!$results) {
	echo $mysqli->error;
	exit();
}
// close the db connection
$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Song Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">Song Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4 mt-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing 2 result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>Track</th>
							<th>Genre</th>
							<th>Media Type</th>
						</tr>
					</thead>
<tbody>

	<?php while($row = $results->fetch_assoc()):?>
	<tr>
		<td><?php echo $row["track"] ?></td>
		<td><?php echo $row["genre"] ?></td>
		<td><?php echo $row["media_type"] ?></td>
	</tr>
	<?php endwhile;?>

	<!-- <tr>
		<td>For Those About To Rock (We Salute You)</td>
		<td>Rock</td>
		<td>MPEG audio file</td>
	</tr>

	<tr>
		<td>Put The Finger On You</td>
		<td>Rock</td>
		<td>MPEG audio file</td>
	</tr> -->

</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>