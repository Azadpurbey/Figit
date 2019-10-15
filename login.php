<?php

	// error_reporting(0);
	session_start();

	if(isset($_SESSION['username']) && isset($_SESSION['access_token'])){
		header("Location: account.php");
	}

	try{
		require_once('config/dbc.php');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(Exception $e){
		$error = $e->getMessage();
	}

	if(isset($error)){
		echo $error;
	}
	else{
		if(isset($_POST['login'])){

			$sql = "SELECT * FROM `users` WHERE `username` = :username";
			$result = $db->prepare($sql);
			$result->execute(array(
				':username' => $_POST['username']
			));

			$res = $result->fetch(PDO::FETCH_ASSOC);

			if($res) {
				if(password_verify($_POST['password'], $res['password'])) {
					$hash = uniqid('user_');

					$query = "UPDATE `users` SET `hash` = :hash WHERE `username` = :username";
					$r = $db->prepare($query);
					$r->execute(array(
						':username' => $_POST['username'],
						':hash' => $hash
					));

					$_SESSION['username'] = $_POST['username'];
					$_SESSION['access_token'] = $hash;

					unset($hash);

					header("Location: account.php");
				}
				else {
					$error = 'Incorrect password';
				}
			}
			else {
				$error = 'Please register first';
			}

		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>sign in</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="sign-in.css">
</head>
<body>
<div class="container-fluid">
	<div class="container-azad">
		<div class="row">
			<div class="col-xs-4">
	
			</div>
			<div class="col-xs-4">
				<form action="" method="post">
					<h4>Sign in</h4>
					<div class="form-group">
						<label for="name">User Name</label>
						<input type="text" class="form-control" id="name" name="username" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="Password">Password</label>
						<input type="password" class="form-control" id="Password" name="password" placeholder="Password">
					</div>
					<?php
						if(isset($error)) {
					?>
							<p class="alert alert-danger">
								<?= $error ?>
							</p>
					<?php
						} 
					?>
					<button type="submit" class="btn btn-default" name="login">Sign in</button>
                </form>
            </div>
            <div class="col-xs-4">
				<a  class="cross" href="./index.php"> <img src="./image./contact-us/cross.png"></a>
			</div>
		</div>
	</div>		
</div>
</body>
</html>    