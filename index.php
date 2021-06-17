<?php require "validateform.php" ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Form Input</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  
  <body>

    <div class="tophead">
      <h1>Simple Form Input</h1>
      <p>Please fill in this form</p>
    </div>
    
    <div class="input">
      <form method="post" action="mssgreceived.php">
        <label for="username">Name: </label><br>
        <input type="text" name="username">
        <span class="error">* <?php echo $usernamerr; ?></span><br><br>

        <label for="email">Email: </label><br>
        <input type="email" name="email">
        <span class="error">* <?php echo $emailerr; ?></span><br><br>

        <label for="issue">Issue: </label><br>
        <select name="issue">
          <option value="query">Query</option>
          <option value="feedback">Feedback</option>
          <option value="complaint">Complaint</option>
          <option value="other">Other</option>
        </select>
        <span class="error">* <?php echo $issuerr; ?></span>
        <br><br>

        <label for="message">Message: </label><br>
        <textarea name="message" rows="6"></textarea>
        <span class="error">* <?php echo $messagerr ;?></span>
        <br><br>

        <input type="submit" name="Submit">
      </form>
    </div>
  </body>
</html>