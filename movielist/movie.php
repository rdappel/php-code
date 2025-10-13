<?php

// add "update" link to index.php

if (!isset($_GET['id']) || empty($_GET['id'])) {
	header("Location: index.php");
	exit;
}

$movieID = $_GET['id'];

include "../includes/db.php";

$con = getDBConnection();
$query = "SELECT * FROM movielist WHERE MovieID = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $movieID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);

$title = $row['MovieTitle'];
$rating = $row['MovieRating'];


/>

Copy HTML from Add Movie (change button to say "Update Movie")

<input type="hidden" name="txtID" id="txtID" value="<?php echo $movieID; ?>" />