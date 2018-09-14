<!DOCTYPE html>
<?php session_start(); 
if(isset($_SESSION['usernames']) || isset($_SESSION['usernameb']))
	header('location:main.php');
if(isset($_SESSION['incorrectb']))
{
	?>
	<script>
	alert("NOT A REGISTERED BIDDER.....REGISTER FIRST");
	</script>
	<?php
	session_destroy();
}
if(isset($_SESSION['alreadyexists']))
{
	?>
	<script>
	alert("Sorry can't register you. Either username or email already registered");
	</script>
	<?php
	session_destroy();
}
if(isset($_SESSION['incorrects']))
{
	?>
	<script>
	alert("NOT A REGISTERED SELLER.....REGISTER FIRST");
	</script>
	<?php
	session_destroy();
}
if(isset($_SESSION['forgotseller']))
{
	?>
	<script>
	alert("Sorry your provided email is not registered");
	</script>
	<?php
	session_destroy();
}
if(isset($_SESSION['done']))
{
	?>
	<script>
	alert("Your email and password has been sent to your provided email address");
	</script>
	<?php
	session_destroy();
}
if(isset($_SESSION['notdone']))
{
	?>
	<script>
	alert($_SESSION['notdone']);
	</script>
	<?php
	session_destroy();
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DoorStep Auction</title>
  <link href="css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="SHORTCUT ICON" href="mini_project_images/auction.jpg">
  </head>
  <body style="background-color:#FFEFD5">
	<div class="container">
		<div style="margin-top:50px;margin-bottom:10px" class="row">
			<div class="col-xs-12">
				<div style="background-color:lightgreen;border-radius:5px">
					<div class="row">
						<div class="col-xs-3">
							<img style="margin:8px" src="mini_project_images/auction.jpg" class="img-rounded img-responsive"/>
						</div>
						<div class="col-xs-offset-2 col-xs-5">
							<div style="background-color:#00fa9a" class="jumbotron h1 pull-left">DoorStep Auction</div>
						</div>
						<div style="margin-top:20px" class="col-xs-2">
							<button class="btn btn-success" data-target="#admin" data-toggle="modal">Admin</button>
						<div class="modal" id="admin" tabindex="-1" data-keyboard="false" data-backdrop="static">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button class="close pull-right" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Admin</h4>
									</div>
									<div class="modal-body">
									<form action="adminconnection.php" method="post">
										<div class="form-group">
											<label for="username">USERNAME</label>
											<input type="text" required id="username" name="username" class="form-control"/>
										</div>
										<div class="form-group">
											<label for="password">PASSWORD</label>
											<input type="password" required id="password" name="password" class="form-control"/>
										</div>
										<button type="submit" name="submita" class="btn btn-success">Login</button>
									</form>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div style="background-color:#e9967a;border-radius:6px" class="col-xs-4">
				<h3>Seller's Portal</h3>
					<form id="sellerform" method="post" action="homedatabase.php">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" required name="loginusernames" class="form-control" id="username"/>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" required name="loginpasswords" class="form-control" id="password"/>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xs-2">
									<button type="submit" name="loginsubmits" class="btn btn-danger">Login <span class="glyphicon glyphicon-off"></span></button>
								</div>
							</div>
						</div>
					</form>			
			</div>
			<div style="background-color:#e9967a;border-radius:6px" class="col-xs-offset-4 col-xs-4">
				<h3>Bidder's Portal</h3>
					<form id="bidderform" method="post" action="homedatabase.php">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" required name="loginusernameb" class="form-control" id="username"/>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" required name="loginpasswordb" class="form-control" id="password"/>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-xs-2">
									<button type="submit" name="loginsubmitb" class="btn btn-danger">Login <span class="glyphicon glyphicon-off"></span></button>
								</div>
							</div>
						</div>
					</form>
			</div>
		</div>
		<div style="margin-top:8px" class="row">
			<div class="col-xs-3">
				<button class="btn btn-warning" data-target="#seller" data-toggle="modal">Register <span class="glyphicon glyphicon-registration-mark"></span></button>
				<button style="margin-left:10px" class="btn btn-danger" data-target="#forgots" data-toggle="modal">Forgot password <span class="glyphicon glyphicon-question-sign"></span></button>
				<div class="modal" id="seller" tabindex="-1" data-keyboard="false" data-backdrop="static">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close pull-right" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Sign up (Seller)</h4>
							</div>
							<div class="modal-body">
								<form action="HomeDatabase.php" method="post" onsubmit="return validates()">
									<div class="form-group">
										<label for="names">FULL NAME</label>
										<input type="text" required name="names"  placeholder="Full Name" id="names" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="usernames">USERNAME</label>
										<input type="text" required name="usernames" placeholder="Username(unique)" id="usernames" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="passwords">PASSWORD</label>
										<input type="password" name="passwords" required placeholder="Password" id="passwords" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="passwordagains">CONFIRM PASSWORD</label>
										<input type="password"  required placeholder="Retype Password" id="passwordagains" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="emails">EMAIL</label>
										<input type="email" name="emails" required placeholder="example@something.com(unique)" id="emails" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="mobilenos">MOBILE NO</label>
										<input type="number" name="mobilenos" required placeholder="+91" id="mobilenos" class="form-control"/>
									</div>
									<button type="submit" name="submits" class="btn btn-danger">Register</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal" id="forgots" tabindex="-1" data-keyboard="false" data-backdrop="static">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close pull-right" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Forgot Password(Your Password will be sent on your email address)</h4>
							</div>
							<div class="modal-body">
								<form action="sendmail.php" method="post" >
									<div class="form-group">
										<label for="usernamefs">USERNAME</label>
										<input type="text"  name="usernamefs" placeholder="Username(unique)" id="usernamefs" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="emailfs">EMAIL</label>
										<input type="email" name="emailfs" required placeholder="example@something.com" id="emailfs" class="form-control"/>
									</div>
									<button type="submit" name="submitfs" class="btn btn-danger">Send</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-offset-5 col-xs-4">
				<button class="btn btn-warning" data-target="#bidder" data-toggle="modal">Register <span class="glyphicon glyphicon-registration-mark"></span></button><button style="margin-left:30px" class="btn btn-danger" data-target="#forgotb" data-toggle="modal">Forgot password <span class="glyphicon glyphicon-question-sign"></span></button>
				<div class="modal" id="bidder" tabindex="-1" data-keyboard="false" data-backdrop="static">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close pull-right" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Sign up (Bidder)</h4>
							</div>
							<div class="modal-body">
								<form action="HomeDatabase.php" method="post" onsubmit="return validateb()">
									<div class="form-group">
										<label for="nameb">FULL NAME</label>
										<input type="text" required name="nameb" placeholder="Full Name" id="nameb" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="usernameb">USERNAME</label>
										<input type="text" required name="usernameb" placeholder="Username(unique)" id="usernameb" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="passwordb">PASSWORD</label>
										<input type="password" name="passwordb" required placeholder="Password" id="passwordb" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="passwordagainb">CONFIRM PASSWORD</label>
										<input type="password" required placeholder="Retype Password" id="passwordagainb" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="emailb">EMAIL</label>
										<input type="email" name="emailb" required placeholder="example@something.com(unique)" id="emailb" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="mobilenob">MOBILE NO</label>
										<input type="number" name="mobilenob" required placeholder="+91" id="mobilenob" class="form-control"/>
									</div>
									<button type="submit" name="submitb" class="btn btn-danger">Register</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal" id="forgotb" tabindex="-1" data-keyboard="false" data-backdrop="static">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button class="close pull-right" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Forgot Password(Your Password will be sent on your email address)</h4>
							</div>
							<div class="modal-body">
								<form action="sendmail.php" method="post">
									<div class="form-group">
										<label for="usernamefb">USERNAME</label>
										<input type="text" name="usernamefb" placeholder="Username(unique)" id="usernamefb" class="form-control"/>
									</div>
									<div class="form-group">
										<label for="emailfb">EMAIL</label>
										<input type="email" name="emailfb" required placeholder="example@something.com" id="emailfb" class="form-control"/>
									</div>
									<button type="submit" name="submitfb" class="btn btn-danger">Send</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="background-color:maroon;margin-bottom:30px;margin-top:30px;padding:20px;border-radius:10px" class="row">
			<div id="l" class="col-xs-12">
				<div id="lastdiv" class="row">
					<div class="col-xs-2">
							<span style="color:white;font-size:20px;text-decoration:underline" onclick="about()">About</span>
					</div>
					<div class="col-xs-offset-3 col-xs-2">
						<a href="#" style="color:white;font-size:20px;text-decoration:underline">Goto Top</a>
					</div>
					<div class="col-xs-offset-3 col-xs-2">
						<span style="color:white;font-size:20px;text-decoration:underline" onclick="developer()">Developer</span>
					</div>
				</div>
				<div style="margin-top:30px" class="row">
					<center><div class="col-xs-offset-4 col-xs-3">
						<span style="color:white;font-size:20px">DoorStep Auction &#169; &#174;</span>
					</div></center>
				</div>
			</div>
		</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="Home.js"></script>
  </body>
</html>