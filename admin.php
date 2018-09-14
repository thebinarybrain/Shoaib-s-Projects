<!DOCTYPE html>
<?php 
session_start();
if(isset($_SESSION['admin']))
{
	if(isset($_SESSION['notdone']))
	{
		?><script>alert("There was some problem, mail has not been sent");</script> <?php
		unset($_SESSION['notdone']);
	}
	if(isset($_SESSION['done']))
	{
		?><script>alert("Mail has been sent");</script> <?php
		unset($_SESSION['done']);
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="jquery.min.js"></script>
	<script src="admin.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body style="background-color:#FFEFD5">
	<div class="container">
	<form action="logout.php" method="post">
<button type="submit" class="btn btn-warning" style="position:relative;left:3%;top:10px">Log Out <span class="glyphicon glyphicon-off"></span></button>
</form>
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
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top:50px">
			<div class="col-xs-12">
			<center><h1>Hello! Shoaib (ADMIN)</h1></center><br/><br/><hr/>
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#item" data-toggle="tab">Items</a></li>
				<li><a href="#seller" data-toggle="tab">Sellers</a></li>
				<li><a href="#bidder" data-toggle="tab">Bidders</a></li>
			</ul>
			<div class="tab-content">
				<div id="item" class="tab-pane active">
				<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<th>Item Id</th>
						<th>Title</th>
						<th>Category</th>
						<th>Buy now price</th>
						<th>Min bid price</th>
						<th>Brand</th>
						<th>Start date</th>
						<th>End date</th>
						<th>Curr bid price</th>
						<th>Status</th>
						<th>Description</th>
						<th>Seller Id</th>
					</thead>
					<tbody>
				<?php
				$con=mysqli_connect('localhost','root');
				mysqli_select_db($con,'assignment');
				$q="select * from item";
				$result=mysqli_query($con,$q);
				$num=mysqli_num_rows($result);
				for($i=0;$i<$num;$i++)
				{
					$row=mysqli_fetch_array($result);
				$id=$row['i_id'];
				?>
				<tr class="success">
				<td><?php echo $row['i_id']; ?> </td>
				<td><?php echo $row['title']; ?> </td>
				<td><?php echo $row['category']; ?> </td>
				<td><?php echo $row['buy_now_price']; ?> </td>
				<td><?php echo $row['min_bid_price']; ?> </td>
				<td><?php echo $row['brand']; ?> </td>
				<td><?php echo $row['start_date']; ?> </td>
				<td><?php echo $row['end_date']; ?> </td>
				<td><?php echo $row['curr_bid_price']; ?> </td>
				<td><?php echo $row['status']; ?> </td>
				<td><?php echo $row['description']; ?> </td>
				<td><?php echo $row['s_id']; ?> </td>
				</tr>
				<tr>
				<td><div style="height:150px;width:150px">
					<?php echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image1']."'>";?>
				</div></td>
				<td><div style="height:150px;width:150px">
				<?php	echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image2']."'>";?>
				</div></td>
				<td><div style="height:150px;width:150px">
				<?php	echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image3']."'>"; ?>
				</div></td>
				<td><form action="deleteitem.php" onclick="return del()" method="post">
				<input type="hidden" value= "<?php echo $row['i_id'] ; ?>" name="idi" />
				<button type="submit" name="delete" class="btn btn-danger">Delete</button>
				</form><br/><br/>
				<?php 
				$con=mysqli_connect('localhost','root');
				mysqli_select_db($con,'assignment');
				$qwar="select warning from item where i_id=$id";
				$reswar=mysqli_query($con,$qwar);
				$rowwar=mysqli_fetch_array($reswar);
				if($rowwar['warning']==NULL)
				{ ?>
				<form action="warning.php" method="post">
				<input type="hidden" value= "<?php echo $row['i_id']  ?>" name="idi" />
				<button class="btn btn-warning" name="warningitem">Send Warning</button>
				</form>
				<?php }
				else
				echo "Warning Sent";
			mysqli_close($con); ?>
				</td>
				</tr>
			<?php	}
				?>
				</tbody>
				</table>
				</div>
				</div>
				<div id="seller" class="tab-pane">
				<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<th>Seller Id</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Phone No</th>
					</thead>
					<tbody>
				<?php
				$con=mysqli_connect('localhost','root');
				mysqli_select_db($con,'assignment');
				$q="select * from seller";
				$result=mysqli_query($con,$q);
				$num=mysqli_num_rows($result);
				for($i=0;$i<$num;$i++)
				{
					$row=mysqli_fetch_array($result);
						$sid=$row['s_id']; ?>
					<tr class="warning">
					<td><?php echo $row['s_id'] ; ?></td>
					<td><?php echo $row['name'] ; ?></td>
					<td><?php echo $row['username'] ; ?></td>
					<td><?php echo $row['email'] ; ?></td>
					<td><?php echo $row['phone_no'] ; ?></td>
					<td><form action="deleteseller.php" onsubmit="return del()" method="post">
					<input type="hidden" value= "<?php echo $row['s_id'] ; ?>" name="sdi" />
				<button type="submit" name="delete" class="btn btn-danger">Delete</button>
				</form>
				<br/><br/>
				<?php 
				$con=mysqli_connect('localhost','root');
				mysqli_select_db($con,'assignment');
				$qwar="select warning from seller where s_id=$sid";
				$reswar=mysqli_query($con,$qwar);
				$rowwar=mysqli_fetch_array($reswar);
				if($rowwar['warning']==NULL)
				{ ?>
				<form action="warning.php" method="post">
				<input type="hidden" value= "<?php echo $row['s_id']  ?>" name="sdi" />
				<button class="btn btn-warning" name="warningseller">Send Warning</button>
				</form>
				<?php }
				else
				echo "Warning Sent";
			mysqli_close($con); ?>
				</td>
					</tr>
		<?php		}
				?>
				</tbody>
				</table>
				</div>
				</div>
				<div id="bidder" class="tab-pane">
				<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<th>Bidder Id</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Phone No</th>
					</thead>
					<tbody>
				<?php
				$con=mysqli_connect('localhost','root');
				mysqli_select_db($con,'assignment');
				$q="select * from bidder";
				$result=mysqli_query($con,$q);
				$num=mysqli_num_rows($result);
				for($i=0;$i<$num;$i++)
				{
					$row=mysqli_fetch_array($result);
						$bid=$row['b_id']; ?>
					<tr class="warning">
					<td><?php echo $row['b_id'] ; ?></td>
					<td><?php echo $row['name'] ; ?></td>
					<td><?php echo $row['username'] ; ?></td>
					<td><?php echo $row['email'] ; ?></td>
					<td><?php echo $row['phone_no'] ; ?></td>
					<td><form action="deletebidder.php" onsubmit="return del()" method="post">
					<input type="hidden" value= "<?php echo $row['b_id'] ; ?>" name="bdi" />
				<button type="submit" name="delete" class="btn btn-danger">Delete</button>
				</form>
					<br/><br/>
				<?php 
				$con=mysqli_connect('localhost','root');
				mysqli_select_db($con,'assignment');
				$qwar="select warning from bidder where b_id=$bid";
				$reswar=mysqli_query($con,$qwar);
				$rowwar=mysqli_fetch_array($reswar);
				if($rowwar['warning']==NULL)
				{ ?>
				<form action="warning.php" method="post">
				<input type="hidden" value= "<?php echo $row['b_id']  ?>" name="bdi" />
				<button class="btn btn-warning" name="warningbidder">Send Warning</button>
				</form>
				<?php }
				else
				echo "Warning Sent";
			mysqli_close($con); ?>
				</td>
					</tr>
		<?php		}
				?>
				</tbody>
				</table>
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
   </body>
</html>
<?php 
}
else
	header('location:home.php');
?>