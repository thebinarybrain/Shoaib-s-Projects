<?php
if(isset($_POST['delete']))
{
$idi=$_POST['idi'];
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'assignment');
$q="delete from item where i_id=$idi";
$que="delete from bidder_item where i_id=$idi"; 
mysqli_query($con,$que);
mysqli_query($con,$q);
mysqli_close($con);
header('location:admin.php');
}
else
	header('location:admin.php');
?>