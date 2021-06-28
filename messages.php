<?php

include('validate.php');
// If any field is not filled properly
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($error) {
	    header("Location: ./");
    }
} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Support Messages</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body { padding: 2px 20px; }
		table, th, td { border: 1px solid black; }
		table {
			width: 100%;
			text-align: left;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<p><?php if($successful) { echo "Thanks for contacting us $name, we will get back to you shortly through your email, <a href='mailto:$email'>$email.</a>";} ?></p>

	<div class="supporthead">
		<h1>Support Messages</h1>
		<p><a href="./">New Support Message</a></p>
	</div>

	<?php
	include "connect.php";

	if ($successful) {
		try {
			// Set Error mode to PDO Exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = $conn->prepare("INSERT INTO
				smessages (name, email, issue, messages)
				VALUES (:name, :email, :issue, :message)");
			$sql->bindParam(':name', $name);
			$sql->bindParam(':email', $email);
			$sql->bindParam(':issue', $issue);
			$sql->bindParam(':message', $message);
			$sql->execute();
			echo "Form submitted successfully";
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	?>

	<div class="smbody">
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Issue</th>
					<th>Messages</th>
					<th>Edit</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$query = $conn->prepare("SELECT * FROM smessages");
				$query->execute();
				$messages = $query->fetchAll();
				foreach ($messages as $messages) {
				?>

				<tr>
					<td> <?php echo $messages['name']; ?> </td>
					<td> <?php echo $messages['email']; ?> </td>
					<td> <?php echo $messages['issue']; ?> </td>
					<td> <?php echo $messages['messages']; ?> </td>
					<td><a href="edit.php?id=<?php echo $messages['id']; ?>">Edit</a></td>
				</tr>
				<?php
			    }
			    ?>
			</tbody>
		</table>
	</div>

	<?php $usernamerr = $emailerr = $issuerr = $messagerr = ""; ?>

</body>
</html>

