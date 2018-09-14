<?php
if(isset($_POST['sdi']))
{
$sdi=$_POST['sdi'];
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'assignment');
$q="delete from seller where s_id=$sdi";
$quer="select i_id from item where s_id=$sdi";
$result=mysqli_query($con,$quer);
$num=mysqli_num_rows($result);
for($i=0;$i<$num;$i++)
{
	$row=mysqli_fetch_array($result);
	$r=$row['i_id'];
	$qu="delete from bidder_item where i_id=$r";
	mysqli_query($con,$qu);
}
$que="delete from item where s_id=$sdi";
$query="delete from rating where s_id=$sdi";
mysqli_query($con,$query);
mysqli_query($con,$que);
mysqli_query($con,$q);
mysqli_close($con);
header('location:admin.php');
}
else
	header('location:admin.php');
?>