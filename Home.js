function validates()
{
	result=true;
	var pass=document.getElementById("passwords").value;
	var pl=pass.length;
	var passagain=document.getElementById("passwordagains").value;
	var usernames=document.getElementById("usernames").value.length;
	var m_no2=document.getElementById("mobilenos").value.length;
	if(usernames<8 || usernames>12)
	{
		result=false;
		alert("username should contain atleast 8-30 characters");
	}
	if(!(pass===passagain))
	{
		result=false;
		alert("Passwords Mismatch");
	}
	if(pl<6 || pl>12)
	{
		alert("password should contain atleast 6-12 characters");
		result=false;
	}
	if(m_no2<10 || m_no2>13)
	{
		result=false;
		alert("invalid mobile number");
	}
	return result;
}
function validateb()
{
	result=true;
	var pass=document.getElementById("passwordb").value;
	var pl=pass.length;
	var passagain=document.getElementById("passwordagainb").value;
	var usernameb=document.getElementById("usernameb").value.length;
	var m_no=document.getElementById("mobilenob").value.length;
	if(usernameb<8 || usernameb>12)
	{
		result=false;
		alert("username should contain atleast 8-12 characters");
	}
	if(!(pass===passagain))
	{
		result=false;
		alert("Passwords Mismatch");
	}
	if(pl<6 || pl>12)
	{
		alert("password should contain atleast 6-12 characters");
		result=false;
	}
	if(m_no<10 || m_no>13)
	{
		result=false;
		alert("invalid mobile number");
	}
	return result;
}
function about()
{
var req=new XMLHttpRequest();
req.open("get","http://localhost/Bootstrap/mini_project/about.php",true);
req.send();
req.onreadystatechange=function(){
	if(req.status==200 && req.readyState==4)
		document.getElementById("l").innerHTML=req.responseText;
};
}
function developer()
{
var req=new XMLHttpRequest();
req.open("get","http://localhost/Bootstrap/mini_project/developer.php",true);
req.send();
req.onreadystatechange=function(){
	if(req.status==200 && req.readyState==4)
		document.getElementById("l").innerHTML=req.responseText;
};
}
function back()
{
var req=new XMLHttpRequest();
req.open("get","http://localhost/Bootstrap/mini_project/back.php",true);
req.send();
req.onreadystatechange=function(){
	if(req.status==200 && req.readyState==4)
		document.getElementById("l").innerHTML=req.responseText;
};
}
