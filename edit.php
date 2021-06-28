<?php
// Validata the edit
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


include "connect.php"; // Include the Connection
if (isset($_GET['id'])) { //Get the id``
	$id = $_GET['id'];
	echo $id;
	try {
		// Set Error Mode to PDO Exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo $e->getMessage();
	}
} else {
	echo "Something went wrong.";
	exit;
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
			<h1>Edit Support Form</h1>
			<a href="./index.php">New Support Message</a>
			<a href="./messages.php">Support Messages</a>
			<?php
			?>
		</div>

		<div class="sfbody">
			<form method="POST">
				<?php
				$sql = $conn->prepare("SELECT * FROM smessages WHERE id = :id");
				$sql->bindValue(':id', $id);
				$sql->execute();
				$messages = $sql->fetchAll();
				foreach ($messages as $messages) {
				include "validate.php";
				?>
				<label for="name">Name: </label><br>
				<input type="text" name="name" value="<?php echo $messages['name']; ?>">
				<span class="error">*<br><?php echo $namerr; ?></span><br><br>

				<label for="email">Email: </label><br>
				<input type="email" name="email" value="<?php echo $messages['email']; ?>">
				<span class="error">*<br><?php echo $emailerr; ?></span><br><br>

				<label for="issue">Issue: </label><br>
				<select name="issue" value="<?php echo $messages['issue']; ?>">
					<option value="query" <?php echo $messages['issue'] == "query" ? "selected" : ""; ?>>Query</option>
					<option value="feedback" <?php echo $messages['issue'] == "feedback" ? "selected" : ""; ?>>Feedback</option>
					<option value="compliant" <?php echo $messages['issue'] == "compliant" ? "selected" : ""; ?>>Compliant</option>
					<option value="other" <?php echo $messages['issue'] == "other" ? "selected" : ""; ?>>Other</option>
				</select>
				<span class="error">*<br><?php echo $issuerr; ?></span><br><br>

				<label for="message">Message: </label><br>
				<textarea name="message"><?php echo $messages['messages']; ?></textarea>
				<span class="error">*<br><?php echo $messagerr; ?></span><br><br>

				<?php
				}
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if ($successful) {
						$sql = $conn->prepare("UPDATE smessages SET name=:name, email=:email, issue=:issue, messages=:message WHERE id=:id");
						$sql->bindParam(':name', $name);
						$sql->bindParam(':email', $email);
						$sql->bindParam(':issue', $issue);
						$sql->bindParam(':message', $message);
						$sql->bindParam(':id', $id);
						$sql->execute();
						echo "Support Message updated successfully.";
					} else {
						echo $e->getMessage();
					}
				}
				?>

				<input type="submit" name="Submit">
			</form>
		</div>
    </div>

</body>
</html>