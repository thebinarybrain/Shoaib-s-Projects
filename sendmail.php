<?php
session_start();
include "classes/class.phpmailer.php";
$email=$_POST['emailfs'];
$mail=new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug=1;
$mail->SMTPAuth=true;
$mail->SMTPSecure='ssl';
$mail->Host="smtp.gmail.com";
$mail->Port=465;
$mail->IsHTML(true);
$mail->Username="doorstepauction@gmail.com";
$mail->Password="Alishoaib";
$mail->SetFrom("doorstepauction@gmail.com");
if(isset($_POST['submitfs']))
{
	$email=$_POST['emailfs'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q="select password,username from seller where email='$email'";
	$result=mysqli_query($con,$q);
	$num=mysqli_num_rows($result);
	if($num==1)
	{
		$row=mysqli_fetch_array($result);
		$mail->Body='Hey, you have just ask to recover your password or username for seller login portal of DoorStep Auction. So your username is <i>'.$row['username'].'</i> and password is <i>'.$row['password'].'</i>';
		$mail->Subject="DoorStep auction password and username recovery mail";
		$mail->AddAddress($_POST['emailfs']);
		if(!$mail->Send())
		{
			$_SESSION['notdone']=$mail->ErrorInfo;
			header('location:home.php');
		}
		else
		{
			$_SESSION['done']="done";
			header('location:home.php');
		}
	}
	else
	{
		$_SESSION['forgotseller']="seller";
		header('location:home.php');
	}
}
else if(isset($_POST['submitfb']))
{
	$email=$_POST['emailfb'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q="select password,username from bidder where email='$email'";
	$result=mysqli_query($con,$q);
	$num=mysqli_num_rows($result);
	if($num==1)
	{
		$row=mysqli_fetch_array($result);
		$mail->Body='Hey, you have just ask to recover your password or username for bidder login portal of DoorStep Auction. So your username is <i>'.$row['username'].'</i> and password is <i>'.$row['password'].'</i>';
		$mail->Subject="DoorStep auction password and username recovery mail";
		$mail->AddAddress($_POST['emailfb']);
		if(!$mail->Send())
		{
			$_SESSION['notdone']=$mail->ErrorInfo;
			header('location:home.php');
		}
		else
		{
			$_SESSION['done']="done";
			header('location:home.php');
		}
	}
	else
	{
		$_SESSION['forgotseller']="seller";
		header('location:home.php');
	}
}
else
	header('location:home.php');
?>