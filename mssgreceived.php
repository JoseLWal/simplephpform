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
  		<p>Hi <?php echo $username .",<br>"; ?> Thanks for contacting us. We will get back to you through your email, <?php echo $email; ?>, concerning the issue you submitted.</p>

  		<h3><?php echo strtoupper($issue); ?></h3>
  		<p><?php echo $message; ?></p>

  	</div>

  </body>
</html>