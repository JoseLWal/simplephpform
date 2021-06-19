<?php 
$username = $email = $issue = $message = "";
$usernamerr = $emailerr = $issuerr = $messagerr = "";


//echo '<pre>' . print_r( $_POST, TRUE ) . '</pre>';

// Validate the username field
if ( empty( $_POST["username"] ) )
{
  $usernamerr = "Please enter your name.";
} elseif( strlen( $_POST["username"]) < 3 ) {
  $usernamerr = "Your name must be at least 3 characters.";
} else {
  $username = test_input($_POST["username"]);
  // Ensure that username contains only letter and white spaces
  if ( !preg_match("/^[a-zA-Z-' ]*$/", $username) )
  {
    $usernamerr = "Your name can contain only letters and white spaces.";
  }
}

// Validate the email field
if ( empty( $_POST["email"] ) )
{
  $emailerr = "Please enter your email.";
} else {
  $email = test_input($_POST["email"]);
  // Ensure that email address is proper
  if ( !filter_var($email, FILTER_VALIDATE_EMAIL) )
  {
    $emailerr = "Invalid email format";
  }
}

// Validate the issue field
if ( empty( $_POST["issue"] ) )
{
  $issuerr = "Please select an issue.";
} else {
  $issue = test_input($_POST["issue"]);
}

// Validate the message field
if ( empty( $_POST["message"] ) )
{
  $messagerr = "Please explain the issue you have.";
} elseif( strlen( $_POST["message"] ) < 3 ) {
  $messagerr = "Your message must be at least 3 characters.";
} else {
  $message = test_input($_POST["message"]);
}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>