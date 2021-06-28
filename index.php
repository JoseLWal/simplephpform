<?php
session_start();
if (strcasecmp($_SERVER['REQUEST_METHOD'], "POST") === 0) {
	$_SESSION['postdata'] = $_POST;
	header("Location: " .$_SERVER['PHP_SELF']. "?" .$_SERVER['QUERY_STRING']);
	exit;
}

if (isset($_SESSION['postdata'])) {
	$_POST = $_SESSION['postdata'];
	unset($_SESSION['postdata']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Support Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.error {color: red;}
		input[type=text], input[type=email], select, textarea { 
			width: 95%;
			padding: 3px 5px;
		}
		input[type=submit] {
			padding: 5px 10px;
		}
		.formarea { padding: 20px 400px; }
	</style>
</head>
<body>
	<div class="formarea">
		<div class="supporthead">
			<h1>Support Form</h1>
			<a href="./messages.php">Support Messages</a>
			<p>Please fill in the form to get support from us.</p>
		</div>

		<div class="sfbody">
			<?php
			$usernamerr = '.';
			include('validate.php');
			//echo '<pre>' . print_r( $_SESSION, TRUE ) . '</pre>';
			if( $usernamerr . $emailerr . $issuerr . $messagerr == '' )
			{
				include('messages.php');
			} else {
			?>
			<form method="POST" action="messages.php">
				<label for="name">Name: </label><br>
				<input type="text" name="name" value="<?php if($name) {echo $_POST['name'];} ?>">
				<span class="error">*<br><?php echo $namerr; ?></span><br><br>

				<label for="email">Email: </label><br>
				<input type="email" name="email" value="<?php if($email) {echo $_POST['email'];} ?>">
				<span class="error">*<br><?php echo $emailerr; ?></span><br><br>

				<label for="issue">Issue: </label><br>
				<select name="issue">
					<option value="query" <?php if($issue) {echo $_POST['issue'] == 'query' ? 'selected ' : '';} ?>>Query</option>
					<option value="feedback" <?php if($issue) {echo $_POST['issue'] == 'feedback' ? 'selected ' : '';} ?>>Feedback</option>
					<option value="compliant" <?php if($issue) {echo $_POST['issue'] == 'compliant' ? 'selected ' : '';} ?>>Compliant</option>
					<option value="other" <?php if($issue) {echo $_POST['issue'] == 'other' ? 'selected ' : '';} ?>>Other</option>
				</select>
				<span class="error">*<br><?php echo $issuerr; ?></span><br><br>

				<label for="message">Message: </label><br>
				<textarea name="message"><?php if($message) {echo $_POST['message'];} ?></textarea>
				<span class="error">*<br><?php echo $messagerr; ?></span><br><br>

				<input type="submit" name="Submit">
			</form>
			<?php
		    }
		    ?>
		</div>
    </div>

</body>
</html>