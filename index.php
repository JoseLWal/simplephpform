<?php
session_start();
//https://stackoverflow.com/questions/13889198/php-avoid-browser-reposting-post-on-page-refresh/13889283#13889283
if( strcasecmp( $_SERVER['REQUEST_METHOD'],"POST" ) === 0 )
{
	$_SESSION['postdata'] = $_POST;
	header("Location: ".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
	exit();
}

/* if ( !$_SESSION['postdata'] )
{
	//header("Location: register.php");
	//exit();
} */

if( isset( $_SESSION['postdata'] ) )
{
	$_POST = $_SESSION['postdata'];
	unset($_SESSION['postdata']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Form Input</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>

	<?php
  $usernamerr = '.';
  include('validateform.php');
  include('connect.php');
  //echo '<pre>' . print_r( $_SESSION, TRUE ) . '</pre>';
  if( $usernamerr . $emailerr . $issuerr . $messagerr == '' )
  {
    include('mssgreceived.php');
  } else {
  ?>

    <div class="tophead">
    <h1>Simple Form Input</h1>
    <p>Please fill in this form</p>
    </div>
    <div class="input">
      <form method="POST" action="mssgreceived.php">
        <label for="username">Name: </label><br>
        <input type="text" name="username" value="<?php if($username) {echo $_POST['username'];} ?>" />
        <span class="error">*<br /><?php echo $usernamerr; ?></span><br><br>

        <label for="email">Email: </label><br>
        <input type="email" name="email" value="<?php if($email) {echo $_POST['email'];} ?>" />
        <span class="error">*<br /><?php echo $emailerr; ?></span><br><br>

        <label for="issue">Issue: </label><br>
        <select name="issue">
            <option value="query" <?php if($issue) {echo $_POST['issue'] == 'query' ? 'selected ' : '';} ?>>Query</option>
            <option value="feedback" <?php if($issue) {echo $_POST['issue'] == 'feedback' ? 'selected ' : '';} ?>>Feedback</option>
            <option value="complaint" <?php if($issue) {echo $_POST['issue'] == 'complaint' ? 'selected ' : '';} ?>>Complaint</option>
            <option value="other" <?php if($issue) {echo $_POST['issue'] == 'other' ? 'selected ' : '';} ?>>Other</option>
        </select>
        <span class="error">*<br /><?php echo $issuerr; ?></span>
        <br><br>

        <label for="message">Message: </label><br>
        <textarea name="message" rows="6"><?php if($message) {echo $_POST['message'];} ?></textarea>
        <span class="error">*<br /><?php echo $messagerr; ?></span>
        <br><br>

        <input type="submit" name="Submit">
      </form>
    </div>
  <?php
  }
  ?>
  </body>
</html>