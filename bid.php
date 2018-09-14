<?php
session_start();
include "classes/class.phpmailer.php";
if(!isset($_POST['submitbid']))
{
	header('location:search.php');
}
else
{
	$username=$_SESSION['usernameb'];
	$id=$_POST['iid'];
	$con=mysqli_connect('localhost','root');
	mysqli_select_db($con,'assignment');
	$q1="select b_id from bidder where username='$username'";
	$res=mysqli_query($con,$q1);
	$num=mysqli_num_rows($res);
	if($num==1)
	{
		$row=mysqli_fetch_array($res);
		$bid=$row['b_id'];
		$q3="select curr_bid_price from item where i_id='$id'";
		$r=mysqli_query($con,$q3);
		$rows=mysqli_fetch_array($r);
		$cbp=$rows['curr_bid_price'];
		$nc=($cbp+30);
		$q="insert into bidder_item values($id,$bid)";
		$q2="update item set curr_bid_price=$nc,curr_bidder_id=$bid where i_id=$id";
		$q3="select * from item where i_id=$id and curr_bidder_id!=0";
		$res=mysqli_query($con,$q3);
		$row=mysqli_fetch_array($res);
		$num=mysqli_num_rows($res);
		echo $num;
		if($num>0)
		{
		$bid=$row['curr_bidder_id'];
		$q4="select email from bidder where b_id=$bid";
		$res4=mysqli_query($con,$q4);
		$row4=mysqli_fetch_array($res4);
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
		$mail->Body="Hey your bid on the product having id <b><i>".$row['i_id']." </b></i>and title <b><i>".$row['title']." </b></i>has been crossed by someone for more details log into your doorstep auction portal";
		$mail->Subject="DoorStep auction notifications";
		$mail->AddAddress($row4['email']);
		if(!$mail->Send())
			$_SESSION['notifi1']=$mail->ErrorInfo;
		}
		mysqli_query($con,$q);
		mysqli_query($con,$q2);
		mysqli_close($con);
	}
	header('location:search.php');
}