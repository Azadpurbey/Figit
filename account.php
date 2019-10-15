<?php

	// error_reporting(0);
	session_start();

	if(!isset($_SESSION['username']) || !isset($_SESSION['access_token'])){
		header("Location: login.php");
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
		$sql = "SELECT username, email FROM `users` WHERE `username` = :username AND `hash` = :hash";
		$result = $db->prepare($sql);
		$result->execute(array(
			':username' => $_SESSION['username'],
			':hash' => $_SESSION['access_token']
		));

		$res = $result->fetch(PDO::FETCH_ASSOC);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="account.css">
</head>
<body>

<!-- nav bar  -->
<nav class="navbar navbar-invert navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-links" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
      	<a class="navbar-brand" href="./index.php">
	      	<img width="40" alt="Brand"src="./image./index/logo.png">
      	</a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-links">
    	<ul id="links" class="nav navbar-nav navbar-right">
	    	<li> <a href="./about.php">ABOUT</a></li>
	    	<li> <a href="./features.php">FEATURES</a></li>
	    	<li> <a href="./blogs.php">BLOGS</a></li>
	    	<li> <a href="./contact-us.php">CONTACT US</a></li>
	    	<li> <a class="active" href="./account.php">ACCOUNT</a></li>
	    	<!-- <li id="signIn"> <a href="./sign-in.php">SIGN IN</a></li> -->
        </ul>
    </div>
  </div>
</nav>
<!-- nav bar ends -->
<div class="main-container">
	<div class="heading">
		<h3>DASHBOARD</h>
		<div class="profile">
			<div class="profile-pic">
				<img src="http://i.imgur.com/qK42fUu.jpg" class="image--cover">	
			</div>
			
			<div class="profile-data">
				<h4 class="a"><?= $res['username'] ?></h4>
			    <h5 class="b"><?= $res['email'] ?></h5>
				<h5 class="c">Humble Beginner</h5>
			</div>
		</div>	
	</div>

	<div class="sections section1">
		<div class="container-azad">
			<h3 class="white">completed cources</h3>
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<div class="special-container">
						<h4 >Segmentation and target</h4>
						<p>
							Brand Positioning
						</p>
						<p>completed on- 4 july 19</p>
						
					</div>
					
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="special-container">
						<h4 >Segmentation and target</h4>
						<p>
							Brand Positioning
						</p>
						<p>completed on- 4 july 19</p>
						
					</div>
					
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="special-container ">
						<h4 >Segmentation and target</h4>
						<p>
							Brand Positioning
						</p>
						<p>completed on- 4 july 19</p>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
	</div>

	<div class="sections section2">
		<div class="container-azad">
			<h3 class="white">Checkpoints</h3>
            <div class="row ">
	            <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Conceived </h4>
			            </div>
			        </div> 
		        </div>
			    <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Seed  </h4>
			            </div>
			        </div> 
		        </div>
		        <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Start-up  </h4>
			            </div>
			        </div> 
		        </div>
		        <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Growing</h4>
			            </div>
			        </div> 
		        </div>	        	
		        <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Funded</h4>
			            </div>
			        </div> 
		        </div>
		        <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Well-defined  </h4>
			            </div>
			        </div> 
		        </div>
		         <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Established  </h4>
			            </div>
			        </div> 
		        </div>
		         <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Expanding  </h4>
			            </div>
			        </div> 
		        </div>
		         <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Sensational  </h4>
			            </div>
			        </div> 
		        </div>
		         <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Corporate  </h4>
			            </div>
			        </div> 
		        </div>
		         <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Humble Beginnings  </h4>
			            </div>
			        </div> 
		        </div>
		        <div class="col-md-2 col-xs-3">
			        <div class="card">
			        	<div class="thumbnail card">
			          		<img class="card-img-top" src="./image/account/check1.png">
			            </div>
			            <div class="card-body">
			            	<h4 class="card-text">Humble Beginnings  </h4>
			            </div>
			        </div> 
		        </div>

		    </div>    
	    </div>
	</div>
</div>
	








<!-- site map -->
<div class="site-map">
	<footer >
		<div  id="foot"class="container">
			 <div class="row">
			 	<div class="col-sm-5 ">
			 		<div class="logo">
			 			<img style="width: 100%;" src="./image./index/purple.png">
			 		</div>
                	<h6 style="margin: 0 auto;">Address: Lorem ipsum dolor sit amet,eu quidam omnesque pro. Incum salutandi gubergren </h6>
			    </div>
			    <div class="col-sm-2 ">
			    	<h6 class="blue">COMPANY</h6>
			    	<a href="./index.php">Home Page</a> <br>
			    	<a href="#">Discover</a> <br>
			    	<a href="./about.php">About us</a>
			    </div>
			    <div class="col-sm-2 ">
			    	<h6 class="blue">INFORMATION</h6>
			    	<a href="./sign-in.php">Creat Accounts</a> <br>
			    	<a href="#">Careers</a>
			    </div>
			    <div class="col-sm-2 ">
			    	<h6 class="blue">LEGAL</h6>
			    	<a href="#">Privacy Policy</a> <br>
			    	<a href="#">Cookie Policy</a> <br>
			    	<a href="#">Terms of Usage</a>
			    </div>
			    <div class="col-sm-1">
			    </div>
			</div>	
		</div>
	</footer>
</div>
<!-- site map ends -->


</body>
</html>