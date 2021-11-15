<?php

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	exit("Use POST method!!");
}

// define variables and set to empty values

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$ime = test_input($_POST["ime"]);
$priimek = test_input($_POST["priimek"]);

if (empty($ime) || empty($priimek)) {
	exit("Obvezno vnesi ime in priimek!");
}

$target_dir = $ime . "_" . $priimek . "/";

mkdir($target_dir, 0777, true);

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	echo "The file <strong>". htmlspecialchars(basename( $_FILES["fileToUpload"]["name"])). "</strong> has been uploaded to <strong>" . $target_dir . "</strong>.<br>";
} else {
	exit("Sorry, there was an error uploading your file.");
}

echo "<a href='index.php'><button>Return</button></a><br>"

?>
