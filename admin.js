function del()
{
	res=true;
	var x=confirm("Do you really want to delete");
	if(x==true)
		return res;
	else
	{
		res=false;
		return res;
	}
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
