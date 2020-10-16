<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
	
	//$m_id = $_SESSION['m_id'];
	//$from_email = $_SESSION['email'];
	$to_email = $_POST['to_email'];
	$subject = $_POST['subject'];
	$text = $_POST['text'];
	$p_status = '1';
	
	/*
	$query = $con->prepare("SELECT * FROM users WHERE email=? "); 
    $query->bindParam(1,$email);
    $query->execute();
    $foundUser = $query->rowCount();

    if($foundUser != $to_email){
    	echo "<div class='errors'><strong>$email</strong> does not exist!!</div>"; 
    	return; 
    }
	*/
	
	// We don't have the password or email info stored in sessions so instead we can get the results from the database.
	$stmt = $con->prepare('SELECT email FROM accounts WHERE id = ?');
	
	// In this case we can use the account ID to get the account info.
	$stmt->bind_param('i', $_SESSION['id']);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->fetch();
	$stmt->close();
	
	$sql_e = "SELECT * FROM accounts WHERE email='$to_email' ";
	$res_e = mysqli_query($con, $sql_e);
	
	if(mysqli_num_rows($res_e)>0) {
	
		$sql="INSERT INTO message (from_email, to_email, subject, text) VALUES ('$email','$to_email', '$subject', '$text')";
	
		//$sql .= "INSERT INTO pending (p_from, p_to, p_subject, p_text) VALUES ('$email','$to_email', '$subject', '$text')";
		//mysqli_multi_query($con, $sql);
		
		if(!$result = $con->query($sql)){
			die('There was an error running the query [' . $con->error . ']');
		}
		else
		{
			echo "Message Sent!";
			header('Location: home.php');
		}

		$sql1 = "
		INSERT INTO pending 
		(p_from, p_to, p_subject, p_text, p_status) 
		VALUES ('$email','$to_email', '$subject', '$text', '$p_status')
		";

		mysqli_query($con, $sql1);
	}	
	else 
	{
		echo "There is no member in Messager with an email like : $to_email";
		header('Location: compose.php');
	}

}

mysqli_close($con);

?>