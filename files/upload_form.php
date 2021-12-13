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

// Checks if user sent an empty form
if(!empty(array_filter($_FILES['fileToUpload']['name']))) {
	$target_dir = $ime . "_" . $priimek . "/";
	mkdir($target_dir, 0777, true);
	// Loop through each file in files[] array
	foreach ($_FILES['fileToUpload']['tmp_name'] as $key => $value) {
		$file_tmpname = $_FILES['fileToUpload']['tmp_name'][$key];
		$file_name = $_FILES['fileToUpload']['name'][$key];
		// Set upload file path
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		// If file with name already exist then append time in
		// front of name of the file to avoid overwriting of file
		$file_ext = pathinfo($target_file, PATHINFO_EXTENSION);
		if(file_exists($filepath)) {
			$filepath = $target_dir.time() . $file_name;
			if(move_uploaded_file($file_tmpname, $target_file)) {
				echo "{$file_name} successfully uploaded <br />";
			} else {
				echo "Error uploading {$file_name} <br />";
			}
		} else {
			if( move_uploaded_file($file_tmpname, $target_file)) {
				echo "{$file_name} successfully uploaded <br />";
			} else {                    
				echo "Error uploading {$file_name} <br />";
			}
		}
	}
} else {
	// If no files selected
	echo "No files selected.";
}

echo "<a href='index.php'><button>Return</button></a><br>"

?>
