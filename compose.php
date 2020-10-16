<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Messager</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Messager</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="compose.php"><i class="far fa-envelope"></i>Compose</a>
				<a href="read.php"><i class="fas fa-envelope"></i>All messages</a>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:14px;"></span></a>
					<ul class="dropdown-menu"></ul>
				</li>
				
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>New Message</h2>
			<form action="send_email.php" method="post" id="comment_form">
				<div class="form-group">
					<label for="receiver">To:</label>
					<input type="text" name="to_email" id="to_email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="subject">Enter Subject:</label>
					<input type="text" name="subject" id="subject" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="message">Enter Message:</label>
					<textarea name="text" id="text" class="form-control" rows="6" required></textarea>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" id="post" class="btn btn-info" value="Send" />
				</div>
			</form>

	</body>
</html>

<script>

$(document).ready(function(){

// updating the view with notifications using ajax

function load_unseen_notification(view = '')

{

 $.ajax({

  url:"fetch.php",
  method:"POST",
  data:{view:view},
  dataType:"json",
  success:function(data)

  {

   $('.dropdown-menu').html(data.notification);

   if(data.unseen_notification > 0)
   {
    $('.count').html(data.unseen_notification);
   }

  }

 });

}

load_unseen_notification();
/*
// submit form and get new records

$('#comment_form').on('submit', function(event){
 event.preventDefault();

 if($('#to_email').val() != '' && $('#subject').val() != '' && $('#text').val() != '')

 {

	var p_to = $(this).('#to_email').val();
	var p_subject = $(this).('#subject').val();
	var p_text = $(this).('#text').val();
    //var form_data = $(this).serialize();

  $.ajax({

   url:"insert.php",
   method:"POST",
   data:{p_to:p_to, p_subject:p_subject, p_text:p_text},
   success:function(data)

   {

    $('#comment_form')[0].reset();
    load_unseen_notification();

   }

  });

 }

 else

 {
  alert("All Fields are Required");
 }

});
*/
// load new notifications

$(document).on('click', '.dropdown-toggle', function(){

 $('.count').html('');

 load_unseen_notification('yes');

});

setInterval(function(){

 load_unseen_notification();

}, 5000);

});

</script>
