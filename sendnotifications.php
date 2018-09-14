<?php
session_start();
include "classes/class.phpmailer.php";
$con1=mysqli_connect('localhost','root');
mysqli_select_db($con1,'assignment');
$qsend="select * from item where status='Expired'";
$ressend=mysqli_query($con1,$qsend);
$numsend=mysqli_num_rows($ressend);
for($i=0;$i<$numsend;$i++)
	{
		$rowsend=mysqli_fetch_array($ressend);
		$id=$rowsend['i_id'];
		if($rowsend['mail_status']!="send")
		{
		$q3="update item set mail_status='send' where i_id=$id";
		mysqli_query($con1,$q3);
		$bid=$rowsend['curr_bidder_id'];
		$qse="select email,name,b_id from bidder where b_id=$bid";
		$resse=mysqli_query($con1,$qse);
		$rowse=mysqli_fetch_array($resse);
		$sid=$rowsend['s_id'];
		$qsen="select email from seller where s_id=$sid";
		$ressen=mysqli_query($con1,$qsen);
		$rowsen=mysqli_fetch_array($ressen);
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
		$mail->Body="Hey the auction on product having id <i><b> ".$rowsend['i_id']."</b></i> and title <i><b>".$rowsend['title']." </i></b>has been won by you for more details log in to your doorstep portal";
		$mail->Subject="DoorStep auction notifications";
		$mail->AddAddress($rowse['email']);
		if(!$mail->Send())
			$_SESSION['notifi1']=$mail->ErrorInfo;
		if($rowsend['curr_bidder_id']==0)
		{
			$mail->Body="Hey your product having id <i><b> ".$rowsend['i_id']."</b></i> and title <i><b>".$rowsend['title']." </i></b>has been expired and has not been bidded by any bidder for more details log into your doorstep portal";
		}
		else
		{
		$mail->Body="Hey your product having id <i><b> ".$rowsend['i_id']."</b></i> and title <i><b>".$rowsend['title']." </i></b>has been won by<b><i> ".$rowse['name']." </b></i>having id<b><i> ".$rowse['b_id']." </i></b>for more details log in to your doorstep portal";
		}
		$mail->Subject="DoorStep auction notifications";
		$mail->AddAddress($rowsen['email']);
		if(!$mail->Send())
			$_SESSION['notifi']=$mail->ErrorInfo;
		}
	}
	header('location:main.php');
?>