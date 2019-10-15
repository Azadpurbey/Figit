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

	if(isset($_POST['register'])) {

        $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES (:username, :email, :password)";
        $result = $db->prepare($sql);
        $params = array(
            ':username' => $_POST['username'],
            ':email' => $_POST['email'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        );
        if($result->execute($params)) {
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
					<h4>Sign up</h4>
					<hr>
					<div class="form-group">
						<label for="name">User Name</label>
						<input type="text" class="form-control" id="name" name="username" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="Email1">Email address</label>
						<input type="email" class="form-control" id="Email1" name="email" placeholder="E-mail">
					</div>
					<div class="form-group">
						<label for="Password">Password</label>
						<input type="password" class="form-control" id="Password" name="password" placeholder="Password">
					</div>
					
		
					<button type="submit" class="btn btn-default" name="register">Submit</button>
				</form>
				<div>
					<p>Hace an account ? <a href="./login.php">Log in</a> </p>
					
			    </div>
			    
					<div class="row text-center">
				    	<div class="col-12 social">
				    		<a href="#"><i class="fab fa-google"></i></a>
					        <a href="#"><i class="fab fa-facebook"></i></a>
					        <a href="#"><i class="fab fa-twitter"></i></a>
				        </div>
			        </div>
               
            </div>
            <div class="col-xs-4">
				<a  class="cross" href="./index.php"> <img src="./image./contact-us/cross.png"></a>
			</div>
		</div>
	</div>		
</div>
</body>
</html>