<?php
session_start();
if(isset($_POST['submitp']))
{
$username=$_SESSION['usernames'];
$title=$_POST['title'];
$description=$_POST['description'];
$category=$_POST['category'];
$brand=$_POST['Brand'];
$buy_it_now=$_POST['buy_it_now'];
$min_bid=$_POST['min_bid'];
$s_date=$_POST['s_date'];
$e_date=$_POST['e_date'];
$file1=$_FILES['image1']['name'];
$file2=$_FILES['image2']['name'];
$file3=$_FILES['image3']['name'];
$size1=$_FILES['image1']['size'];
$size2=$_FILES['image2']['size'];
$size3=$_FILES['image3']['size'];
$target1="product_images/". basename($_FILES['image1']['name']);
$target2="product_images/". basename($_FILES['image2']['name']);
$target3="product_images/". basename($_FILES['image3']['name']);
$image_size1=getimagesize($_FILES['image1']['tmp_name']);
$image_size2=getimagesize($_FILES['image2']['tmp_name']);
$image_size3=getimagesize($_FILES['image3']['tmp_name']);
if(($image_size1==FALSE || $image_size2==FALSE) || $image_size3==FALSE)
{
	$_SESSION['notimage']="not image";
	header('location:main.php');
}
else if(($size1 > (1024000) || $size2 > (1024000)) || $size3 > (1024000))
{
	$_SESSION['largesize']="large size";
	header('location:main.php');
}
else
{
$con=mysqli_connect('localhost','root');
mysqli_select_db($con,'assignment');
$q2="select s_id from seller where username='$username'";
$r=mysqli_query($con,$q2);
$row=mysqli_fetch_array($r);
$s_id=$row['s_id'];
$q1="insert into item (title,category,buy_now_price,min_bid_price,brand,start_date,end_date,curr_bid_price,status,description,s_id,image1,image2,image3,curr_bidder_id)  values('$title','$category',$buy_it_now,$min_bid,'$brand','$s_date','$e_date',$min_bid,'Not Available','$description',$s_id,'$file1','$file2','$file3',00)";
$res=mysqli_query($con,$q1);
move_uploaded_file($_FILES['image1']['tmp_name'],$target1);
move_uploaded_file($_FILES['image2']['tmp_name'],$target2);
move_uploaded_file($_FILES['image3']['tmp_name'],$target3);
header('location:main.php');
mysqli_close($con);
}
}
else
	header('location:home.php');
?>