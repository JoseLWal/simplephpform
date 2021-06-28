<?php
$name = $email = $issue = $message = "";
$namerr = $emailerr = $issuerr = $messagerr = "";
 
 // Validate the Name field
if (empty($_POST['name'])) {
	$namerr = "Please enter your name";
} elseif (strlen($_POST['name']) < 3) {
	$namerr = "Your name must be at least three characters long.";
} else {
	$name = val_input($_POST['name']);
	if (!preg_match("/^[a-zA-Z' ]*$/", $name)) {
		$namerr = "Your name can contain only letters and white spaces.";
	}
}

// Validate the email field
if (empty($_POST['email'])) {
	$emailerr = "Please enter your email.";
} else {
	$email = val_input($_POST['email']);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailerr = "Invalid email format";
	}
}

// Validata the issue field
if ( empty( $_POST['issue'] ) ) {
  $issuerr = "Please select an issue.";
} else {
  $issue = val_input($_POST["issue"]);
}

// Validate the message field
if (empty($_POST['message'])) {
	$messagerr = "Please explain your issue with us.";
} elseif (strlen($_POST['message']) < 30) {
	$messagerr = "Your message must be atlease 30 characters long.";
} else {
	$message = val_input($_POST['message']);
}

function val_input($data) {
 	$data = trim($data);
 	$data = stripcslashes($data);
 	$data = htmlspecialchars($data);
 	return $data;
 }

$successful = $name && $email && $issue && $message;
$error = $namerr || $emailerr || $issuerr || $messagerr;
 ?>
