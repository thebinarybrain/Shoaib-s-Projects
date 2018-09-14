<?php
session_start();
if(isset($_POST['submits']))
{
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$names=$_POST['names'];
	$usernames=$_POST['usernames'];
	$passwords=$_POST['passwords'];
	$emails=$_POST['emails'];
	$mobilenos=$_POST['mobilenos'];
	$q1="select s_id from seller where username='$usernames'";
	$q23="select s_id from seller where email='$emails'";
	$result=mysqli_query($con,$q1);
	$result2=mysqli_query($con,$q23);
	$num=mysqli_num_rows($result);
	$num2=mysqli_num_rows($result2);
	if($num!=0 || $num2!=0)
	{	
		mysqli_close($con);
		$_SESSION['alreadyexists']="already";
		header('location:home.php');
	}
	else
	{
		$q2="insert into seller(name,username,password,email,phone_no) values('$names','$usernames','$passwords','$emails','$mobilenos')";
		mysqli_query($con,$q2);
		mysqli_close($con);
		header('location:home.php');
	}
}
else if(isset($_POST['submitb']))
{
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$nameb=$_POST['nameb'];
	$usernameb=$_POST['usernameb'];
	$passwordb=$_POST['passwordb'];
	$emailb=$_POST['emailb'];
	$mobilenob=$_POST['mobilenob'];
	$q1="select b_id from bidder where username='$usernameb'";
	$result=mysqli_query($con,$q1);
	$num=mysqli_num_rows($result);
	$q23="select b_id from bidder where email='$emailb'";
	$result2=mysqli_query($con,$q23);
	$num2=mysqli_num_rows($result2);
	if($num!=0 || $num2!=0)
	{	
		mysqli_close($con);
		$_SESSION['alreadyexists']="already";
		header('location:home.php');
	}
	else
	{
		$q2="insert into bidder(name,username,password,email,phone_no) values('$nameb','$usernameb','$passwordb','$emailb','$mobilenob')";
		mysqli_query($con,$q2);
		mysqli_close($con);
	header('location:home.php');
	}
}
else if(isset($_POST['loginsubmitb']))
{
	$username=$_POST['loginusernameb'];
	$password=$_POST['loginpasswordb'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q="select username,password from bidder where username='$username' and password='$password'";
	$result=mysqli_query($con,$q);
	$num=mysqli_num_rows($result);
	echo $num;
	if($num==1)
	{
		$_SESSION['usernameb']=$username;
		header('location:main.php');
	}
	else
	{
		$_SESSION['incorrectb']="incorrect";
			header('location:home.php');
	}
}
else if(isset($_POST['loginsubmits']))
{
	$username=$_POST['loginusernames'];
	$password=$_POST['loginpasswords'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q="select username,password from seller where username='$username' and password='$password'";
	$result=mysqli_query($con,$q);
	$num=mysqli_num_rows($result);
	echo $num;
	if($num==1)
	{
		$_SESSION['usernames']=$username;
		header('location:main.php');
	}
	else
	{
		$_SESSION['incorrects']="incorrect";
			header('location:home.php');
	}
}
else
	header('location:home.php')
	?>