<?php
if(isset($_POST['bdi']))
{
$bdi=$_POST['bdi'];
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'assignment');
$q="delete from bidder where b_id=$bdi";
$qu="delete from bidder_item where b_id=$bdi";
$que="update item set curr_bidder_id=0 where curr_bidder_id=$bdi";
$query="delete from rating where b_id=$bdi";
mysqli_query($con,$query);
mysqli_query($con,$qu);
mysqli_query($con,$que);
mysqli_query($con,$q);
mysqli_close($con);
header('location:admin.php');
}
else
	header('location:admin.php');
?>