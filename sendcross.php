<?php
session_start();
include "classes/class.phpmailer.php";
$con1=mysqli_connect('localhost','root');
mysqli_select_db($con1,'assignment');
$qsend="select * from item where status='Expired'";
$ressend=mysqli_query($con1,$qsend);
?>