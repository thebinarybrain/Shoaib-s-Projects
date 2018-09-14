<!DOCTYPE html>
<?php
session_start();
$page = $_SERVER['PHP_SELF'];
$sec = "60";
header("Refresh: $sec; url=$page");
if(isset($_SESSION['notimage']))
{
	unset($_SESSION['notimage']);
	?><script>
	alert("Sorry not an image");
	</script>
	<?php
}
if(isset($_SESSION['largesize']))
{
	unset($_SESSION['largesize']);
	?><script>
	alert("Sorry your image should not exceed 1 mb");
	</script>
	<?php
}
if(isset($_SESSION['usernames']) || isset($_SESSION['usernameb']))
{
	if(isset($_SESSION['search']))
	{
		?><script> alert("Do select an option to make search"); </script>
		<?php
		unset($_SESSION['search']);
	}
	if(isset($_SESSION['notifi']))
	{
		?><script> var x=<?php echo $_SESSION['notifi']; ?>; alert(x); </script>
		<?php
		unset($_SESSION['notifi']);
	}
	if(isset($_SESSION['notifi1']))
	{
		?><script> var x=<?php echo $_SESSION['notifi']; ?>; alert(x); </script>
		<?php
		unset($_SESSION['notifi1']);
	}
	if(isset($_SESSION['invalidsearch']))
	{
		?><script> alert("Do select an appropriate option to make search"); </script>
		<?php
		unset($_SESSION['invalidsearch']);
	}
	$con1=mysqli_connect('localhost','root');
	mysqli_select_db($con1,'assignment');
	$q1="select i_id from item where start_date <= curdate() and end_date >= curdate()";
	$qsend="select * from item where status='Expired' and mail_status!='send'";
	$ressend=mysqli_query($con1,$qsend);
	$numsend=mysqli_num_rows($ressend);
	if($numsend>0)
		header('location:sendnotifications.php');
	$res1=mysqli_query($con1,$q1);
	$nu=mysqli_num_rows($res1);
	for($i=0;$i<$nu;$i++)
	{
		$row=mysqli_fetch_array($res1);
		$iid=$row['i_id'];
		$q3="update item set status='Available' where i_id='$iid'";
		mysqli_query($con1,$q3);
	}
	$q11="select i_id from item where end_date < curdate()";
	$res2=mysqli_query($con1,$q11);
	$num=mysqli_num_rows($res2);
	for($i=0;$i<$num;$i++)
	{
		$row=mysqli_fetch_array($res2);
		$iid=$row['i_id'];
		$q3="update item set status='Expired' where i_id='$iid'";
		mysqli_query($con1,$q3);
	}
	mysqli_close($con1);
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DoorStep Auction</title>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link rel="SHORTCUT ICON" href="mini_project_images/Auction.jpg"/>
<link href="main.css" rel="stylesheet"/>
<style>
#imain
{
	border-radius:10px;
	border-color:grey;
	border-style:solid;	
	height:350px;
	width:100%;
}
</style>
</head>
<body style="background-color:#FFEFD5">
<div class="container">
<form action="logout.php" method="post">
<button type="submit" class="btn btn-warning" style="position:relative;left:3%;top:10px">Log Out <span class="glyphicon glyphicon-off"></span></button>
</form>
<?php 
if(isset($_SESSION['usernames']))
{?>
<button style="position:relative;left:80%;bottom:20px" class="btn btn-primary" data-target="#post " data-toggle="modal">POST PRODUCT <span class="glyphicon glyphicon-upload"></button>
<div class="modal" id="post" tabindex="-1" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close pull-right" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Post Product ( <?php  echo $_SESSION['usernames']; ?> ) </h4>
			</div>
			<div class="modal-body">
				<form action="uploadproduct.php" method="post" onsubmit="return validate()" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title">Title</label>
							<input type="text" required name="title"  placeholder="Title" id="title" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="image1">Image ( Front View )</label>
							<input type="file" required name="image1" id="image1" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="image2">Image ( Rear View )</label>
							<input type="file" required name="image2" id="image2" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="image3">Image ( Side View )</label>
							<input type="file" required name="image3" id="image3" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="category">Category</label>
						<select class="form-control" name="category" id="category" required>
							<option>--Select Category--</option>
							<option>Books</option>
							<option>Electronics</option>
							<option>Clothing</option>
							<option>Sporting Goods</option>
							<option>Others</option>
						</select>
					</div>
					<div class="form-group">
						<label for="Brand">Brand/Author</label>
						<input type="text" name="Brand" required placeholder="Brand/Author (in case of book)" id="Brand" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<input type="text" required name="description"  placeholder="upto 30 words" id="description" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="buy_it_now">Buy it Now Price(in Rs.)</label>
						<input type="number" required name="buy_it_now" placeholder="price at which item to be sold at once" id="buy_it_now" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="min_bid">Min Price(in Rs.)</label>
						<input type="number" required name="min_bid" placeholder="price at which bidding start" id="min_bid" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="s_date">Start Date</label>
						<input type="date" name="s_date" required placeholder="starting date of bidding" id="s_date" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="e_date">End Date</label>
						<input type="date" name="e_date" required placeholder="ending date of bidding" id="e_date" class="form-control"/>
					</div>
					<button type="submit" name="submitp" class="btn btn-success">Post</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php } ?>
	<div class="container">
		<div style="margin:20px" class="row">
			<div class="col-xs-2">
				<img src="mini_project_images/auction.jpg" style="height:100px;width:150px;border-radius:8px" class="img-responsive"/>
				<b style="border-radius:8px;margin:5px;padding:5px" class="thumbnail">DoorStep Auction</b>
			</div>
			<div style="margin-top:20px" class="col-xs-offset-1 col-xs-9">
				<form class="form-inline" method="post" action="search.php">
					<div class="form-group">
						<input type="text" placeholder="Search by Item no, Item name or Brand name" class="form-control" id="search" style="width:100%" name="search"/><br/><br/>
						<Select class="form-control" name="searchcategory">
							<option>--Select Category--</option>
							<option>Books</option>
							<option>Electronics</option>
							<option>Clothing</option>
							<option>Sporting Goods</option>
							<option>Others</option>
						</select>
						<div class="radio">
							<label>
								<input type="radio" name="radio" value="Coming Soon"/>Coming Soon
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="radio" value="Ending Soon"/>Ending Soon
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="radio" value="Lowest First"/>Lowest First
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="radio" value="Highest First"/>Highest First
							</label>
						</div>
						<button style="position:relative;left:10px" type="submit" name="submitsearch" class="btn btn-success pull-right"> Search <span class="glyphicon glyphicon-search"></span></button>
					</div>	
				</form>
			</div>
		</div>
		<div style="margin-top:30px;border-radius:10px" class="row">
			<div class="col-xs-12">
			<?php
			$con=mysqli_connect('localhost','root');
			mysqli_select_db($con,'assignment');
			$q="select title,start_date,brand from item where start_date > curdate() order by start_date";
			$result=mysqli_query($con,$q);
			$row=mysqli_fetch_array($result);
			?><marquee behavior="alternate" direction="left" style="color:#008B8B;font-size:11"><img src="mini_project_images/NewBlink.gif"/> <?php echo "<span class='label label-danger'> Hurry up!! </span>  Auction for a ".$row['title']." of brand ".$row['brand']." is coming on ".$row['start_date']." date.";?></marquee>
			<?php $row=mysqli_fetch_array($result);?>
			<marquee behavior="alternate" direction="right" style="color:#20B2AA;font-size:11"><img src="mini_project_images/NewBlink.gif"/><?php echo "<span class='label label-primary'> Hurry up!! </span>  Auction for a ".$row['title']." of brand ".$row['brand']." is coming on ".$row['start_date']." date.";?></marquee>
			<?php mysqli_close($con); ?>
				<img src="1.jpg" class="img-rounded" id="imain"/>
				<b id="carouselthumbnail" style="margin-top:5px;padding:10px;text-align:center" class="thumbnail">SMART REFRIGERATOR IT CAN BE YOURS ON A SINGLE CLICK</b>
			</div>
			</div>
		</div>
		<div style="margin-top:30px;margin-bottom:30px" class="row">
			<div class="col-xs-12">
				<ul class="nav nav-tabs nav-justified">
					<li class="active"><a href="#user" data-toggle="tab">Hello! <?php 
					if (isset($_SESSION['usernames'])) 
					{
						echo $_SESSION['usernames'];
					}
					else if(isset($_SESSION['usernameb']))
					{
						echo $_SESSION['usernameb'];
					}?>
					</a></li>
					<li><a href="#not" data-toggle="tab">Notifications</a></li>
					<li><a href="#vp" data-toggle="tab">View all Products</a></li>
					<?php 
					if(isset($_SESSION['usernames'])) 
					{
						?><li><a href="#vbs" data-toggle="tab">View bidder details</a></li><?php
					}
					else if(isset($_SESSION['usernameb']))
					{
						?><li><a href="#vbs" data-toggle="tab">View seller details</a></li><?php
					}?>
					<li><a href="#feed" data-toggle="tab">Feedback</a></li>
				</ul>
				<div class="tab-content">
					<div id="user" class="tab-pane active"><br/>
					<div class="h4">You have Logged in as a <?php if(isset($_SESSION['usernames'])) echo "Seller";
					else if(isset($_SESSION['usernameb'])) echo "Bidder" ; ?> </div>
					<br/><div class="h3"> Your Personal Information is: </div><hr/><br/>
					<div class="table-responsive">
					<table class="table table-striped table-hover">
					<thead>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Phone No.</th>
					</thead>
					<tbody>
					<?php if(isset($_SESSION['usernames']))
					{
						$username=$_SESSION['usernames'];
						$con=mysqli_connect('localhost','root');
						mysqli_select_db($con,'assignment');
						$q="select * from seller where username='$username'";
						$result=mysqli_query($con,$q);
						$num=mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$row=mysqli_fetch_array($result);
							?><tr class="success">
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['username']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['phone_no']; ?></td>
							</tr>
					<?php	}
						?></tbody>
					</table>
					</div><br/><br/><center><i><div class="h4"><?php
					echo "Now you can post your own product to open auction and set its start and end date. You can provide feedback to your bidder and you also have options to show all details of your products and your bidders. Notifications will also be provided to you regarding your items and feedback under respective tabs.";
					?></div></i></center><?php } ?>
					<?php 
					if(isset($_SESSION['usernameb']))
					{
						$username=$_SESSION['usernameb'];
						$con=mysqli_connect('localhost','root');
						mysqli_select_db($con,'assignment');
						$q="select * from bidder where username='$username'";
						$result=mysqli_query($con,$q);
						$num=mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$row=mysqli_fetch_array($result);
							?><tr class="success">
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['username']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['phone_no']; ?></td>
							</tr>
					<?php	}
						?></tbody>
					</table>
					</div><br/><br/><center><i><div class="h4"><?php
					echo "Now you can Bid on any product provided that the product is available. You can provide feedback to your seller and you also have options to show all details of your products and your sellers. Notifications will also be provided to you regarding your items and feedback under respective tabs.";
					?></div></i></center><?php } ?>
					</div>
					<div id="not" class="tab-pane">
						<hr/>
						<br/><br/><br/>
					<?php 
					if(isset($_SESSION['usernames']))
					{
						$username=$_SESSION['usernames'];
						$c=mysqli_connect('localhost','root');
						mysqli_select_db($c,'assignment');
						$query="select status,title,curr_bidder_id from item where s_id in (select s_id from seller where username='$username')";
						$q00="select rating,comments,b_id from rating where who='bidder' and s_id in (select s_id from seller where username='$username')";
						$out1=mysqli_query($c,$q00);
						$out=mysqli_query($c,$query);
						$count1=mysqli_num_rows($out1);
						$count=mysqli_num_rows($out);?>
						<ul class="list-group"><?php
						for($i=0;$i<$count1;$i++)
						{
							$rowout1=mysqli_fetch_array($out1);
							?><li class="list-group-item-info"><?php echo "Bidder having id ".$rowout1['b_id']." says <b><i>".$rowout1['comments']."</i></b> about your product and provide <b><i>".$rowout1['rating']."</b></i> rating.";?></li><br/><br/>
							<?php
						}
						for($i=0;$i<$count;$i++)
						{
							$rowout=mysqli_fetch_array($out);
							if($rowout['status']=='Available')
							{
								?>
								<li class="list-group-item-warning"><?php echo "Your Product ".$rowout['title']." is available currently for bidding."; ?> </li><br/><br/>
					<?php	}
							else if($rowout['status']=='Not Available')
							{
								?>
								<li class="list-group-item-danger"><?php echo "Your Product ".$rowout['title']." is currently not available for bidding."; ?> </li><br/><br/>
					<?php	}
							if($rowout['curr_bidder_id']!=0)
							{
								?>
								<li class="list-group-item-info"><?php echo "Bidder having id ".$rowout['curr_bidder_id']." is the leading bidder on your item ".$rowout['title']."."; ?> </li><br/><br/>
					<?php	}
							if($rowout['status']=='Expired')
							{
								?>
								<li class="list-group-item-success"><?php echo "your item ".$rowout['title']." has been expired and "; 
								if($rowout['curr_bidder_id']!=0)
									echo "is sold to bidder having id ".$rowout['curr_bidder_id'].".";
								else
									echo "is not sold.";
									?> </li><br/><br/>
					<?php	}
						}?>
						</ul><?php mysqli_close($c);
					 }
					else if(isset($_SESSION['usernameb']))
					{
						$username=$_SESSION['usernameb'];
						$c=mysqli_connect('localhost','root');
						mysqli_select_db($c,'assignment');
						$query="select curr_bidder_id,i_id from item where curr_bidder_id in (select b_id from bidder where username='$username')";
						$q00="select rating,comments,s_id from rating where who='seller' and b_id in (select b_id from bidder where username='$username')";
						$qu="select i_id from item where i_id in (select i_id from bidder_item where b_id in (select b_id from bidder where username='$username')) and curr_bidder_id not in (select b_id from bidder where username='$username')";
						$que="select i_id from item where i_id in (select i_id from bidder_item where b_id in (select b_id from bidder where username='$username')) and curr_bidder_id not in (select b_id from bidder where username='$username') and end_date < curdate()";
						$qw="select i_id from item where curr_bidder_id in (select b_id from bidder where username='$username') and end_date < curdate()";
						$resul=mysqli_query($c,$qu);
						$nor=mysqli_num_rows($resul);
						$not=mysqli_query($c,$query);
						$numr=mysqli_num_rows($not);
						$rl=mysqli_query($c,$que);
						$nm=mysqli_num_rows($rl);
						$qwi=mysqli_query($c,$qw);
						$n_um=mysqli_num_rows($qwi);
						?><ul class="list-group"><?php
						for($i=0;$i<$n_um && $i<5;$i++)
						{
							$rowi=mysqli_fetch_array($qwi);
							?><li class="list-group-item-success"><?php echo "You have won bid on item having id ".$rowi['i_id']." get your seller's details.";?></li><br/><br/><?php
						}
						for($i=0;$i<$nm && $i<5;$i++)
						{
							$row=mysqli_fetch_array($rl);
							?><li class="list-group-item-danger"><?php echo "You have lost bid on item having id ".$row['i_id'].".";?></li><br/><br/><?php
						}
						for($i=0;$i<$numr && $i<5;$i++)
						{
							$array=mysqli_fetch_array($not);
							?><li class="list-group-item-success"><?php echo "You are leading bid on the item having id ".$array['i_id']."."; ?></li><br/><br/> <?php
						}
						for($i=0;$i<$nor && $i<5;$i++)
						{
							$srow=mysqli_fetch_array($resul);
							?><li class="list-group-item-warning"><?php echo "Someone has crossed your bid on item having id ".$srow['i_id'].".";?></li><br/><br/>
					<?php	}
						$out1=mysqli_query($c,$q00);
						$count1=mysqli_num_rows($out1);
						for($i=0;$i<$count1;$i++)
						{
							$a=mysqli_fetch_array($out1);
							?><li class="list-group-item-danger"><?php echo "Seller having id<b><i> ".$a['s_id']."</b></i> says <b><i>".$a['comments']."</b> </i>about you and has given you <b><i>".$a['rating']."</b></i> rating." ;?></li><br/><br/><?php
						}
						?></ul><?php
					}?>
					</div>
					<div id="vp" class="tab-pane">
					<?php 
					if(isset($_SESSION['usernames']))
					{
						$username=$_SESSION['usernames'];
					$con=mysqli_connect('localhost','root');
					mysqli_select_db($con,'assignment');
					$q="select * from item where s_id in (select s_id from seller where username='$username')  and status!='Expired'";
					$result=mysqli_query($con,$q);
					$num=mysqli_num_rows($result);
					?>
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
					</thead>
					<tbody>
		<?php
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
				</tr>
				<tr>
				<td><div style="height:150px;width:150px">
					<?php echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image1']."'/>";?>
				</div></td>
				<td><div style="height:150px;width:150px">
				<?php	echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image2']."'/>";?>
				</div></td>
				<td><div style="height:150px;width:150px">
				<?php	echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image3']."'/>"; ?>
				</div></td>
				</tr>
	<?php   }   
		?>
		</tbody>
		</table>
		</div>
		<?php
		mysqli_close($con);
					}
		else if(isset($_SESSION['usernameb']))
					{
						$username=$_SESSION['usernameb'];
					$con=mysqli_connect('localhost','root');
					mysqli_select_db($con,'assignment');
					$q="select * from item where i_id in (select i_id from bidder_item where b_id in (select b_id from bidder where username='$username')) and status!='Expired'";
					$result=mysqli_query($con,$q);
					$num=mysqli_num_rows($result);
					?>
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
						<th>Leading bidder</th>
						<th>Description</th>
					</thead>
					<tbody>
		<?php
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
				<?php $q0="select username from bidder where b_id in (select curr_bidder_id from item where i_id='$id')";
				$res=mysqli_query($con,$q0);
				$ro=mysqli_fetch_array($res); ?>
				<td><?php echo $ro['username']; ?> </td>
				<td><?php echo $row['description']; ?> </td>
				</tr>
				<tr>
				<td><div style="height:150px;width:150px">
					<?php echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image1']."'/>";?>
				</div></td>
				<td><div style="height:150px;width:150px">
				<?php	echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image2']."'/>";?>
				</div></td>
				<td><div style="height:150px;width:150px">
				<?php	echo "<img style='height:150px;width:150px' class='img-responsive' src='product_images/".$row['image3']."'/>"; ?>
				</div></td>
				</tr>
	<?php   }   
		?>
		</tbody>
		</table>
		</div>
		<?php
		mysqli_close($con);
					}
		?>
					</div>
					<div id="vbs" class="tab-pane">
							<?php
					if(isset($_SESSION['usernames']))
					{
						$username=$_SESSION['usernames'];
						$con=mysqli_connect('localhost','root');
						mysqli_select_db($con,'assignment');
						$qq="select * from bidder where b_id in (select b_id from bidder_item where i_id in (select i_id from item where s_id in (select s_id from seller where username='$username')))";
						$r1=mysqli_query($con,$qq);
						$nums=mysqli_num_rows($r1);?>
						<hr/>
			<br/><br/><br/>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<th>Item Id</th>
						<th>Bidder Id</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Phone No.</th>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<$nums;$i++)
						{
						$rowss=mysqli_fetch_array($r1);
						$bidid=$rowss['b_id'];
						$que="select i_id from bidder_item where b_id=$bidid";
						$id=mysqli_query($con,$que);
						$itemid=mysqli_fetch_array($id);?>
						<tr>
						<td><?php echo $itemid['i_id']; ?> </td>
						<td><?php echo $rowss['b_id']; ?> </td>
						<td><?php echo $rowss['name']; ?> </td>
						<td><?php echo $rowss['username']; ?> </td>
						<td><?php echo $rowss['email']; ?> </td>
						<td><?php echo $rowss['phone_no']; ?> </td>
						</tr>
						<?php }
					?>
					</tbody>
				</table>
			</div>
			<?php mysqli_close($con);
					} 
					else if(isset($_SESSION['usernameb']))
					{
						$username=$_SESSION['usernameb'];
						$con=mysqli_connect('localhost','root');
						mysqli_select_db($con,'assignment');
						$qq="select * from seller where s_id in (select s_id from item where i_id in (select i_id from bidder_item where b_id in (select b_id from bidder where username='$username')))";
						$r1=mysqli_query($con,$qq);
						$nums=mysqli_num_rows($r1);?>
						<hr/>
			<br/><br/><br/>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<th>Item Id</th>
						<th>Seller Id</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Phone No.</th>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<$nums;$i++)
						{
						$rowss=mysqli_fetch_array($r1);
						$sidid=$rowss['s_id'];
						$que="select i_id from item where s_id=$sidid";
						$id=mysqli_query($con,$que);
						$itemid=mysqli_fetch_array($id);?>
						<tr>
						<td><?php echo $itemid['i_id']; ?> </td>
						<td><?php echo $rowss['s_id']; ?> </td>
						<td><?php echo $rowss['name']; ?> </td>
						<td><?php echo $rowss['username']; ?> </td>
						<td><?php echo $rowss['email']; ?> </td>
						<td><?php echo $rowss['phone_no']; ?> </td>
						</tr>
						<?php }
					?>
					</tbody>
				</table>
			</div>
			<?php mysqli_close($con);
					} ?>
					</div>
					<div id="feed" class="tab-pane">
					<div style="margin-top:50px" class="row">
						<div class="col-xs-offset-4 col-xs-4">
						<form style="padding:20px;border-radius:10px;background-color:#e9967a" method="post" action="feedback.php">
						<?php 
						if(isset($_SESSION['usernames']))
						{?>
						<h3><?php echo "Hi ".$_SESSION['usernames'];?></h3>
						<div class="form-group">
						<label for="f_b_id">Bidder ID:</label>
						<input type="text" required class="form-control" name="f_b_id" id="f_b_id"/>
						</div>
						<?php
						}
						else if(isset($_SESSION['usernameb']))
						{?>
						<h3><?php echo "Hi ".$_SESSION['usernameb'];?></h3>
						<div class="form-group">
						<label for="f_s_id">Seller ID:</label>
						<input type="text" required class="form-control" name="f_s_id" id="f_s_id"/>
						</div>
						<?php
						}
						?>
						<div class="form-group">
						<label for="textarea">Feedback</label>
						<textarea class="form-control" required maxlength="100" id="textarea" name="textarea" rows="5" cols="5"></textarea>
						</div>
						<div class="form-group">
						<label> Give your Rating</label>
						<div class="radio">
							<label>
								<input type="radio" required name="rating" value="1"/>Very Bad
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" required  name="rating" value="2"/>Bad
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" required  name="rating" value="3"/>Good
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" required  name="rating" value="4"/>Very Good
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" required  name="rating" value="5"/>Awesome
							</label>
						</div>
						</div>
						<button class="btn btn-success" name="feedbacksubmit" type="submit">Done</button>
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
	<script src="Main.js"></script>
	<script>
	function validate()
	{
		res=true;
		s=new Date(document.getElementById("s_date").value);
		e=new Date(document.getElementById("e_date").value);
		m=document.getElementById("min_bid").value;
		b=document.getElementById("buy_it_now").value;
		d=new Date();
		if(d>s)
		{
			res=false;
			alert("Start date must be greater than current date");
		}
		if(s>e)
		{
			res=false;
			alert("End date can not be greater than start date");
		}
		else if(b<m)
		{
			res=false;
			alert("Minimum bid price should be less than or equal to Buy it now price");
		}
		return res;
	}
	function about()
{
var req=new XMLHttpRequest();
req.open("get","http://localhost/Bootstrap/mini_project/about.php",true);
req.send();
req.onreadystatechange=function(){
	if(req.status==200 && req.readyState==4)
		document.getElementById("l").innerHTML=req.responseText;
};
}
function developer()
{
var req=new XMLHttpRequest();
req.open("get","http://localhost/Bootstrap/mini_project/developer.php",true);
req.send();
req.onreadystatechange=function(){
	if(req.status==200 && req.readyState==4)
		document.getElementById("l").innerHTML=req.responseText;
};
}
function back()
{
var req=new XMLHttpRequest();
req.open("get","http://localhost/Bootstrap/mini_project/back.php",true);
req.send();
req.onreadystatechange=function(){
	if(req.status==200 && req.readyState==4)
		document.getElementById("l").innerHTML=req.responseText;
};
}

	</script>
</body>
</html>
<?php
}
else
	header('location:home.php');
?>