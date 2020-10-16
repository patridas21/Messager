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
if(isset($_POST['view'])){
	

$query = "SELECT * FROM pending WHERE p_status=1 ORDER BY p_id DESC LIMIT 5";
$result = mysqli_query($con, $query);
$output = '';

/*
$stmt = $con->prepare('SELECT  pending.p_from, pending.p_to, pending.p_subject, pending.p_text FROM accounts INNER JOIN pending ON accounts.email=pending.p_to WHERE pending.p_status=1 AND accounts.id = ? ORDER BY pending.p_id DESC LIMIT 5');
//SELECT accounts.id, message.m_id, message.from_email, message.to_email, message.subject FROM accounts INNER JOIN message ON accounts.email=message.from_email OR accounts.email=message.to_email WHERE accounts.id=2;
$stmt->bind_param('i', $_SESSION['id']); //maybe just id 
$stmt->execute();
$stmt->bind_result($p_from, $p_to, $p_subject, $p_text);
$stmt->fetch();

$output = '';
*/

if (mysqli_num_rows($result)>0) {
	
	while($row = mysqli_fetch_array($result))
	{
	  $output .= '
	  <li>
	  <a href="#">
	  <strong>'.$row["p_from"].'</strong><br />
	  <small><em>'.$row["p_subject"].'</em></small>
	  </a>
	  </li>
	  ';
	} 
}
else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Notification found!</a></li>';

}
//$stmt->close();

//$status_query = "SELECT pending.p_to FROM accounts INNER JOIN pending ON accounts.email=pending.p_to OR accounts.email=pending.p_from WHERE pending.p_status=1 AND accounts.id= ?";
$status_query = "SELECT * FROM pending WHERE p_status=1"; 
//$status_query = mysqli_query("SELECT pending.p_to FROM accounts INNER JOIN pending ON accounts.email=pending.p_to WHERE pending.p_status=1 AND accounts.id= ?") ;
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);

/*
				// elegxos gia na enfanizontai eidopoihseis mono stous duo pou stelnoun kai oxi se olous stin vash
				$stmt = $con->prepare('SELECT pending.p_to, pending.p_from FROM accounts INNER JOIN pending ON accounts.email=pending.p_to OR accounts.email=pending.p_from WHERE pending.p_status=1 AND accounts.id= ?');
				$stmt->bind_param('i', $_SESSION['id']);  
				$stmt->execute();
				$stmt->bind_result($p_to, $p_from);
				$stmt->fetch();
				//$stmt->store_results();
				$sss = $stmt->num_rows;
				$count = $sss;
				$stmt->close();
*/
$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);

echo json_encode($data);
}

if($_POST["view"] != '')
{
	// edw thelei if gia na kanei to update mono o paraliptis
	//header('Location: home.php');
   $update_query = "UPDATE pending SET p_status = 0 WHERE p_status=1";
   mysqli_query($con, $update_query);
   
   
}
?>