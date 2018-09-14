<?php
session_start();
if(!(isset($_POST['submita'])))
{
	header('location:home.php');
}
else
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q="select * from admin";
	$result=mysqli_query($con,$q);
	$row=mysqli_fetch_array($result);
	if(($row['username']==$username) && ($row['password']==$password))
	{
		$_SESSION['admin']=" ";
		header('location:admin.php');
	}
	else
	{
		$_SESSION['admini']="admin";
		header('location:home.php');
	}

}
