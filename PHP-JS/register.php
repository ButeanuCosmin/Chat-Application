<!--
//register.php
!-->

<?php

include('conexiune.php');

session_start();

$mesaj = '';

if(isset($_SESSION['utilizator_id']))
{
	header('location:index.php');
}

if(isset($_POST["register"]))
{
	$nume = trim($_POST["username"]);
	$parola = trim($_POST["password"]);
	$check_query = "
	SELECT * FROM login 
	WHERE nume = :nume
	";
	$statement = $connect->prepare($check_query);
	$check_data = array(
		':nume'		=>	$nume
	);
	if($statement->execute($check_data))	
	{
		if($statement->rowCount() > 0)
		{
			$mesaj .= '<p><label>Username already taken</label></p>';
		}
		else
		{
			if(empty($nume))
			{
				$mesaj .= '<p><label>Username is required</label></p>';
			}
			if(empty($parola))
			{
				$mesaj .= '<p><label>Password is required</label></p>';
			}
			else
			{
				if($parola != $_POST['confirm_password'])
				{
					$mesaj .= '<p><label>Password not match</label></p>';
				}
			}
			if($mesaj == '')
			{
				$data = array(
					':nume'		=>	$nume,
					':parola'		=>	$parola,
				);

				$query = "
				INSERT INTO login 
				(nume, parola) 
				VALUES (:nume, :parola)
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$mesaj = "<label>Registration Completed</label>";
				}
			}
		}
	}
}

?>

<html>  
    <head>  
        <title>Chat Application</title>  
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
			<br />
			
			<h3 align="center">Chat Application</a></h3><br />
			<br />
			<div class="panel panel-default">
  				<div class="panel-heading">Register</div>
				<div class="panel-body">
					<form method="post">
						<span class="text-danger"><?php echo $mesaj; ?></span>
						<div class="form-group">
							<label>Enter Username</label>
							<input type="text" name="username" class="form-control" />
						</div>
						<div class="form-group">
							<label>Enter Password</label>
							<input type="password" name="password" class="form-control" />
						</div>
						<div class="form-group">
							<label>Re-enter Password</label>
							<input type="password" name="confirm_password" class="form-control" />
						</div>
						<div class="form-group">
							<input type="submit" name="register" class="btn btn-info" value="Register" />
						</div>
						<div align="center">
							<a href="login.php">Login</a>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>  
</html>
