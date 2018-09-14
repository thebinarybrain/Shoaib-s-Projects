<?php
session_start();
if(isset($_POST['feedbacksubmit']))
{
if(isset($_POST['f_b_id']))
$bid=$_POST['f_b_id'];
else if(isset($_POST['f_s_id']))
$sid=$_POST['f_s_id'];
$feedback=$_POST['textarea'];
$rating=$_POST['rating'];
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'assignment');
if(isset($_POST['f_s_id']))
{
$username=$_SESSION['usernameb'];
$q0="select b_id from bidder where username='$username'";
$result=mysqli_query($con,$q0);
$row=mysqli_fetch_array($result);
$b_id=$row['b_id'];
$q="insert into rating values($b_id,$sid,'$rating','$feedback','bidder')";
mysqli_query($con,$q);
mysqli_close($con);
header('location:main.php');
}
else if(isset($_POST['f_b_id']))
{
$username=$_SESSION['usernames'];
$q0="select s_id from seller where username='$username'";
$result=mysqli_query($con,$q0);
$row=mysqli_fetch_array($result);
$s_id=$row['s_id'];
$q="insert into rating values($bid,$s_id,'$rating','$feedback','seller')";
mysqli_query($con,$q);
mysqli_close($con);
header('location:main.php');
}
}
else
	header('location:main.php');
?>