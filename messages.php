<!DOCTYPE html>
<html>
	<head>
		<title>Contact Messages</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php include("connect.php"); ?>

		<div class="tophead">
			<h1>Contact Messages</h1>
		</div>

		<div class="cmessages">
			<table class="messagestable">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Issue</th>
						<th>Message</th>
					</tr>
			    </thead>
			    <tbody>
			    	<?php
			    	require "connect.php";
			    	$query = $conn->prepare("SELECT * FROM contactmssg ORDER BY id DESC");
			    	$query->execute();
			    	while ($fetch = $query->fetch()) {
			    	?>
			    	<td><?php echo $fetch['username'] ?></td>
			    	<td><?php echo $fetch['email'] ?></td>
			    	<td><?php echo $fetch['issue'] ?></td>
			    	<td><?php echo $fetch['message'] ?></td>
			    	<?php
			        }
			        ?>
			    </tbody>
			</table>
		</div>

	</body>
</html>