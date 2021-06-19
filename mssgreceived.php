<?php require "validateform.php"; ?>

<!DOCTYPE html>
<html>
  <head>
	<title>Message Received</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>

  	<div class="tophead">
  		<h1>Message Received</h1>
  	</div>

  	<div class="formoutput">
  		<p>Hi <?php echo $username; ?>,</p>
		<p>Thanks for contacting us.</p>
		<p>We will get back to you through your email, <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>, concerning the issue you submitted.</p>

  		<h3><?php echo strtoupper($issue); ?></h3>
  		<p><?php echo $message; ?></p>
		<p><a href=".">New Message</a></p>

	  </div>
	  <?php $usernamerr = $emailerr = $issuerr = $messagerr = ""; ?>

  </body>
</html>
