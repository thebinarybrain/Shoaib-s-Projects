<!DOCTYPE html>
<?php
session_start();
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
  <a href="main.php"><button  class="btn btn-warning" style="position:relative;left:3%;top:20px">Back <span class="glyphicon glyphicon-chevron-left"></span></button></a>
  <form action="logout.php" method="post">
<button type="submit" class="btn btn-warning" style="position:relative;left:90%;bottom:10px">Log Out <span class="glyphicon glyphicon-off"></span></button>
</form>
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
					</div>
				</div>
			</div>
		</div>
<?php
if(isset($_POST['submitsearch']))
{
	$select=$_POST['searchcategory'];
	if((!empty($_POST['search']) || ($select!="--Select Category--")) || isset($_POST['radio']))
	{
		$con=mysqli_connect('localhost','root');
		mysqli_select_db($con,'assignment');
		if((!empty($_POST['search'])) && (!isset($_POST['radio'])) && ($select =="--Select Category--"))
		{
			$search=$_POST['search'];
			$q="select * from item where i_id='$search' or title='$search' or brand='$search'";
		}
		else if((empty($_POST['search']) && (!isset($_POST['radio']))) && ($select !="--Select Category--"))
		{
			$q="select * from item where category='$select'";
		}
		else if((empty($_POST['search']) && (isset($_POST['radio']))) && ($select =="--Select Category--"))
		{
			$radio=$_POST['radio'];
			if($radio=="Coming Soon")
				$q="select * from item where start_date > curdate() order by start_date";
			else if($radio=="Ending Soon")
				$q="select * from item where end_date > curdate() order by end_date";
			else if($radio=="Lowest First")
				$q="select * from item  order by min_bid_price";
			else if($radio=="Highest First")
				$q="select * from item  order by min_bid_price desc";
		}
		else if((!empty($_POST['search']) && (isset($_POST['radio']))) && ($select =="--Select Category--"))
		{
			$search=$_POST['search'];
			$radio=$_POST['radio'];
			if($radio=="Coming Soon")
			 $q="select * from item where i_id=('$search') or title=('$search') or brand=('$search') and start_date > curdate() order by start_date";
			else if($radio=="Ending Soon")
				$q="select * from item where i_id=('$search') or title=('$search') or brand=('$search') and  end_date > curdate() order by end_date";
			else if($radio=="Lowest First")
				$q="select * from item where i_id=('$search') or title=('$search') or brand=('$search') and  order by min_bid_price";
			else if($radio=="Highest First")
				$q="select * from item where i_id=('$search') or title=('$search') or brand=('$search') and  order by min_bid_price desc";
		}
		else if((!empty($_POST['search']) && (!isset($_POST['radio']))) && ($select !="--Select Category--"))
		{
			$search=$_POST['search'];
			$q="select * from item where i_id=('$search') or title=('$search') or brand=('$search') and category='$select'";
		}
		else if((empty($_POST['search']) && (isset($_POST['radio']))) && ($select !="--Select Category--"))
		{
			$radio=$_POST['radio'];
			if($radio=="Coming Soon")
			 $q="select * from item where category='$select' and start_date > curdate() order by start_date";
			else if($radio=="Ending Soon")
				$q="select * from item where category='$select' and  end_date > curdate() order by end_date";
			else if($radio=="Lowest First")
				$q="select * from item where category='$select' order by min_bid_price";
			else if($radio=="Highest First")
				$q="select * from item where category='$select' order by min_bid_price desc";
		}
		else if((!empty($_POST['search']) && (isset($_POST['radio']))) && ($select !="--Select Category--"))
		{
			$search=$_POST['search'];
			$radio=$_POST['radio'];
			if($radio=="Coming Soon")
			 $q="select * from item where ((i_id='$search' or title='$search' or brand='$search') and category='$select') and  start_date > curdate() order by start_date";
			else if($radio=="Ending Soon")
				$q="select * from item where ((i_id='$search' or title='$search' or brand='$search') and category='$select') and  end_date > curdate() order by end_date";
			else if($radio=="Lowest First")
				$q="select * from item where ((i_id='$search' or title='$search' or brand='$search') and category='$select')  order by min_bid_price";
			else if($radio=="Highest First")
				$q="select * from item where ((i_id='$search' or title='$search' or brand='$search') and category='$select')  order by min_bid_price desc";
		}
		else
		{
			$_SESSION['invalidsearch']="invalidsearch";
			header('location:main.php');
		}
			$result=mysqli_query($con,$q);
			$num=mysqli_num_rows($result);
			?>
			<marquee><span class="badge">bid</span> Every bid is of 30 Rs. </marquee>
			<hr/>
			<br/><br/><br/>
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
						<th>Leading Bidder</th>
						<th>Seller Id</th>
					</thead>
					<tbody>
		<?php
			for($i=0;$i<$num;$i++)
			{
				$row=mysqli_fetch_array($result);
				$id=$row['i_id'];
				$cbi=$row['curr_bidder_id'];
				$j=0;
				if($cbi!=0)
				{
					$j=1;
				$qnew="select name from bidder where b_id=$cbi";
				$resnew=mysqli_query($con,$qnew);
				$rownew=mysqli_fetch_array($resnew);
				}
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
				<?php if($j==1) { ?>
				<td><?php echo $rownew['name']; ?> </td> <?php }
					else {  ?>
					<td><?php echo "Not Bidded";  ?> </td> <?php } ?>
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
				 <?php 
				if(isset($_SESSION['usernameb']))
				{
					$que="select status from item where i_id=$id";
					$resu=mysqli_query($con,$que);
					$resul=mysqli_fetch_array($resu);
					if($resul['status']=="Available")
					{
					?>
					<td>
					<form action="bid.php" method="post">
					<input type="hidden" name="iid" value="<?php echo $row['i_id'] ;?>"/>
					<button class="btn btn-success" name="submitbid">BID</button>
					</form>
					</td>
					<?php
					}
				}
				else if(isset($_SESSION['usernames']))
				{
					?>
					<td>
					Sorry Log in as a bidder to bid any item
					</td>
					<?php
				}
				?>
				</tr>
	<?php   }   
		?>
		</tbody>
		</table>
		</div>
		<?php
		mysqli_close($con);
	}
	else
	{
		$_SESSION['search']="invalidsearch";
		header('location:main.php');
	}?>
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
	<script src="search.js"></script>
</body>
</html>
<?php
}
else
{
	header('location:main.php');
}
?>