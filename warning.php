<?php
session_start();
include "classes/class.phpmailer.php";
if(isset($_POST['warningitem']))
{
	$id=$_POST['idi'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q="update item set warning='sent' where i_id=$id";
	mysqli_query($con,$q);
	$q1="select title,s_id from item where i_id=$id";
	$res1=mysqli_query($con,$q1);
	$row1=mysqli_fetch_array($res1);
	$sid=$row1['s_id'];
	$q2="select email from seller where s_id=$sid";
	$res2=mysqli_query($con,$q2);
	$row2=mysqli_fetch_array($res2);
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug=1;
	$mail->SMTPAuth=true;
	$mail->SMTPSecure='ssl';
	$mail->Host="smtp.gmail.com";
	$mail->Port=465;
	$mail->IsHTML(true);
	$mail->Username="doorstepauction@gmail.com";
	$mail->Password="Alig_123";
	$mail->SetFrom("doorstepauction@gmail.com");
	$mail->Body='Hey, there is something wrong with your product having is <b><i>'.$id.'</i></b> and name <b><i>'.$row1['title'].'</i></b> sort it out as early as possible otherwise product will be deleted.';
		$mail->Subject="DoorStep auction notification";
		$mail->AddAddress($row2['email']);
		if(!$mail->Send())
		{
			$_SESSION['notdone']=$mail->ErrorInfo;
			header('location:admin.php');
		}
		else
		{
			$_SESSION['done']="done";
			header('location:admin.php');
		}
}
else if(isset($_POST['warningseller']))
{
	$id=$_POST['sdi'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q="update seller set warning='sent' where s_id=$id";
	mysqli_query($con,$q);
	$q1="select name,email from seller where s_id=$id";
	$res1=mysqli_query($con,$q1);
	$row1=mysqli_fetch_array($res1);
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug=1;
	$mail->SMTPAuth=true;
	$mail->SMTPSecure='ssl';
	$mail->Host="smtp.gmail.com";
	$mail->Port=465;
	$mail->IsHTML(true);
	$mail->Username="doorstepauction@gmail.com";
	$mail->Password="Alig_123";
	$mail->SetFrom("doorstepauction@gmail.com");
	$mail->Body='Hey,<b><i> '.$row1['name'].'</b></i> there is something wrong with your profile sort it out as early as possible otherwise your profile along with all your products will be deleted.';
		$mail->Subject="DoorStep auction notification";
		$mail->AddAddress($row1['email']);
		if(!$mail->Send())
		{
			$_SESSION['notdone']=$mail->ErrorInfo;
			header('location:admin.php');
		}
		else
		{
			$_SESSION['done']="done";
			header('location:admin.php');
		}
}
else if(isset($_POST['warningbidder']))
{
	$id=$_POST['bdi'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q="update bidder set warning='sent' where b_id=$id";
	mysqli_query($con,$q);
	$q1="select name,email from bidder where b_id=$id";
	$res1=mysqli_query($con,$q1);
	$row1=mysqli_fetch_array($res1);
	$mail=new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug=1;
	$mail->SMTPAuth=true;
	$mail->SMTPSecure='ssl';
	$mail->Host="smtp.gmail.com";
	$mail->Port=465;
	$mail->IsHTML(true);
	$mail->Username="doorstepauction@gmail.com";
	$mail->Password="Alig_123";
	$mail->SetFrom("doorstepauction@gmail.com");
	$mail->Body='Hey,<b><i> '.$row1['name'].'</b></i> there is something wrong with your profile sort it out as early as possible otherwise your profile along with all your bids will be deleted.';
		$mail->Subject="DoorStep auction notification";
		$mail->AddAddress($row1['email']);
		if(!$mail->Send())
		{
			$_SESSION['notdone']=$mail->ErrorInfo;
			header('location:admin.php');
		}
		else
		{
			$_SESSION['done']="done";
			header('location:admin.php');
		}
}
else
	header('location:admin.php');
?>